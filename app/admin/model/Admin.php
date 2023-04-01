<?php
declare (strict_types = 1);

namespace app\admin\model;

use app\admin\controller\Common;
use think\Exception;
use think\exception\ValidateException;
use app\admin\validate\Admin as adminValidate;
use app\admin\model\Dict as dictModel;
use app\admin\model\Team as teamModel;
use think\facade\Cache;

/**
 * @mixin \think\Model
 */
class Admin extends Base
{
    // 设置表名
    protected $name = 'admin';
    // 设置json类型字段
    protected $json = ['role_ids', 'team_ids', 'avatar'];

    // 设置JSON数据返回数组
    protected $jsonAssoc = true;

    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

    public function team()
    {
        return $this->hasMany(Team::class, 'team_ids', 'id');
    }

    public function searchIdAttr($query, $value, $data)
    {
        $query->where('id', '=', $value);
    }

    public function searchUsernameAttr($query, $value, $data)
    {
        $query->where('username', 'like', '%' . $value .'%');
    }

    public function searchPhoneAttr($query, $value, $data)
    {
        $query->where('phone', 'like', '%' . $value .'%');
    }

    /**
     * @param $limit
     * @return \think\response\Json
     * 获取管理员列表
     */
    public function get_admin_list($limit)
    {
        try {
            $res = $this->withJoin(['job' => ['job_name']])->order('sort', 'desc')->paginate($limit);
            if($res->isEmpty()){
                return api_message('暂无内容~');
            }
            $result = $this->team_name($res);
            return api_message('', 200, $result);
        }catch (Exception $e){
            return api_message($e->getMessage());
        }
    }

    /**
     * @param $data
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     * 获取团队名称等信息
     */
    public function team_name($data)
    {
        $team = $this->team()->field('id,team_name')->select();
        foreach($data as $k => $v){
            $data[$k]['role_name'] = implode(',', $v['role_ids']);
            $data[$k]['job_name'] = $v['job']['job_name'];
            $temp = '';
            foreach($v['team_ids'] as $val){
                foreach($team as $value){
                    if($value['id'] == $val){
                        $temp .= $value['team_name'] . '-';
                    }
                }
            }
            $temp = rtrim($temp, '-');
            $data[$k]['team_name'] = $temp;
            $data[$k]['job_id'] = [$v['job_id']];
        }
        return $data;
    }

    /**
     * @param $team_id
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     * 根据团队获取管理员列表
     */
    public function team_get_admin($team_id)
    {
        $res = $this->field('id,team_ids')->select();
        try {
            $list = [];
            foreach($res as $v){
                if(in_array($team_id, $v['team_ids'])){
                    $list[] = $v['id'];
                }
            }
            if(empty($list)){
                return api_message('暂无内容~',201);
            }
            $data = $this->where('id', 'in', $list)->select();
            $result = $this->team_name($data);
            return api_message('', 200, $result);
        }catch (Exception $e){
            return api_message($e->getMessage());
        }
    }

    /**
     * @return int|string
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     * 添加管理员
     */
    public function create_admin($data)
    {
        $this->check($data, 'create');
        $config = dictModel::where('is_state' , 1)->where('key', 'in', ['user_pass', 'user_avatar', 'user_phone', 'user_email'])->column('key,val');
        $config = array_column($config, 'val', 'key');
        $data['password'] = encry($config['user_pass']);
        $data['avatar'] = $config['user_avatar'];
        $data['phone'] = $config['user_phone'];
        $data['email'] = $config['user_email'];
        $data['job_id'] = $data['job_id'][0];
        return $this->insertGetId($data);
    }

    /**
     * @param $data
     * @return Admin
     * 修改管理员
     */
    public function update_admin($data)
    {
        $this->check($data, 'update');
        $data['job_id'] = $data['job_id'][0];
        return $this->update($data);
    }

    /**
     * @param $data
     * @return \think\response\Json|void
     * 验证
     */
    public function check($data, $scene)
    {
        try {
            validate(adminValidate::class)->scene($scene)->check($data);
        }catch (ValidateException $e){
            return api_message($e->getMessage());
        }
    }

    /**
     * @param $id
     * @return bool|\think\response\Json
     * 删除
     */
    public function remove_admin($id)
    {
        if($id === 1){
            return api_message('admin 管理员不能被删除',201);
        }
        return $this->destroy($id);
    }

    /**
     * @return bool
     * 清空
     */
    public function remove_admin_all()
    {
        return $this->where('id', '<>', 1)->delete();
    }

    /**
     * @param $data
     * @return array|\think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     * 搜索
     */
    public function search($data)
    {
        $res = $this->withSearch([$data['select']], [$data['select'] => $data['search']])
            ->alias('t1')
            ->leftJoin('job t2', 't1.job_id=t2.id')
            ->field('t1.*,t2.job_name')
            ->select();
        if($res){
            $team = teamModel::field('id,team_name')->select();
            foreach($res as $k => $v){
                $res[$k]['role_name'] = implode(',', $v['role_ids']);
                $temp = '';
                foreach($v['team_ids'] as $val){
                    foreach($team as $value){
                        if($value['id'] == $val){
                            $temp .= $value['team_name'] . '-';
                        }
                    }
                }
                $temp = rtrim($temp, '-');
                $res[$k]['team_name'] = $temp;
                $res[$k]['job_id'] = [$v['job_id']];
            }
            return $res;
        }
        return api_message('请求失败',201);
    }

    /**
     * @param $id
     * @param $is_state
     * @return Admin
     * 状态
     */
    public function is_state($id, $is_state)
    {
        return $this->update(['id' => $id, 'is_state' => $is_state]);
    }

    /**
     * @param $type
     * @param $ids
     * @return Admin[]|array|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     * 导出
     */
    public function down($type, $ids=[])
    {
        $result = [];
        if($type === 1){
            $result = $this->where('id', 'in', $ids)->select();
        }else{
            $result = $this->select();
        }
        $result = $this->team_name($result);
        $filename = '管理员列表';
        $head = ['ID', '用户名', '手机号码', '邮箱', '角色', '部门', '岗位', '状态', '排序', '创建时间'];
        $value = ['id', 'username', 'phone', 'email', 'role_name', 'team_name', 'job_name', 'is_state', 'sort', 'create_time'];
        $common = new Common();
        $common->excel($filename, $head, $value, $result);
    }
}
