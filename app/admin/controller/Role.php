<?php
declare (strict_types = 1);

namespace app\admin\controller;

use app\admin\model\Role as roleModel;
use think\facade\Request;

class Role extends Base
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
        $result = roleModel::page($this->page, $this->limit)->order('sort', 'desc')->select();
        if(!$result){
            return $this->message(201, '暂无内容～');
        }
        $count = roleModel::count('id');
        return $this->message(200, '请求成功', [
            'page' => $this->page,
            'limit' => $this->limit,
            'count' => $count,
            'data' => $result
        ]);
    }

    /**
     * 添加
     * @return \think\Response
     */
    public function create()
    {
        $data = Request::post();
        $result = roleModel::create($data);
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
        $result = roleModel::update($data);
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
        $result = roleModel::destroy($id);
        if(!$result){
            return $this->message(201, '删除失败');
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
        $result = roleModel::destroy($ids);
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
        $result = roleModel::where('id', '<>', 1)->delete();
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
        $result = roleModel::withSearch([$data['select']], [$data['select'] => $data['search']])->select()->toArray();
        if(!$result){
            return $this->message(201, '暂无内容~');
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
        $result = roleModel::where('id', $data['id'])->update(['is_state' => $is_state]);
        if(!$result){
            return $this->message(201, $msg . '失败');
        }
        return $this->message(200, $msg . '成功');
    }

    /**
     * 授权
     * @return \think\Response
     */
    public function auth()
    {
        $data = Request::post();
        $result = roleModel::where('id', $data['id'])->update(['menu_ids' => $data['auths']['menu_ids'], 'auth_ids' => $data['auths']['auth_ids']]);
        if(!$result){
            return $this->message(201, '授权失败');
        }
        return $this->message(200, '授权成功');
    }
}
