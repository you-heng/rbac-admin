<?php
declare (strict_types = 1);

namespace app\admin\controller;

use app\admin\model\Job as jobModel;
use think\facade\Cache;
use think\facade\Request;

class Job extends Base
{
    protected $jobModel;

    public function __construct()
    {
        $this->jobModel = new jobModel();
    }

    /**
     * @return \think\Response|\think\response\Json
     * 列表
     */
    public function index()
    {
        if(Request::isGet()){
            return $this->jobModel->get_job_list($this->limit);
        }
        return $this->message('请求方式错误', 203);
    }

    /**
     * @return \think\Response
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * 添加
     */
    public function create()
    {
        if (Request::isPost()){
            $data = Request::post();
            $result = $this->jobModel->create_job($data);
            $this->write_logs(2, '添加职位' . is_true($result) . 'id=' . $result);
            if($result){
                return $this->message('添加成功');
            }
            return $this->message('添加失败', 201);
        }
        return $this->message('请求方式错误', 203);
    }

    /**
     * @return \think\Response
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * 编辑
     */
    public function update()
    {
        if(Request::isPost()){
            $data = Request::post();
            $result = $this->jobModel->update_job($data);
            $this->write_logs(3, '编辑职位' . is_true($result) . 'id=' . $data['id']);
            if($result->isEmpty()){
                return $this->message('修改失败', 201);
            }
            return $this->message('修改成功');
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
            $result = $this->jobModel->remove_job($id);
            $this->write_logs(4, '删除职位成功id=' . $id);
            if($result){
                return $this->message('删除成功');
            }
            return $this->message('删除失败', 201);
        }
        return $this->message('请求方式错误', 203);
    }

    /**
     * @return \think\Response
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * 批量删除
     */
    public function batch_remove()
    {
        if(Request::isPost()){
            $ids = Request::post('ids');
            $result = $this->jobModel->remove_job($ids);
            $this->write_logs(4, '批量删除职位' . is_true($result) . '-id=' . implode(',', $ids));
            if($result){
                return $this->message('删除成功');
            }
            return $this->message('删除失败', 201);
        }
        return $this->message('请求方式错误', 203);
    }

    /**
     * @return \think\Response
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     * 批量导出
     */
    public function batch_down()
    {
        if(Request::isPost()){
            $ids = Request::post('ids');
            $result = $this->jobModel->down(1, $ids);
            $filename = '职位管理-' . date('YmdHis');
            $head = ['ID', '岗位名称', '排序', '创建时间', '修改时间'];
            $value = ['id', 'job_name', 'sort', 'create_time', 'update_time'];
            Cache::store('redis')->set('excel', json_encode([
                'filename' => $filename,
                'head' => $head,
                'value' => $value,
                'data' => $result
            ]));
        }
        return $this->message('请求方式错误', 203);

        /*Cache::store('memcached')->set('excel', json_encode([
            'filename' => $filename,
            'head' => $head,
            'value' => $value,
            'data' => $data
        ]));*/
    }

    /**
     * @return \think\Response
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     * 全部导出
     */
    public function down_all()
    {
        if(Request::isPost()){
            $result = $this->jobModel->down(2);
            $filename = '职位管理-' . date('YmdHis');
            $head = ['ID', '岗位名称', '排序', '创建时间', '修改时间'];
            $value = ['id', 'job_name', 'sort', 'create_time', 'update_time'];
            Cache::store('redis')->set('excel', json_encode([
                'filename' => $filename,
                'head' => $head,
                'value' => $value,
                'data' => $result
            ]));
        }
        return $this->message('请求方式错误', 203);

        /*Cache::store('memcached')->set('excel', json_encode([
            'filename' => $filename,
            'head' => $head,
            'value' => $value,
            'data' => $data
        ]));*/
    }

    /**
     * @return \think\Response
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * 清空
     */
    public function remove_all()
    {
        if(Request::isPost()){
            $result = $this->jobModel->remove_job_all();
            $this->write_logs(4, '清空职位表' . is_true($result));
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
     * 搜索
     */
    public function search()
    {
        if(Request::isPost()){
            $data = Request::post();
            $result = $this->jobModel->search($data);
            $this->write_logs(5, '搜索'. $data['select'] . '=' . $data['search'] . is_true($result));
            if($result->isEmpty()){
                return $this->message('暂无内容~', 201);
            }
            return $this->message('请求成功', 200, $result);
        }
        return $this->message('请求方式错误', 203);
    }
}
