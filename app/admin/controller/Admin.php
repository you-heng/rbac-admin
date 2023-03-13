<?php
declare (strict_types = 1);

namespace app\admin\controller;

use app\admin\model\Admin as adminModel;
use app\admin\model\Role as roleModel;
use app\admin\model\Job as jobModel;
use app\admin\model\Team as teamModel;
use app\admin\model\Dict as dictModel;
use think\Exception;
use think\exception\ValidateException;
use app\admin\validate\Admin as adminValidate;
use think\facade\Request;

class Admin extends Base
{
    /**
     * 列表
     * @return \think\Response
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function index()
    {
        try {
            $result = adminModel::alias('t1')
                ->leftJoin('job t2', 't1.job_id=t2.id')
                ->field('t1.*,t2.job_name')
                ->page($this->page, $this->limit)
                ->order('t1.sort', 'desc')
                ->select();
            if(!$result){
                return $this->message(201, '暂无内容～');
            }
            $result = $this->team_name($result);
            $count = adminModel::count('id');
            return $this->message_list(200, '请求成功', $count, $result);
        }catch (Exception $e){
            echo $e->getMessage();
        }
    }

    /**
     * 根据部门获取用户
     * @return \think\Response
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function team()
    {
        $team_id = Request::post('team_id');
        $result = adminModel::field('id,team_ids')->select()->toArray();
        $list = [];
        foreach($result as $v){
            if(in_array($team_id, $v['team_ids'])){
                $list[] = $v['id'];
            }
        }
        if(empty($list)){
            return $this->message(201, '暂无内容~');
        }
        $data = adminModel::where('id', 'in', $list)->select()->toArray();
        $result = $this->team_name($data);
        return $this->message(200, '成功', $result);
    }

    /**
     * 获取团队名称等信息
     * @param $result
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function team_name($result)
    {
        $team = teamModel::field('id,team_name')->select()->toArray();
        foreach($result as $k => $v){
            $result[$k]['role_name'] = implode(',', $v['role_ids']);
            $temp = '';
            foreach($v['team_ids'] as $val){
                foreach($team as $value){
                    if($value['id'] == $val){
                        $temp .= $value['team_name'] . '-';
                    }
                }
            }
            $temp = rtrim($temp, '-');
            $result[$k]['team_name'] = $temp;
            $result[$k]['job_id'] = [$v['job_id']];
        }
        return $result;
    }

    /**
     * 角色列表
     * @return \think\Response
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function role()
    {
        $result = roleModel::select();
        if(!$result){
            return $this->message(201, '暂无内容~');
        }
        return $this->message(200, '请求成功', $result);
    }

    /**
     * 职位列表
     * @return \think\Response
     */
    public function job()
    {
        $result = jobModel::select();
        if(!$result){
            return $this->message(201, '暂无内容~');
        }
        return $this->message(200, '请求成功', $result);
    }

    /**
     * 添加
     * @return \think\Response
     */
    public function create()
    {
        $data = Request::post();
        $this->check($data);
        $config = dictModel::where('is_state' , 1)->where('key', 'in', ['user_pass', 'user_avatar', 'user_phone', 'user_email'])->field('key,val')->select()->toArray();
        $config = array_column($config, 'val', 'key');
        $data['password'] = encry($config['user_pass']);
        $data['avatar'] = $config['user_avatar'];
        $data['phone'] = $config['user_phone'];
        $data['email'] = $config['user_email'];
        $data['job_id'] = $data['job_id'][0];
        $result = adminModel::create($data);
        if(!$result){
            return $this->message(201, '添加失败');
        }
        return $this->message(200, '添加成功');
    }

    /**
     * 编辑
     * @return \think\Response
     */
    public function update()
    {
        $data = Request::post();
        $this->check($data);
        unset($data['password']);
        $data['job_id'] = $data['job_id'][0];
        $result = adminModel::update($data);
        if(!$result){
            return $this->message(201, '修改失败');
        }
        return $this->message(200, '修改成功');
    }

    /**
     * 验证
     * @param $data
     * @return \think\Response|void
     */
    public function check($data)
    {
        try {
            validate(adminValidate::class)->scene('create')->check($data);
        }catch (ValidateException $e){
            $msg = $e->getError();
            return $this->message(201, $msg);
        }
    }

    /**
     * 删除
     * @return \think\Response
     */
    public function remove()
    {
        $id = Request::post('id');
        if($id == 1){
            return $this->message(201, 'admin 管理员不能被删除');
        }
        $result = adminModel::destroy($id);
        if(!$result){
            return $this->message(201, '删除错误');
        }
        return $this->message(200, '删除成功');
    }

    /**
     * 批量删除
     * @return \think\Response
     */
    public function batch_remove()
    {
        $ids = Request::post('ids');
        $result = adminModel::destroy($ids);
        if(!$result){
            return $this->message(203, '删除失败');
        }
        return $this->message(200, '删除成功');
    }

    /**
     * 清空
     * @return \think\Response
     */
    public function remove_all()
    {
        $result = adminModel::where('id', '<>', 1)->delete();
        if(!$result){
            return $this->message(201, '清空失败');
        }
        return $this->message(200, '清空成功');
    }

    /**
     * 搜索
     * @return \think\Response
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function search()
    {
        $data = Request::post();
        $result = adminModel::withSearch([$data['select']], [$data['select'] => $data['search']])
            ->alias('t1')
            ->leftJoin('job t2', 't1.job_id=t2.id')
            ->field('t1.*,t2.job_name')
            ->select()
            ->toArray();
        if(!$result){
            return $this->message(203, '请求失败', []);
        }
        $team = teamModel::field('id,team_name')->select()->toArray();
        foreach($result as $k => $v){
            $result[$k]['role_name'] = implode(',', $v['role_ids']);
            $temp = '';
            foreach($v['team_ids'] as $val){
                foreach($team as $value){
                    if($value['id'] == $val){
                        $temp .= $value['team_name'] . '-';
                    }
                }
            }
            $temp = rtrim($temp, '-');
            $result[$k]['team_name'] = $temp;
            $result[$k]['job_id'] = [$v['job_id']];
        }
        return $this->message(200, '请求成功', $result);
    }


    /**
     * 状态
     * @return \think\Response
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
        $result = adminModel::update([
            'id' => $data['id'],
            'is_state' => $is_state
        ]);
        if(!$result){
            return $this->message(203, $msg . '失败');
        }
        return $this->message(200, $msg . '成功');
    }


    public function batch_down()
    {
        $ids = Request::post();
        halt($ids);
    }
}
