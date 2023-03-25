<?php
declare (strict_types = 1);

namespace app\admin\controller;

use app\admin\model\BlackList as blackListModel;
use think\facade\Cache;
use think\facade\Request;

class BlackList extends Base
{
    protected $blackListModel;

    public function __construct()
    {
        $this->blackListModel = new blackListModel();
    }

    /**
     * @return \think\Response
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     * 列表
     */
    public function index()
    {
        if(Request::isGet()){
            return $this->blackListModel->get_black_list($this->limit);
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
        if(Request::isPost()){
            $data = Request::post();
            $result = $this->blackListModel->create_black_list($data);
            $this->write_logs(2, '添加黑名单ip' . is_true($result) . '-id=' . $result);
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
     * 修改
     */
    public function update()
    {
        if(Request::isPost()){
            $data = Request::post();
            $result = $this->blackListModel->update_black_list($data);
            $this->write_logs(3, '修改黑名单ip' . is_true($result) . '-id=' . $data['id']);
            if($result){
                return $this->message('修改成功');
            }
            return $this->message('修改失败', 201);
        }
        return $this->message('请求方式错误', 203);
    }

    /**
     * @return \think\Response|\think\response\Json
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * 删除
     */
    public function remove()
    {
        if(Request::isPost()){
            $id = Request::post('id');
            $result = $this->blackListModel->remove_black_list($id);
            $this->write_logs(4, '删除黑名单ip' . is_true($result) . '-id=' . $id);
            if($result){
                return api_message('删除成功');
            }
            return api_message('删除失败', 201);
        }
        return $this->message('请求方式错误', 203);
    }

    /**
     * @return \think\Response|\think\response\Json
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * 批量删除
     */
    public function batch_remove()
    {
        if(Request::isPost()){
            $ids = Request::post('ids');
            $result = $this->blackListModel->remove_black_list($ids);
            $this->write_logs(4, '批量删除黑名单ip' . is_true($result) . '-id=' . implode(',', $ids));
            if($result){
                return api_message('删除成功');
            }
            return api_message('删除失败', 201);
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
            $result = $this->blackListModel->remove_black_list_all();
            $this->write_logs(4, '清空ip黑名单表' . is_true($result));
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
            $result = $this->blackListModel->search($data);
            $this->write_logs(5, '搜索'. $data['select'] . '=' . $data['search'] . is_true($result));
            return $this->message('请求成功', 200, $result);
        }
        return $this->message('请求方式错误', 203);
    }

    /**
     * @return \think\Response
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * 状态
     */
    public function is_state()
    {
        if(Request::isPost()){
            $data = Request::post();
            $is_state = 1;
            $msg = '启用';
            if($data['is_state'] == 1){
                $is_state = 2;
                $msg = '禁用';
            }
            $result = $this->blackListModel->is_state($data['id'], $is_state);
            $this->write_logs(7,  'ip黑名单id=' . $data['id'] . $msg . is_true($result));
            if($result){
                return $this->message($msg . '成功');
            }
            return $this->message($msg . '失败', 201);
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
            $result = $this->blackListModel->down(1, $ids);
            $this->write_logs(6, '批量导出ip黑名单列表' . is_true($result));
            $filename = 'ip黑名单列表-' . date('YmdHis');
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
            $result = $this->blackListModel->down(2);
            $this->write_logs(6, '导出全部ip黑名单列表' . is_true($result));
            $filename = 'ip黑名单列表-' . date('YmdHis');
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
