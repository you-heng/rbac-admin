<?php
declare (strict_types = 1);

namespace app\seek\controller\v1;

use think\facade\Db;

class RebateAli extends RebateBase
{
    private $app_key;
    private $secret_key;
    private $pid;
    private $limit;
    private $client;

    public function __construct()
    {
        include_once "../extend/taobao/TopSdk.php";
        $config = Db::name('dict')->where('key', 'in', ['tk_ali_app_key', 'tk_ali_secret_key', 'tk_ali_pid'])->field('key,val')->select()->toArray();
        $config = array_column($config, 'val', 'key');
        $this->app_key = $config['tk_ali_app_key'];
        $this->secret_key = $config['tk_ali_secret_key'];
        $this->pid = $config['tk_ali_pid'];
        $this->limit = 50;
        $this->client = new \TopClient();
    }

    /**
     * 物料精选
     * @param $material_id
     * @param $page
     */
    public function get_material($material_id, $page, $cate)
    {
        $this->client->appkey = $this->app_key;
        $this->client->secretKey = $this->secret_key;
        $req = new \TbkDgOptimusMaterialRequest();
        $req->setPageSize($this->limit);
        $req->setPageNo($page);
        $req->setAdzoneId($this->pid);
        $req->setMaterialId($material_id); // 分类 hot-热销(28026) big-大额券(27446) tall-高佣金(13366) brand-品牌(3786) very-特惠(4094)
        $resp = $this->client->execute($req);
        $data = json_decode(json_encode($resp), true);
        if(empty($data) || empty($data['result_list']['map_data'])){
            echo '异常';die; // 这里后续需要将记录异常信息
        }
        $res = $this->field_list($data['result_list']['map_data'], $material_id);
        if($res !== false){
            $path = '../runtime/seek/tk_ali/' . $cate . '/';
            $num = get_num_name($path);
            file_put_contents($path . $num . '.log', json_encode($res));
        }
    }

    /**
     * 物料搜索
     * @param $query
     * @param $page
     * @return array|bool
     */
    public function search_optional($query, $page)
    {
        $this->client->appkey = $this->app_key;
        $this->client->secretKey = $this->secret_key;
        $req = new \TbkDgMaterialOptionalRequest();
        $req->setPageSize($this->limit);
        $req->setPageNo($page);
        $req->setQ($query);
        $req->setAdzoneId($this->pid);
        $resp = $this->client->execute($req);
        $data = json_decode(json_encode($resp), true);
        if(empty($data) || empty($data['result_list']['map_data'])){
            echo '异常';die; // 这里后续需要将记录异常信息
        }
        return $this->field_list($data['result_list']['map_data'], 0);
    }

    /**
     * 字段筛选
     * @param $data
     * @return array|bool
     */
    public function field_list($data, $material_id)
    {
        $res = [];
        try {
            foreach($data as $k => $v){
                if(isset($v['item_id'])){
                    $res[$k]['item_id'] = $v['item_id']; // 商品id
                    $res[$k]['host_img'] = $v['pict_url']; // 主图(主页图)
                    $res[$k]['title'] = $v['title']; // 标题
                    $res[$k]['price'] = $v['zk_final_price']; // 原价
                    $coupon = 0;
                    if(isset($v['coupon_amount'])){
                        $coupon = $v['coupon_amount'];
                    }
                    $res[$k]['coupon_price'] = $coupon; // 优惠券价格
                    $price = bcsub($v['zk_final_price'], (string)$coupon,2); // 券后价
                    $res[$k]['coupon_price_last'] = $price;
                    $res[$k]['commission_price'] = bcdiv($v['commission_rate'], '100', 2); // 佣金
                    if(isset($v['coupon_share_url'])){
                        $res[$k]['coupon_link'] = $v['coupon_share_url']; // 二合一链接
                    }else if(isset($v['click_url'])){
                        $res[$k]['coupon_link'] = $v['click_url']; // 二合一链接
                    }else{
                        $res[$k]['coupon_link'] = $v['url']; // 二合一链接
                    }
                    $res[$k]['shop_name'] = $v['shop_title']; // 店铺名
                    $res[$k]['sales_volume'] = $v['volume']; // 销量
                    if(!empty($v['small_images']) && !empty($v['small_images']['string'])){
                        $res[$k]['detail_img'] = $v['small_images']['string']; // 详情图(轮播图)
                    }else{
                        $res[$k]['detail_img'] = $v['pict_url']; // 详情图(轮播图)
                    }
                    $res[$k]['is_type'] = 1; // 类型 1-淘宝 2-京东 3-拼多多 4-抖音 5-唯品会
                    $res[$k]['m_id'] = $material_id; // 榜单
                }
            }
            return $res;
        }catch (\Exception $e){
            echo $e->getMessage();
            // 这里后续需要将记录异常信息
            return false;
        }
    }
}
