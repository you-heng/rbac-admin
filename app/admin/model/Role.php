<?php
declare (strict_types = 1);

namespace app\admin\model;

use think\Exception;
use think\exception\ValidateException;
use app\admin\validate\Role as roleValidate;

/**
 * @mixin \think\Model
 */
class Role extends Base
{
    // 设置json类型字段
    protected $json = ['menu_ids', 'auth_ids'];

    // 设置JSON数据返回数组
    protected $jsonAssoc = true;

    public function searchRoleNameAttr($query, $value, $data)
    {
        $query->where('role_name', 'like', '%' . $value .'%');
    }

    public function searchIdAttr($query, $value, $data)
    {
        $query->where('id', '=', $value);
    }

    /**
     * @param $limit
     * @return \think\response\Json
     * 获取角色列表
     */
    public function get_rol_list($limit)
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
    public function create_role($data)
    {
        $this->check($data, 'create');
        return $this->insertGetId($data);
    }

    /**
     * @param $data
     * @return Role
     * 修改
     */
    public function update_role($data)
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
            validate(roleValidate::class)->scene($scene)->check($data);
        }catch (ValidateException $e){
            return api_message($e->getMessage(), 201);
        }
    }

    /**
     * @param $id
     * @return bool
     * 删除
     */
    public function remove_role($id)
    {
        return $this->destroy($id);
    }

    /**
     * @return bool
     * 清空
     */
    public function remove_role_all()
    {
        return $this->where('1=1')->delete();
    }

    /**
     * @param $data
     * @return Role[]|array|\think\Collection|\think\response\Json
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
     * @return Role
     * 状态
     */
    public function is_state($id, $is_state)
    {
        return $this->where('id', $id)->update(['is_state' => $is_state]);
    }

    /**
     * @param $type
     * @param $ids
     * @return Role[]|array|\think\Collection
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

    /**
     * @param $data
     * @return \think\response\Json
     * 授权
     */
    public function auth($data)
    {
        try {
            $result = $this->where('id', $data['id'])->update(['menu_ids' => $data['auths']['menu_ids'], 'auth_ids' => $data['auths']['auth_ids']]);
            if($result){
                return api_message('授权成功', 200, $result);
            }
            return api_message('授权失败', 201);
        }catch (Exception $e){
            return api_message($e->getMessage(), 201);
        }
    }
}
