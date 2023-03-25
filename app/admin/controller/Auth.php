<?php
declare (strict_types = 1);

namespace app\admin\controller;

use app\admin\model\Auth as authModel;
use think\facade\Cache;
use think\facade\Request;

class Auth extends Base
{
    protected $authModel;

    public function __construct()
    {
        $this->authModel = new authModel();
    }

    /**
     * @return \think\Response|\think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     * 列表
     */
    public function index()
    {
        if(Request::isGet()){
            return $this->authModel->get_auth_list();
        }
        return $this->message('请求方式错误', 203);
    }

    /**
     * @return \think\Response
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * 添加
     */
    public function create()
    {
        if(Request::isPost()){
            $data = Request::post();
            $result = $this->authModel->create_auth($data);
            $this->write_logs(2, '添加权限' . is_true($result) . '-id=' . $result);
            if($result){
                return $this->message('添加成功');
            }
            return $this->message('添加失败', 201);
        }
        return $this->message('请求方式错误', 203);
    }

    /**
     * @return \think\Response
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * 编辑
     */
    public function update()
    {
        if(Request::isPost()){
            $data = Request::post();
            $result = $this->authModel->update_auth($data);
            $this->write_logs(3, '修改权限' . is_true($result) . '-id=' . $data['id']);
            if($result){
                return $this->message('修改成功');
            }
            return $this->message('修改失败', 201);
        }
        return $this->message('请求方式错误', 203);
    }

    /**
     * @return \think\Response
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * 删除
     */
    public function remove()
    {
        if(Request::isPost()){
            $id = Request::post('id');
            $result = $this->authModel->remove_auth($id);
            $this->write_logs(4, '删除权限' . is_true($result) . '-id=' . $id);
            if($result){
                return $this->message('删除成功');
            }
            return $this->message('删除错误', 201);
        }
        return $this->message('请求方式错误', 203);
    }

    /**
     * @return \think\Response
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * 清空
     */
    public function remove_all()
    {
        if(Request::isPost()){
            $result = $this->authModel->remove_auth_all();
            $this->write_logs(4, '清空权限表' . is_true($result));
            if($result){
                return $this->message('清空成功');
            }
            return $this->message('清空失败', 201);
        }
        return $this->message('请求方式错误', 203);
    }

    /**
     * @return \think\Response
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * 菜单
     */
    public function menu()
    {
        $uniquid = Request::header('uniquid');
//        $user = Cache::store('memcached')->get($uniquid);
         $user = Cache::store('redis')->get($uniquid);
        $user = json_decode($user, true);
        return $this->message('成功', 200, $user['role']['menu']);
    }
}
