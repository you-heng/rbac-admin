<?php
declare (strict_types = 1);

namespace app\api\controller\v1;

use app\seek\controller\v1\RebateAli;
use app\seek\controller\v1\RebateDtk;
use app\seek\controller\v1\RebateJd;
use app\seek\controller\v1\RebatePdd;
use think\facade\Request;

class Tk extends Base
{
    /**
     * 获取列表
     */
    public function get_logo_list()
    {
        $data = [
            [
                'id' => 1,
                'logo' => 'https://img.alicdn.com/imgextra/i1/2015108109/O1CN0145CWdD29lyWxXg54B_!!2015108109.png',
                'text' => '淘宝返利'
            ],
            [
                'id' => 2,
                'logo' => 'https://img.alicdn.com/imgextra/i2/2015108109/O1CN01d7mcWg29lyX0FOsAj_!!2015108109.jpg',
                'text' => '京东返利'
            ],
            [
                'id' => 3,
                'logo' => 'https://img.alicdn.com/imgextra/i2/2015108109/O1CN01SWUsdi29lyWukCs0k_!!2015108109.png',
                'text' => '拼多多返利'
            ],
            [
                'id' => 4,
                'logo' => 'https://img.alicdn.com/imgextra/i3/2015108109/O1CN01rvEbEu29lyWtJidUN_!!2015108109.jpg',
                'text' => '抖音返利'
            ],
            [
                'id' => 5,
                'logo' => 'https://img.alicdn.com/imgextra/i4/2015108109/O1CN01NDNCV929lyWtJgxbS_!!2015108109.png',
                'text' => '唯品会返利'
            ],
        ];
        return $this->message('success', 200, $data);
    }

    /**
     * 获取首页列表
     * @return \think\Response
     */
    public function get_home()
    {
        if(Request::isGet()){
            $data = Request::get();
            $path = '../runtime/seek/';
            switch ($data['select']){
                case 1:
                    $path = $path . 'tk_ali/' . $data['tag'] . '/' . $data['page'] . '.log';
                    break;
                case 2:
                    $path = $path . 'tk_jd/' . $data['tag'] . '/' . $data['page'] . '.log';
                    break;
                case 3:
                    $path = $path . 'tk_pdd/' . $data['tag'] . '/' . $data['page'] . '.log';
                    break;
                case 4:
                    $path = $path . 'tk_dy/' . $data['tag'] . '/' . $data['page'] . '.log';
                    break;
                case 5:
                    $path = $path . 'tk_wph/' . $data['tag'] . '/' . $data['page'] . '.log';
                    break;
                default: // 默认淘宝
                    $path = $path . 'tk_ali/' . $data['tag'] . '/' . $data['page'] . '.log';
                    break;
            }
            if(file_exists($path)){
                $result = file_get_contents($path);
                return $this->message('success', 200, json_decode($result, true));
            }
            return $this->message('error', 200);
        }
        return $this->message('请求错误！', 201);
    }

    /**
     * 根据标题搜索
     */
    public function search()
    {
        if(Request::isGet()){
            $data = Request::get();
            $result = [];
            switch ($data['select']){
                case 1: // 淘宝
                    $q = new RebateAli();
                    $result = $q->search_optional($data['q'], $data['page']);
                    break;
                case 2: // 京东
                    $q = new RebateDtk();
                    $result = $q->jd_search($data['page'], $data['q']);
                    break;
                case 3: // 拼多多
                    $q = new RebatePdd();
                    $result = $q->search_goods($data['q'], $data['page']);
                    break;
                case 4: // 抖音
                    $q = new RebateDtk();
                    $result = $q->tiktok_search($data['page'], $data['q']);
                    break;
                case 5: // 唯品会

                    break;
                default: // 默认淘宝
                    $q = new RebateAli();
                    $result = $q->search_optional($data['q'], $data['page']);
                    break;
            }
            return $this->message('success', 200, $result);
        }
        return $this->message('请求错误！', 201);
    }

    /**
     * 换链
     */
    public function get_url()
    {
        if(Request::isPost()){
            $data = Request::post();
            $result = [];
            try {
                switch ($data['is_type']){
                    case 2: // 京东
                        $link - new RebateJd();
                        $result = $link->
                        break;
                    case 3: // 拼多多
                        $link = new RebatePdd();
                        $result = $link->url_generate($data['item_id']);
                        break;
                    default:
                        break;
                }
                return $this->message('success', 200, $result);
            }catch (Exception $e){
                // 将错误信息入库
                return $this->message('您来晚了，优惠券已经领完！', 201);
            }
        }
        return $this->message('请求错误！', 201);
    }

    /**
     * 记录分享和跳转
     */
    public function share_wirte()
    {
        if(Request::isPost()){

        }
        return $this->message('请求错误！', 201);
    }
}
