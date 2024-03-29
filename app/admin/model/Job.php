<?php
declare (strict_types = 1);

namespace app\admin\model;

use app\admin\controller\Common;
use think\exception\ValidateException;
use app\admin\validate\Job as jobValidate;
use think\Exception;

/**
 * @mixin \think\Model
 */
class Job extends Base
{
    protected $name = 'job';

    public function searchJobNameAttr($query, $value, $data)
    {
        $query->where('job_name', 'like', '%' . $value .'%');
    }

    public function searchIdAttr($query, $value, $data)
    {
        $query->where('id', '=', $value);
    }

    /**
     * @param $limit
     * @return \think\response\Json
     * 获取职位列表
     */
    public function get_job_list($limit)
    {
        try {
            $result = $this->order('sort', 'desc')->paginate($limit);
            if($result){
                return api_message('请求成功', 200, $result);
            }
            return api_message('暂无内容~', 201);
        }catch (Exception $e){
            return api_message($e->getMessage(), 201);
        }
    }

    /**
     * @param $data
     * @return int|string
     * 添加
     */
    public function create_job($data)
    {
        $this->check($data, 'create');
        return $this->insertGetId($data);
    }

    /**
     * @param $data
     * @return Job
     * 编辑
     */
    public function update_job($data)
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
            validate(jobValidate::class)->scene($scene)->check($data);
        }catch (ValidateException $e){
            return api_message($e->getMessage(), 201);
        }
    }

    /**
     * @param $id
     * @return bool
     * 删除
     */
    public function remove_job($id)
    {
        return $this->destroy($id);
    }

    /**
     * @return bool
     * 清空
     */
    public function remove_job_all()
    {
        return $this->where('1=1')->delete();
    }

    /**
     * @param $data
     * @return Job[]|array|\think\Collection|\think\response\Json
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
     * @param $id
     * @param $is_state
     * @return Job
     * 状态
     */
    public function is_state($id, $is_state)
    {
        return $this->where('id', $id)->update(['is_state' => $is_state]);
    }

    /**
     * @param $type
     * @param $ids
     * @return Job[]|array|\think\Collection
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
        $filename = '职位列表';
        $head = ['ID', '岗位名称', '排序', '创建时间'];
        $value = ['id', 'job_name', 'sort', 'create_time'];
        $common = new Common();
        $common->excel($filename, $head, $value, $result);
    }
}
