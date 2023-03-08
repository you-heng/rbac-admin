<?php
declare (strict_types = 1);

namespace app\admin\controller;

use think\facade\Request;
use app\admin\model\InterfaceLogs as InterfaceLogsModel;

class InterfaceLogs extends Base
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
        $result = InterfaceLogsModel::page($this->page, $this->limit)->order('sort', 'desc')->select();
        if($result->isEmpty()){
            return $this->message(201, '暂无内容~');
        }
        $count = InterfaceLogsModel::count('id');
        return $this->message_list(200, '请求成功', $count, $result);
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
        $result = InterfaceLogsModel::withSearch([$data['select']], [$data['select'] => $data['search']])->select()->toArray();
        if(!$result){
            return $this->message(201, '暂无内容~');
        }
        return $this->message(200, '请求成功', $result);
    }

    /**
     * 删除
     * @return \think\Response
     */
    public function remove()
    {
        $id = Request::post('id');
        $result = InterfaceLogsModel::destroy($id);
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
        $result = InterfaceLogsModel::destroy($ids);
        if(!$result){
            return $this->message(201, '删除失败');
        }
        return $this->message(200, '清空成功');
    }

    /**
     * 清空
     * @return \think\Response
     */
    public function remove_all()
    {
        $result = InterfaceLogsModel::where('1=1')->delete();
        if(!$result){
            return $this->message(201, '清空失败');
        }
        return $this->message(200, '清空成功');
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
