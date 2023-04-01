<?php
declare (strict_types = 1);

namespace app\admin\controller;

use app\admin\model\Role as roleModel;
use think\facade\Request;

class Role extends Base
{
    protected $roleModel;

    public function __construct()
    {
        $this->roleModel = new roleModel();
    }

    /**
     * @return \think\Response|\think\response\Json
     * 列表
     */
    public function index()
    {
        if(Request::isGet()){
            return $this->roleModel->get_rol_list($this->limit);
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
            $result = $this->roleModel->create_role($data);
            $this->write_logs(2, '添加角色' . is_true($result) . 'id=' . $result);
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
            $result = $this->roleModel->update_role($data);
            $this->write_logs(3, '修改角色' . is_true($result) . 'id=' . $data['id']);
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
            $result = $this->roleModel->remove_role($id);
            $this->write_logs(4, '删除角色' . is_true($result) . 'id=' . $id);
            if($result){
                return $this->message('删除成功');
            }
            return $this->message('删除失败', 201);
        }
        return $this->message('请求方式错误', 203);
    }

    /**
     * @return \think\Response
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * 批量删除
     */
    public function batch_remove()
    {
        if(Request::isPost()){
            $ids = Request::post('ids');
            $result = $this->roleModel->remove_role($ids);
            $this->write_logs(4, '批量删除角色' . is_true($result) . 'id=' . implode(',', $ids));
            if($result){
                return $this->message('删除成功');
            }
            return $this->message('删除失败', 201);
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
            $result = $this->roleModel->remove_role_all();
            $this->write_logs(4, '清空角色表' . is_true($result));
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
     * 搜索
     */
    public function search()
    {
        if(Request::isPost()){
            $data = Request::post();
            $result = $this->roleModel->search($data);
            $this->write_logs(5, '搜索'. $data['select'] . '=' . $data['search'] . is_true($result));
            return $this->message('请求成功', 200, $result);
        }
        return $this->message('请求方式错误', 203);
    }

    /**
     * @return \think\Response
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * 状态
     */
    public function is_state()
    {
        if(Request::isPost()){
            $data = Request::post();
            $is_state = 1;
            $msg = '启用';
            if($data['is_state'] == 1){
                $is_state = 2;
                $msg = '禁用';
            }
            $result = $this->roleModel->is_state($data['id'], $is_state);
            $this->write_logs(7,  '角色id=' . $data['id'] . $msg . is_true($result));
            if($result){
                return $this->message($msg . '成功');
            }
            return $this->message($msg . '失败', 201);
        }
        return $this->message('请求方式错误', 203);
    }

    /**
     * @return \think\Response|\think\response\Json
     * 授权
     */
    public function auth()
    {
        if(Request::isPost()){
            $data = Request::post();
            return $this->roleModel->auth($data);
        }
        return $this->message('请求方式错误', 203);
    }

    /**
     * @return \think\Response
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     * 批量导出
     */
    public function batch_down()
    {
        if(Request::isPost()){
            $ids = Request::post('ids');
            $this->roleModel->down(1, $ids);
            $this->write_logs(6, '批量导出角色列表');
        }
        return $this->message('请求方式错误', 203);
    }

    /**
     * @return \think\Response
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     * 导出全部
     */
    public function down_all()
    {
        if(Request::isPost()){
            $this->roleModel->down(2);
            $this->write_logs(6, '导出全部角色列表');
        }
        return $this->message('请求方式错误', 203);
    }
}
