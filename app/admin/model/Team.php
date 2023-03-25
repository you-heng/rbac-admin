<?php
declare (strict_types = 1);

namespace app\admin\model;

use think\Exception;
use app\admin\validate\Team as teamValidate;
use think\exception\ValidateException;

/**
 * @mixin \think\Model
 */
class Team extends Base
{
    // 设置json类型字段
    protected $json = ['p_ids'];

    // 设置JSON数据返回数组
    protected $jsonAssoc = true;

    /**
     * @return array|\think\response\Json
     * 获取团队列表
     */
    public function get_team_list()
    {
        try {
            $result = $this->order('sort', 'desc')->order('sort', 'desc')->select();
            if($result){
                $data = get_p_name($result, '顶级部门', 'team_name');
                return tree_data($data);
            }
            return api_message('暂无内容~', 201);
        }catch (Exception $e){
            return api_message($e->getMessage());
        }
    }

    /**
     * @param $data
     * @return Team|\think\Model
     * 添加团队
     */
    public function create_team($data)
    {
        $this->check($data, 'create');
        return $this->insertGetId($data);
    }

    /**
     * @param $data
     * @return Team
     * 编辑团队
     */
    public function update_team($data)
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
            validate(teamValidate::class)->scene($scene)->check($data);
        }catch (ValidateException $e){
            return api_message($e->getMessage());
        }
    }

    /**
     * @param $id
     * @return bool
     * 删除
     */
    public function remove_team($id)
    {
        return $this->destroy($id);
    }

    /**
     * @return bool
     * 清空
     */
    public function remove_team_all()
    {
        return $this->where('id', '<>', 1)->delete();
    }

    /**
     * @return Team
     * 状态
     */
    public function is_state($id, $is_state)
    {
        return $this->update(['id' => $id, 'is_state' => $is_state]);
    }

}
