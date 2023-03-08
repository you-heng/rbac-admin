<?php
declare (strict_types = 1);

namespace app\admin\controller;

use think\exception\ValidateException;
use app\admin\validate\BlackList as blackListValidate;
use app\admin\model\BlackList as blackListModel;
use think\facade\Request;

class BlackList extends Base
{
    /**
     * @return \think\Response
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     * 列表
     */
    public function index()
    {
        $result = blackListModel::page($this->page, $this->limit)->order('sort', 'desc')->select();
        if(!$result){
            return $this->message(201, '暂无内容~');
        }
        $count = blackListModel::count('id');
        return $this->message_list(200, '请求成功', $count, $result);
    }

    /**
     * @return \think\Response
     * 添加
     */
    public function create()
    {
        $data = Request::post();
        $this->check($data);
        $result = blackListModel::create($data);
        if(!$result){
            return $this->message(201, '添加失败');
        }
        return $this->message(200, '添加成功');
    }

    /**
     * @return \think\Response
     * 修改
     */
    public function update()
    {
        $data = Request::post();
        $this->check($data);
        $result = blackListModel::update($data);
        if(!$result){
            return $this->message(201, '修改失败');
        }
        return $this->message(200, '修改成功');
    }

    /**
     * @param $data
     * @return \think\Response|void
     * 验证
     */
    public function check($data)
    {
        try {
            validate(blackListValidate::class)->scene('create')->check($data);
        }catch (ValidateException $e){
            $msg = $e->getError();
            return $this->message(201, $msg);
        }
    }

    /**
     * @return \think\Response
     * 删除
     */
    public function remove()
    {
        $id = Request::post('id');
        $result = blackListModel::destroy($id);
        if(!$result){
            return $this->message(201, '删除失败');
        }
        return $this->message(200, '删除成功');
    }

    /**
     * @return \think\Response
     * 批量删除
     */
    public function batch_remove()
    {
        $ids = Request::post('ids');
        $result = blackListModel::destroy($ids);
        if(!$result){
            return $this->message(201, '删除失败');
        }
        return $this->message(200, '删除成功');
    }

    /**
     * @return \think\Response
     * 清空
     */
    public function remove_all()
    {
        $result = blackListModel::where('1=1')->delete();
        if(!$result){
            return $this->message(201, '清空失败');
        }
        return $this->message(200, '清空成功');
    }

    /**
     * @return \think\Response
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     * 搜索
     */
    public function search()
    {
        $data = Request::post();
        $result = blackListModel::withSearch([$data['select']], [$data['select'] => $data['search']])->select()->toArray();
        if(!$result){
            return $this->message(201, '暂无内容~');
        }
        return $this->message(200, '请求成功', $result);
    }

    /**
     * @return \think\Response
     * 状态
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
        $result = blackListModel::update([
            'id' => $data['id'],
            'is_state' => $is_state
        ]);
        if(!$result){
            return $this->message(203, $msg . '失败');
        }
        return $this->message(200, $msg . '成功');
    }

    /**
     * 批量导出
     * @return void
     */
    public function batch_down()
    {

    }

    /**
     * 全部导出
     * @return void
     */
    public function down_all()
    {

    }
}
