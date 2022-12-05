<?php
declare (strict_types = 1);

namespace app\admin\controller;

use app\admin\model\Auth as authModel;
use think\facade\Cache;
use think\facade\Request;

class Auth extends Base
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
        $result = authModel::order('sort', 'desc')->select()->toArray();
        if(!$result){
            return $this->message(201, '暂无内容～');
        }
        $data = get_p_name($result, '顶级权限', 'title');
        $result = tree_data($data);
        return $this->message(200, '请求成功', $result);
    }

    /**
     * 添加
     * @return \think\Response
     */
    public function create()
    {
        $data = Request::post();
        $result = authModel::create($data);
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
        $result = authModel::update($data);
        if(!$result){
            return $this->message(201, '修改失败');
        }
        return $this->message(200, '修改成功');
    }

    /**
     * 删除
     * @return \think\Response
     */
    public function remove()
    {
        $id = Request::post('id');
        $p_ids = authModel::field('p_ids')->find($id)->toArray()['p_ids'];
        halt($p_ids);
        $result = authModel::destroy($id);
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
        $result = authModel::where('is_menu', 2)->delete();
        if(!$result){
            return $this->message(201, '清空失败');
        }
        return $this->message(200, '清空成功');
    }

    /**
     * 菜单
     * @return \think\Response
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function menu()
    {
        $uniquid = Request::header('uniquid');
        $user = Cache::store('redis')->get($uniquid);
        $user = json_decode($user, true);
        return $this->message(200, '成功', $user['role']['menu']);
    }
}
