<?php
declare (strict_types = 1);

namespace app\seek\controller\v1;

use think\facade\Db;

class RebateJd extends RebateBase
{
    private $app_key = '';
    private $app_secret = '';
    private $app_id = '';
    private $pid_id = '';
    private $jd;
    private $get_request;

    public function __construct()
    {
        include_once "../extend/jd/jd/JdClient.php";
        include_once "../extend/jd/jd/request/UnionOpenPromotionCommonGetRequest.php";
        $config = Db::name('')->where('')->field('')->select();
        $this->app_key = '';
        $this->app_secret = '';
        $this->app_id = '';
        $this->pid_id = '';
        $this->jd = new \JdClient();
        $this->get_request = new \UnionOpenPromotionCommonGetRequest();
    }

    /**
     * @return void
     * 换链
     */
    public function get_url($url, $coupon_link)
    {
        $this->jd->appKey($this->app_key);
        $this->jd->appSecret($this->app_secret);
        $this->get_request->setPromotionCodeReq([
            'materialId' => $url,
            'couponUrl' => $coupon_link,
            'siteId' => $this->app_id,
            'positionId' => $this->pid_id,
        ]);
        $this->get_request->setVersion("1.0");
        $resp = $this->jd->execute($this->get_request);
        dd($resp);
    }
}
