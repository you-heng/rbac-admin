<?php
declare (strict_types = 1);

namespace app\seek\controller\v1;

use think\Exception;
use think\facade\Db;
use GetJdGoodsSearch;
use GetJdListRealRanks;
use DtkClient;

class RebateDtk extends RebateBase
{

    private $app_key;
    private $app_secret;
    private $pid;
    private $limit;
    private $version = 'v1.0.0';

    public function __construct()
    {
        $config = Db::name('dict')->where('key', 'in', ['tk_dtk_app_key', 'tk_dtk_app_secret', 'tk_jd_pid'])->field('key,val')->select()->toArray();
        $config = array_column($config, 'val', 'key');
        $this->app_key = $config['tk_dtk_app_key'];
        $this->app_secret = $config['tk_dtk_app_secret'];
        $this->pid = $config['tk_jd_pid'];
        $this->limit = 50;
    }


    /**
     * 京东搜索
     */
    public function jd_search($page, $keyword)
    {
        $client = new GetJdGoodsSearch();
        $client->setAppKey($this->app_key);
        $client->setAppSecret($this->app_secret);
        $client->setVersion($this->version);
        $res = $client->setParams([
            'pageId' => $page,
            'pageSize' => $this->limit,
            'keyword' => $keyword
        ])->request();
        if(empty($res)){
            echo "异常";die; // 后续将异常记录下来
        }
        $data = json_decode($res, true);
        return $this->jd_field_list($data['data']['list'], 0);
    }

    /**
     * 京东榜单
     */
    public function jd_rank($page)
    {
        $client = new GetJdListRealRanks();
        $client->setAppKey($this->app_key);
        $client->setAppSecret($this->app_secret);
        $client->setVersion($this->version);
        $res = $client->setParams([
            'pageId' => $page,
            'pageSize' => $this->limit
        ])->request();
        dd($res);
    }

    /**
     * @param $data
     * @param $material_id
     * @return false|void
     * 过滤字段
     */
    public function jd_field_list($data, $material_id)
    {
        $res = [];
        try {
            foreach($data as $k => $v){
                $res[$k]['item_id'] = $v['materialUrl'];
                $res[$k]['host_img'] = $v['imageUrlList'][0];
                $res[$k]['title'] = $v['skuName'];
                $res[$k]['price'] = $v['price'];
                $coupon = 0;
                $coupon_link = '';
                if(count($v['couponList']) > 0){
                    $coupon = sprintf("%.2f", floor($v['couponList'][0]['discount'] * 100) / 100);
                    $coupon_link = $v['couponList'][0]['link'];
                }
                $res[$k]['coupon_price'] = $coupon;
                $res[$k]['coupon_price_last'] = bcsub((string)$v['price'], (string)$coupon, 2);
                $res[$k]['commission_price'] = $v['couponCommission'];
                $res[$k]['shop_name'] = $v['shopName'];
                $res[$k]['sales_volume'] = $v['comments'];
                $res[$k]['detail_img'] = $v['imageUrlList'];
                $res[$k]['is_type'] = 2; // 类型 1-淘宝 2-京东 3-拼多多 4-抖音 5-唯品会
                $res[$k]['m_id'] = $material_id;
                $res[$k]['coupon_link'] = $coupon_link;
            }
            return $res;
        }catch (Exception $e){
            echo $e->getMessage();
            // 这里后续需要将记录异常信息
            return false;
        }
    }

    /**
     * 抖音榜单
     */
    public function tiktok_rank($list)
    {
        $client = new DtkClient();
        $client->setAppKey($this->app_key);
        $client->setAppSecret($this->app_secret);
        $client->setVersion($this->version);
        $method = 'get';
        $url = 'https://openapiv2.dataoke.com/rank/tiktok-rank';
        $params = [
            'cid' => $list, // 大淘客分类id 100综合 1女装 2母婴 3美妆 4居家日用 5鞋品 6美食 7文娱车品 8数码家电 9男装 10内衣 11箱包 12配饰 13户外运动 14家装家纺
            'listType' => '实时', // 榜单类型 实时:2h 全天:24h 不传为必购榜
        ];
        $res = $client->doRequest($method, $url, $params);
        dd(json_decode($res, true));
    }

    /**
     * 抖音搜索
     */
    public function tiktok_search($page, $title)
    {
        $client = new DtkClient();
        $client->setAppKey($this->app_key);
        $client->setAppSecret($this->app_secret);
        $client->setVersion($this->version);
        $method = 'get';
        $url = 'https://openapiv2.dataoke.com/tiktok/tiktok-materials-products-search';
        $params = [
            'searchType' => 0,
            'sortType' => 0,
            'page' => $page,
            'pageSize' => $this->limit,
            'title' => $title
        ];
        $res = $client->doRequest($method, $url, $params);
        dd($res);
    }
}
