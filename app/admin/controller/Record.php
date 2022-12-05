<?php
declare (strict_types = 1);

namespace app\admin\controller;

use think\facade\Request;
use app\admin\model\Record as recordModel;

class Record extends Base
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
        $result = recordModel::page($this->page, $this->limit)->select();
        if($result->isEmpty()){
            return $this->message(201, '暂无内容~');
        }
        $count = recordModel::count('id');
        return $this->message(200, '请求成功', [
            'page' => $this->page,
            'limit' => $this->limit,
            'count' => $count,
            'data' => $result
        ]);
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
        $result = recordModel::withSearch([$data['select']], [$data['select'] => $data['search']])->select()->toArray();
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
        $result = recordModel::destroy($id);
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
        $result = recordModel::destroy($ids);
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
        $result = recordModel::where('1=1')->delete();
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
