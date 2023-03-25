<?php
declare (strict_types = 1);

namespace app\admin\controller;

use think\facade\Cache;
use think\facade\Request;
use app\admin\model\InterfaceLogs as InterfaceLogsModel;

class InterfaceLogs extends Base
{
    protected $interfaceLogsModel;

    public function __construct()
    {
        $this->interfaceLogsModel = new InterfaceLogsModel();
    }

    /**
     * @return \think\Response|\think\response\Json
     * 列表
     */
    public function index()
    {
        if(Request::isGet()){
            return $this->interfaceLogsModel->get_logs_list($this->limit);
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
            $result = $this->interfaceLogsModel->search($data);
            $this->write_logs(5, '搜索'. $data['select'] . '=' . $data['search'] . is_true($result));
            return $this->message('请求成功', 200, $result);
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
            $result = $this->interfaceLogsModel->remove_logs($id);
            $this->write_logs(4, '删除日志' . is_true($result) . '-id=' . $id);
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
            $result = $this->interfaceLogsModel->remove_logs($ids);
            $this->write_logs(4, '批量删除日志' . is_true($result) . '-id=' . implode(',', $ids));
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
     * 清空
     */
    public function remove_all()
    {
        if(Request::isPost()){
            $result = $this->interfaceLogsModel->remove_logs_all();
            $this->write_logs(4, '清空日志表' . is_true($result));
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
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     * 批量导出
     */
    public function batch_down()
    {
        if(Request::isPost()){
            $ids = Request::post('ids');
            $result = $this->interfaceLogsModel->down(1, $ids);
            $this->write_logs(6, '批量导出日志列表' . is_true($result));
            $filename = '日志列表-' . date('YmdHis');
            $head = ['ID', ''];
            $value = [];
            Cache::store('memcached')->set('excel', json_encode([
                'filename' => $filename,
                'head' => $head,
                'value' => $value,
                'data' => $result,
            ]));
        }
        return $this->message('请求方式错误', 203);
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
            $result = $this->interfaceLogsModel->down(2);
            $this->write_logs(6, '导出全部字典列表' . is_true($result));
            $filename = '字典列表-' . date('YmdHis');
            $head = ['ID', ''];
            $value = [];
            Cache::store('memcached')->set('excel', json_encode([
                'filename' => $filename,
                'head' => $head,
                'value' => $value,
                'data' => $result,
            ]));
        }
        return $this->message('请求方式错误', 203);
    }
}
