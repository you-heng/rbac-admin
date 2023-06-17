<?php
declare (strict_types = 1);

namespace app\seek\controller\v1;

use Com\Pdd\Pop\Sdk\PopHttpClient;
use Com\Pdd\Pop\Sdk\PopHttpException;
use Com\Pdd\Pop\Sdk\Api\Request\PddDdkGoodsSearchRequest;
use Com\Pdd\Pop\Sdk\Api\Request\PddDdkGoodsPromotionUrlGenerateRequest;
use Com\Pdd\Pop\Sdk\Api\Request\PddDdkGoodsRecommendGetRequest;
use think\Exception;
use think\facade\Db;

class RebatePdd extends RebateBase
{
    private $client_id;
    private $client_secret;
    private $pid;
    private $limit;
    private $client;

    public function __construct()
    {
        include_once "../extend/pinduoduo/vendor/autoload.php";
        $config = Db::name('dict')->where('key', 'in', ['tk_pdd_client_id', 'tk_pdd_client_secret', 'tk_pdd_pid'])->field('key,val')->select()->toArray();
        $config = array_column($config, 'val', 'key');
        $this->client_id = $config['tk_pdd_client_id'];
        $this->client_secret = $config['tk_pdd_client_secret'];
        $this->pid = $config['tk_pdd_pid'];
        $this->limit = 50;
        $this->client = new PopHttpClient($this->client_id, $this->client_secret);
    }

    /**
     * 榜单推荐
     * @param $list
     * @param $page
     * @param $cate
     */
    public function get_recommend($list, $page, $cate)
    {
        $request = new PddDdkGoodsRecommendGetRequest();
        $request->setChannelType($list); // 榜单 1-今日销量榜,3-相似商品推荐,4-猜你喜欢(和进宝网站精选一致),5-实时热销榜,6-实时收益榜。默认值5
        $request->setLimit($this->limit);
        $request->setOffset($page);
        $request->setPid($this->pid);
        try{
            $response = $this->client->syncInvoke($request);
        } catch(PopHttpException $e){
            // 后续补齐代码将错误信息入库
            echo $e->getMessage();
            exit;
        }
        $content = $response->getContent();
        $res = $this->field_list($content['goods_basic_detail_response']['list'], $list);
        if($res !== false){
            $path = '../runtime/seek/tk_pdd/' . $cate . '/';
            $num = get_num_name($path);
            file_put_contents($path . $num . '.log', json_encode($res));
        }
    }

    /**
     * 商品搜索
     * @param $query
     * @param $page
     * @return array|bool
     */
    public function search_goods($query, $page)
    {
        $request = new PddDdkGoodsSearchRequest();
        $request->setCustomParameters("{\"new\":1}");
        $request->setIsBrandGoods(true);
        $request->setKeyword($query);
        $request->setMerchantType(1);
        $request->setPage($page);
        $request->setPageSize($this->limit);
        $request->setPid($this->pid);
        try{
            $response = $this->client->syncInvoke($request);
        } catch(PopHttpException $e){
            echo $e->getMessage();
            exit;
        }
        $content = $response->getContent();
        return $this->field_list($content['goods_search_response']['goods_list'], 0);
    }

    /**
     * 转链
     * @param $goods_id
     * @return mixed
     */
    public function url_generate($goods_id)
    {
        $request = new PddDdkGoodsPromotionUrlGenerateRequest();
        $request->setCustomParameters("{\"new\":1}");
        $request->setGenerateAuthorityUrl(true);
        $request->setGenerateMallCollectCoupon(true);
        $request->setGenerateQqApp(true);
        $request->setGenerateSchemaUrl(true);
        $request->setGenerateShortUrl(true);
        $request->setGenerateWeApp(true);
        $request->setGoodsSignList(array($goods_id));
        $request->setMultiGroup(true);
        $request->setPId($this->pid);
        $request->setZsDuoId(1);
        try{
            $response = $this->client->syncInvoke($request);
        } catch(PopHttpException $e){
            echo $e->getMessage();
            exit;
        }
        $content = $response->getContent();
        return $content['goods_promotion_url_generate_response']['goods_promotion_url_list'][0]['mobile_url'];
    }

    /**
     * 字段筛选
     * @param $data
     * @return array|bool
     */
    public function field_list($data, $list)
    {
        $res = [];
        try {
            foreach($data as $k => $v){
                $res[$k]['item_id'] = $v['goods_sign']; // 商品id
                $res[$k]['host_img'] = $v['goods_image_url']; // 主图(主页图)
                $res[$k]['title'] = $v['goods_name']; // 标题
                $res[$k]['price'] = bcdiv((string)$v['min_group_price'], '100', 2); // 原价
                $res[$k]['coupon_price'] = bcdiv((string)$v['coupon_discount'], '100', 2); // 优惠券价格
                $price = bcdiv(bcsub((string)$v['min_group_price'], (string)$v['coupon_discount']), '100', 2); // 券后价
                $res[$k]['coupon_price_last'] = $price;
                $res[$k]['commission_price'] = bcmul($price, bcdiv((string)$v['promotion_rate'], '1000', 2), 2); // 佣金
                $res[$k]['coupon_link'] = $v['goods_sign']; // 二合一链接
                $res[$k]['shop_name'] = $v['mall_name']; // 店铺名
                $res[$k]['sales_volume'] = $v['sales_tip']; // 销量
                $res[$k]['detail_img'][] = $v['goods_image_url']; // 详情图(轮播图)
                $res[$k]['is_type'] = 3; // 类型 1-淘宝 2-京东 3-拼多多 4-抖音 5-唯品会
                $res[$k]['m_id'] = $list; // 榜单
            }
            return $res;
        }catch (Exception $e){
            // 这里后续需要将记录异常信息
            return false;
        }
    }
}
