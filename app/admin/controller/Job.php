<?php
declare (strict_types = 1);

namespace app\admin\controller;

use app\admin\model\Job as jobModel;
use think\exception\ValidateException;
use think\facade\Cache;
use think\facade\Request;
use app\admin\validate\Job as jobValidate;

class Job extends Base
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
        $result = jobModel::page($this->page, $this->limit)->order('sort', 'desc')->select();
        if(!$result){
            return $this->message(201, '暂无内容~');
        }
        $count = jobModel::count('id');
        return $this->message_list(200, '请求成功', $count, $result);
    }

    /**
     * 添加
     * @return \think\Response
     */
    public function create()
    {
        $data = Request::post();
        $this->check($data);
        $result = jobModel::create($data);
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
        $result = jobModel::update($data);
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
            validate(jobValidate::class)->scene('create')->check($data);
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
        $result = jobModel::destroy($id);
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
        $result = jobModel::destroy($ids);
        if(!$result){
            return $this->message(201, '删除失败');
        }
        return $this->message(200, '删除成功');
    }

    /**
     * @return void
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     * 批量导出
     */
    public function batch_down()
    {
        $ids = Request::post('ids');
        $data = jobModel::where('id', 'in',$ids)->select()->toArray();
        $filename = '职位管理-' . date('YmdHis');
        $head = ['ID', '岗位名称', '排序', '创建时间', '修改时间'];
        $value = ['id', 'job_name', 'sort', 'create_time', 'update_time'];
        Cache::store('redis')->set('excel', json_encode([
            'filename' => $filename,
            'head' => $head,
            'value' => $value,
            'data' => $data
        ]));
        /*Cache::store('memcached')->set('excel', json_encode([
            'filename' => $filename,
            'head' => $head,
            'value' => $value,
            'data' => $data
        ]));*/
    }

    /**
     * @return void
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     * 全部导出
     */
    public function down_all()
    {
        $data = jobModel::select();
        $filename = '职位管理-' . date('YmdHis');
        $head = ['ID', '岗位名称', '排序', '创建时间', '修改时间'];
        $value = ['id', 'job_name', 'sort', 'create_time', 'update_time'];
        Cache::store('redis')->set('excel', json_encode([
            'filename' => $filename,
            'head' => $head,
            'value' => $value,
            'data' => $data
        ]));
        /*Cache::store('memcached')->set('excel', json_encode([
            'filename' => $filename,
            'head' => $head,
            'value' => $value,
            'data' => $data
        ]));*/
    }

    /**
     * 清空
     * @return \think\Response
     */
    public function remove_all()
    {
        $result = jobModel::where("1=1")->delete();
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
        $result = jobModel::withSearch([$data['select']], [$data['select'] => $data['search']])->select()->toArray();
        if(!$result){
            return $this->message(201, '暂无内容~');
        }
        return $this->message(200, '请求成功', $result);
    }
}
