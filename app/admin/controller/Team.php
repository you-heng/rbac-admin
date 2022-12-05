<?php
declare (strict_types = 1);

namespace app\admin\controller;

use app\admin\model\Team as teamModel;
use think\facade\Request;

class Team extends Base
{
    /**
     * 列表
     * @return void
     */
    public function index()
    {
        $result = teamModel::order('sort', 'desc')->select()->toArray();
        if(!$result){
            return $this->message(201, '暂无内容');
        }
        $data = get_p_name($result, '顶级部门', 'team_name');
        $result = tree_data($data);
        return $this->message(200, '请求成功', $result);
    }

    /**
     * 添加
     * @return void
     */
    public function create()
    {
        $data = Request::post();
        $result = teamModel::create($data);
        if(!$result){
            return $this->message(201, '添加失败');
        }
        return $this->message(200, '添加成功');
    }

    /**
     * 编辑
     * @return void
     */
    public function update()
    {
        $data = Request::post();
        $result = teamModel::update($data);
        if(!$result){
            return $this->message(201, '修改失败');
        }
        return $this->message(200, '修改成功');
    }

    /**
     * 删除
     * @return void
     */
    public function remove()
    {
        $id = Request::post('id');
        $result = teamModel::destroy($id);
        if(!$result){
            return $this->message(201, '删除失败');
        }
        return $this->message(200, '删除成功');
    }

    /**
     * 清空
     * @return \think\Response
     */
    public function remove_all()
    {
        $result = teamModel::where('1=1')->delete();
        if(!$result){
            return $this->message(201, '清空失败');
        }
        return $this->message(200,'清空成功');
    }

    /**
     * 状态
     * @return void
     */
    public function is_state()
    {
        $data = Request::post();
        $is_state = 1;
        $msg = '启用';
        if($data['is_state'] == 1){
            $is_state = 2;
            $msg = '禁用';
        }
        $result = teamModel::where('id', $data['id'])->update(['is_state' => $is_state]);
        if(!$result){
            return $this->message(201, $msg . '失败');
        }
        return $this->message(200, $msg . '成功');
    }
}
