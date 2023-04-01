<?php
declare (strict_types = 1);

namespace app\admin\model;

use app\admin\controller\Common;
use app\admin\validate\BlackList as blackListValidate;
use think\Exception;
use think\exception\ValidateException;

/**
 * @mixin \think\Model
 */
class BlackList extends Base
{
    // 设置表名
    protected $name = 'black_list';

    public function searchIdAttr($query, $value, $data)
    {
        $query->where('id', '=', $value);
    }

    public function searchIpAttr($query, $value, $data)
    {
        $query->where('ip', 'like', '%' . $value .'%');
    }

    /**
     * @param $limit
     * @return \think\response\Json
     * 获取黑名单列表
     */
    public function get_black_list($limit)
    {
        try {
            $result = $this->order('sort', 'desc')->paginate($limit);
            if($result->isEmpty()){
                return api_message('暂无内容~', 201);
            }
            return api_message('请求成功', 200, $result);
        }catch (Exception $e){
            return api_message($e->getMessage(), 201);
        }
    }

    /**
     * @param $data
     * @return int|string
     * 添加
     */
    public function create_black_list($data)
    {
        $this->check($data, 'create');
        return $this->insertGetId($data);
    }

    /**
     * @param $data
     * @return BlackList
     * 编辑
     */
    public function update_black_list($data)
    {
        $this->check($data, 'update');
        return $this->update($data);
    }

    /**
     * @param $data
     * @param $scene
     * @return \think\response\Json|void
     * 验证
     */
    public function check($data, $scene)
    {
        try {
            validate(blackListValidate::class)->scene($scene)->check($data);
        }catch (ValidateException $e){
            return api_message($e->getMessage(), 201);
        }
    }

    /**
     * @param $id
     * @return bool
     * 删除
     */
    public function remove_black_list($id)
    {
        return $this->destroy($id);
    }

    /**
     * @return bool
     * 清空
     */
    public function remove_black_list_all()
    {
        return $this->where('1=1')->delete();
    }

    /**
     * @param $id
     * @param $is_state
     * @return BlackList
     * 状态
     */
    public function is_state($id, $is_state)
    {
        return $this->where('id', $id)->update(['is_state' => $is_state]);
    }

    /**
     * @param $data
     * @return \think\response\Json
     * 搜索
     */
    public function search($data)
    {
        try {
            $result = $this->withSearch([$data['select']], [$data['select'] => $data['search']])->select();
            if($result->isEmpty()){
                return api_message('暂无内容~', 201);
            }
            return api_message('请求成功', 200, $result);
        }catch (Exception $e){
            return api_message($e->getMessage(), 201);
        }
    }

    /**
     * @param $type
     * @param $ids
     * @return BlackList[]|array|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     * 导出
     */
    public function down($type, $ids=[])
    {
        $result = [];
        if($type === 1){
            $result = $this->where('id', 'in', $ids)->select();
        }else{
            $result = $this->select();
        }
        $filename = 'IP防火墙列表';
        $head = ['ID', 'IP', '拉黑理由', '冻结时间', '类型', '状态', '排序', '创建时间'];
        $value = ['id', 'ip', 'reason', 'time', 'is_type', 'is_state', 'sort', 'create_time'];
        $common = new Common();
        $common->excel($filename, $head, $value, $result);
    }
}
