<?php
declare (strict_types = 1);

namespace app\admin\controller;

use app\admin\model\Team as teamModel;
use think\facade\Request;

class Team extends Base
{
    protected $teamModel;

    public function __construct()
    {
        $this->teamModel = new teamModel();
    }

    /**
     * @return \think\Response
     * 列表
     */
    public function index()
    {
        if(Request::isGet() || Request::isPost()){
            $result = $this->teamModel->get_team_list();
            if($result){
                return $this->message('请求成功', 200, $result);
            }
            return $this->message('暂无内容~', 201);
        }
        return $this->message('请求方式错误', 203);
    }

    /**
     * @return \think\Response
     * 添加
     */
    public function create()
    {
        if(Request::isPost()){
            $data = Request::post();
            $result = $this->teamModel->create_team($data);
            $this->write_logs(2, '添加团队' . is_true($result) . 'id=' . $result);
            if($result){
                return $this->message('添加成功');
            }
            return $this->message('添加失败', 201);
        }
        return $this->message('请求方式错误', 203);
    }

    /**
     * @return \think\Response
     * 编辑
     */
    public function update()
    {
        if(Request::isPost()){
            $data = Request::post();
            $result = $this->teamModel->update_team($data);
            $this->write_logs(3, '修改团队' . is_true($result) . 'id=' . $result);
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
            $result = $this->teamModel->remove_team($id);
            $this->write_logs(4, '删除团队' . is_true($result) . 'id=' . $result);
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
            $result = $this->teamModel->remove_team_all();
            $this->write_logs(4, '清空团队表' . is_true($result));
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
            $result = $this->teamModel->is_state($data['id'], $is_state);
            $this->write_logs(7,  '团队id=' . $data['id'] . $msg . is_true($result));
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
     * 导出全部
     */
    public function down_all()
    {
        if(Request::isPost()){
            $this->teamModel->down();
            $this->write_logs(6, '导出全部团队列表');
        }
        return $this->message('请求方式错误', 203);
    }
}
