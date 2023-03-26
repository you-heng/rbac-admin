<?php
declare (strict_types = 1);

namespace app\admin\model;

use think\Exception;
use think\exception\ValidateException;
use app\admin\validate\Dict as dictValidate;

/**
 * @mixin \think\Model
 */
class Dict extends Base
{
    public function searchIdAttr($query, $value, $data)
    {
        $query->where('id', '=', $value);
    }

    public function searchKeyAttr($query, $value, $data)
    {
        $query->where('key', 'like', '%' . $value . '%');
    }

    public function searchRemarkAttr($query, $value, $data)
    {
        $query->where('remark', 'like', '%' . $value . '%');
    }

    /**
     * @param $limit
     * @return \think\response\Json
     * 获取字段列表
     */
    public function get_dict_list($limit, $is_type)
    {
        try {
            $type = is_type($is_type);
            $result = $this->where('is_type', $type)->order('sort', 'desc')->paginate($limit);
            if($result->isEmpty()){
                return api_message('暂无内容~', 201);
            }
            return api_message('请求成功', 200, $this->type_change($is_type, $result));
        }catch (Exception $e){
            return api_message($e->getMessage(), 201);
        }
    }

    /**
     * @param $is_type
     * @param $data
     * @return array
     * 根据类型将数据转换成对应的结构
     */
    public function type_change($is_type, $data)
    {
        switch ($is_type){
            case 'json':
                foreach($data as $k => $v){
                    $temp = json_decode($v['val'], true);
                    $data[$k]['val'] = implode('+', $temp);
                }
                break;
            case 'image':
                foreach($data as $k => $v){
                    $data[$k]['val'] = json_decode($v['val'], true);
                }
                break;
        }
        return $data;
    }

    /**
     * @param $data
     * @return int|string
     * 添加
     */
    public function create_dict($data)
    {
        $this->check($data, 'create');
        $this->change($data);
        return $this->insertGetId($data);
    }

    /**
     * @param $data
     * @return Dict
     * 修改
     */
    public function update_dict($data)
    {
        $this->check($data, 'update');
        $this->change($data);
        return $this->update($data);
    }

    /**
     * @param $data
     * @return mixed
     * 入库前将内容转换成json类型
     */
    public function change($data)
    {
        switch ($data['is_type']){
            case 'json':
                $temp = explode('+', $data['val']);
                $data['val'] = json_encode($temp);
                break;
            case 'image':
                $data['val'] = json_encode($data['val']);
                break;
        }
        return $data;
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
            validate(dictValidate::class)->scene($scene)->check($data);
        }catch (ValidateException $e){
            return api_message($e->getMessage(), 201);
        }
    }

    /**
     * @param $id
     * @return bool
     * 删除
     */
    public function remove_dict($id)
    {
        return $this->destroy($id);
    }

    /**
     * @return bool
     * 清空
     */
    public function remove_dict_all()
    {
        return $this->where('1=1')->delete();
    }

    /**
     * @param $data
     * @return Dict[]|array|\think\Collection|\think\response\Json
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
     * @return Dict
     * 状态
     */
    public function is_state($id, $is_state)
    {
        return $this->where('id', $id)->update(['is_state' => $is_state]);
    }

    /**
     * @param $type
     * @param $ids
     * @return Dict[]|array|\think\Collection
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
