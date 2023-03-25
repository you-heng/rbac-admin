<?php
declare (strict_types = 1);

namespace app\admin\model;

use think\Exception;

/**
 * @mixin \think\Model
 */
class InterfaceLogs extends Base
{
    protected $name = 'interface_logs';

    public function searchIdAttr($query, $value, $data)
    {
        $query->where('id', '=', $value);
    }

    public function searchUsernameAttr($query, $value, $data)
    {
        $query->where('username', 'like', '%' . $value . '%');
    }

    public function searchIpAttr($query, $value, $data)
    {
        $query->where('ip', '=', $value);
    }

    /**
     * @param $limit
     * @return \think\response\Json
     * 获取列表
     */
    public function get_logs_list($limit)
    {
        try {
            $result = $this->order('create_time', 'desc')->paginate($limit);
            if($result->isEmpty()){
                return api_message('暂无内容~', 201);
            }
            return api_message('请求成功', 200, $result);
        }catch (Exception $e){
            return api_message($e->getMessage(), 201);
        }
    }

    /**
     * @param $id
     * @return bool
     * 删除
     */
    public function remove_logs($id)
    {
        return $this->destroy($id);
    }

    /**
     * @return bool
     * 清空
     */
    public function remove_logs_all()
    {
        return $this->where('1=1')->delete();
    }

    /**
     * @param $data
     * @return InterfaceLogs[]|array|\think\Collection|\think\response\Json
     * 搜索
     */
    public function search($data)
    {
        try {
            return $this->withSearch([$data['select']], [$data['select'] => $data['search']])->select();
        }catch (Exception $e){
            return api_message($e->getMessage(), 201);
        }
    }

    /**
     * @param $type
     * @param $ids
     * @return InterfaceLogs[]|array|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     * 导出
     */
    public function down($type, $ids=[])
    {
        if($type === 1){
            return $this->where('id', 'in', $ids)->select();
        }else{
            return $this->select();
        }
    }
}
