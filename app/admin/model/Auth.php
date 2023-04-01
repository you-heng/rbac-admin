<?php
declare (strict_types = 1);

namespace app\admin\model;

use app\admin\controller\Common;
use think\Exception;
use app\admin\validate\Auth as authValidate;
use think\exception\ValidateException;

/**
 * @mixin \think\Model
 */
class Auth extends Base
{
    // 设置json类型字段
    protected $json = ['p_ids'];

    // 设置JSON数据返回数组
    protected $jsonAssoc = true;

    /**
     * @return \think\response\Json
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     * 获取权限列表
     */
    public function get_auth_list()
    {
        try {
            $data = $this->order('sort', 'desc')->select();
            if($data->isEmpty()){
                return api_message('暂无内容~', 201);
            }
            $result = get_p_name($data, '顶级权限', 'title');
            $result = tree_data($result);
            return api_message('请求成功', 200, $result);
        }catch (Exception $e){
            return api_message($e->getMessage());
        }
    }

    /**
     * @param $data
     * @return int|string
     * 添加权限
     */
    public function create_auth($data)
    {
        $this->check($data, 'create');
        return $this->insertGetId($data);
    }

    /**
     * @param $data
     * @return Auth
     * 编辑权限
     */
    public function update_auth($data)
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
            validate(authValidate::class)->scene($scene)->check($data);
        }catch (ValidateException $e){
            return api_message($e->getMessage(), 204);
        }
    }

    /**
     * @param $id
     * @return bool
     * 删除
     */
    public function remove_auth($id)
    {
        return $this->destroy($id);
    }

    /**
     * @return bool
     * 清空
     */
    public function remove_auth_all()
    {
        return $this->where('is_menu',2)->delete();
    }

    /**
     * @return void
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     * 导出
     */
    public function down()
    {
        $result = $this->select();
        $result = get_p_name($result, '顶级权限', 'title');
        $filename = '角色列表';
        $head = ['ID', '权限名称', '地址', '父级权限', '类型', '排序', '创建时间'];
        $value = ['id', 'title', 'path', 'p_name', 'is_menu', 'sort', 'create_time'];
        $common = new Common();
        $common->excel($filename, $head, $value, $result);
    }
}
