<?php
declare (strict_types = 1);

namespace app\seek\controller\v1;

class Index
{
    public function index()
    {
        $data = new RebateDtk();
        $data->jd_search(1, '面膜');

        /*$ali = new RebateAli();
        $res = $ali->search_optional('睡衣', 1, 'total_sales');
        dd($res);*/
        // $data = new RebateDtk();
        // $data->jd_search(1, '面膜', 'price', 'desc');
        // $pdd = new RebatePdd();
        // $pdd->get_recommend(5, 4, 'hot');
        /*$pdd = new RebatePdd();
        $pdd->url_generate('E972n1ysZxBNMcUBwfDcX8QoOheX_kIhzQ_JD1rh80kL');*/
        /*$ali = new RebateAli();
        $ali->get_material(28026, 4, 'hot');*/
    }
}
