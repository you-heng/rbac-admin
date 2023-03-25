<?php
declare (strict_types = 1);

namespace app\admin\controller;

use app\admin\model\Admin as adminModel;
use app\admin\model\Role as roleModel;
use app\admin\model\Job as jobModel;
use think\facade\Cache;
use think\facade\Request;

class Admin extends Base
{
    protected $adminModel;

    public function __construct()
    {
        $this->adminModel = new adminModel();
    }

    /**
     * @return \think\Response|\think\response\Json
     * 列表
     */
    public function index()
    {
        if(Request::isGet()){
            return $this->adminModel->get_admin_list($this->limit);
        }
        return $this->message('请求方式错误', 203);
    }

    /**
     * @return \think\Response|\think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     * 根据部门获取用户
     */
    public function team()
    {
        if(Request::isPost()){
            $team_id = Request::post('team_id');
            return $this->adminModel->team_get_admin($team_id);
        }
        return $this->message('请求方式错误', 203);
    }

    /**
     * @return \think\Response
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     * 角色列表
     */
    public function role()
    {
        if(Request::isGet()){
            $result = roleModel::select();
            if($result->isEmpty()){
                return $this->message('暂无内容~', 201);
            }
            return $this->message('请求成功', 200, $result);
        }
        return $this->message('请求方式错误', 203);
    }

    /**
     * @return \think\Response
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     * 职位列表
     */
    public function job()
    {
        if(Request::isGet()){
            $result = jobModel::select();
            if($result->isEmpty()){
                return $this->message('暂无内容~', 201);
            }
            return $this->message('请求成功', 200, $result);
        }
        return $this->message('请求方式错误', 203);
    }

    /**
     * @return \think\Response
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     * 添加
     */
    public function create()
    {
        if(Request::isPost()){
            $data = Request::post();
            $result = $this->adminModel->create_admin($data);
            $this->write_logs(2, '添加管理员' . is_true($result) . '-id=' . $result);
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
            $result = $this->adminModel->update_admin($data);
            $this->write_logs(3, '修改管理员' . is_true($result) . '-id=' . $data['id']);
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
            $result = $this->adminModel->remove_admin($id);
            $this->write_logs(4, '删除管理员' . is_true($result) . '-id=' . $id);
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
     * 批量删除
     */
    public function batch_remove()
    {
        if(Request::isPost()){
            $ids = Request::post('ids');
            $result = $this->adminModel->remove_admin($ids);
            $this->write_logs(4, '批量删除管理员' . is_true($result) . '-id=' . implode(',', $ids));
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
            $result = $this->adminModel->remove_admin_all();
            $this->write_logs(4, '清空管理员表' . is_true($result));
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
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     * 搜索
     */
    public function search()
    {
        if(Request::isPost()){
            $data = Request::post();
            $result = $this->adminModel->search($data);
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
            $result = $this->adminModel->is_state($data['id'], $is_state);
            $this->write_logs(7,  '管理员id=' . $data['id'] . $msg . is_true($result));
            if($result){
                return $this->message($msg . '失败', 201);
            }
            return $this->message($msg . '成功');
        }
        return $this->message('请求方式错误', 203);
    }


    /**
     * @return \think\Response
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * 批量导出
     */
    public function batch_down()
    {
        if(Request::isPost()){
            $ids = Request::post('ids');
            $result = $this->adminModel->down(1, $ids);
            $this->write_logs(6, '批量导出管理员列表' . is_true($result));
            $filename = '管理员列表-' . date('YmdHis');
            $head = ['ID', ''];
            $value = [];
            Cache::store('memcached')->set('excel', json_encode([
                'filename' => $filename,
                'head' => $head,
                'value' => $value,
                'data' => $result,
            ]));
        }
        return $this->message('请求方式错误', 203);
    }

    /**
     * @return \think\Response
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     * 全部导出
     */
    public function down_all()
    {
        if(Request::isPost()){
            $result = $this->adminModel->down(2);
            $this->write_logs(6, '导出全部管理员列表' . is_true($result));
            $filename = '管理员列表-' . date('YmdHis');
            $head = ['ID', ''];
            $value = [];
            Cache::store('memcached')->set('excel', json_encode([
                'filename' => $filename,
                'head' => $head,
                'value' => $value,
                'data' => $result,
            ]));
        }
        return $this->message('请求方式错误', 203);
    }
}
