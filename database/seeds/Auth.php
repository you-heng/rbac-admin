<?php

use think\migration\Seeder;

class Auth extends Seeder
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $data = [
            [
                "title" =>"系统管理",
                "icon" =>"icon-xitong",
                "path" =>"/system",
                "p_ids" =>json_encode([0]),
                "is_menu" =>1,
                "sort" =>1
            ],
            [
                "title" =>"系统设置",
                "icon" =>"icon-shezhi",
                "path" =>"/config",
                "p_ids" =>json_encode([0]),
                "is_menu" =>1,
                "sort" =>1
            ],
            [
                "title" =>"用户管理",
                "icon" =>"icon-guanliyuan",
                "path" =>"/system/admin",
                "p_ids" =>json_encode([1]),
                "is_menu" =>1,
                "sort" =>1
            ],
            [
                "title" =>"角色管理",
                "icon" =>"icon-jiaose",
                "path" =>"/system/role",
                "p_ids" =>json_encode([1]),
                "is_menu" =>1,
                "sort" =>1
            ],
            [
                "title" =>"权限管理",
                "icon" =>"icon-quanxianpeizhi",
                "path" =>"/system/auth",
                "p_ids" =>json_encode([1]),
                "is_menu" =>1,
                "sort" =>1
            ],
            [
                "title" =>"部门管理",
                "icon" =>"icon-tuandui",
                "path" =>"/system/team",
                "p_ids" =>json_encode([1]),
                "is_menu" =>1,
                "sort" =>1
            ],
            [
                "title" =>"职位管理",
                "icon" =>"icon-zhiwei",
                "path" =>"/system/job",
                "p_ids" =>json_encode([1]),
                "is_menu" =>1,
                "sort" =>1
            ],
            [
                "title" =>"字典管理",
                "icon" =>"icon-shujuzidian",
                "path" =>"/config/dict",
                "p_ids" =>json_encode([2]),
                "is_menu" =>1,
                "sort" =>1
            ],
            [
                "title" =>"ip防火墙",
                "icon" =>"icon-ip",
                "path" =>"/config/black-list",
                "p_ids" =>json_encode([2]),
                "is_menu" =>1,
                "sort" =>1
            ],
            [
                "title" =>"日志管理",
                "icon" =>"icon-peizhi",
                "path" =>"/config/interface-logs",
                "p_ids" =>json_encode([2]),
                "is_menu" =>1,
                "sort" =>1
            ],
            [
                "title" =>"列表",
                "icon" =>null,
                "path" =>"/console/admin/index",
                "p_ids" =>json_encode([1,3]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"根据部门获取用户",
                "icon" =>null,
                "path" =>"/console/admin/team",
                "p_ids" =>json_encode([1,3]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"部门列表",
                "icon" =>null,
                "path" =>"/console/team/index",
                "p_ids" =>json_encode([1,3]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"职位列表",
                "icon" =>null,
                "path" =>"/console/admin/job",
                "p_ids" =>json_encode([1,3]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"角色列表",
                "icon" =>null,
                "path" =>"/console/admin/role",
                "p_ids" =>json_encode([1,3]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"新增",
                "icon" =>null,
                "path" =>"/console/admin/create",
                "p_ids" =>json_encode([1,3]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"状态",
                "icon" =>null,
                "path" =>"/console/admin/is_state",
                "p_ids" =>json_encode([1,3]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"编辑",
                "icon" =>null,
                "path" =>"/console/admin/update",
                "p_ids" =>json_encode([1,3]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"删除",
                "icon" =>null,
                "path" =>"/console/admin/remove",
                "p_ids" =>json_encode([1,3]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"搜索",
                "icon" =>null,
                "path" =>"/console/admin/search",
                "p_ids" =>json_encode([1,3]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"批量删除",
                "icon" =>null,
                "path" =>"/console/admin/batch_remove",
                "p_ids" =>json_encode([1,3]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"清空",
                "icon" =>null,
                "path" =>"/console/admin/remove_all",
                "p_ids" =>json_encode([1,3]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"批量导出",
                "icon" =>null,
                "path" =>"/console/admin/batch_down",
                "p_ids" =>json_encode([1,3]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"导出全部",
                "icon" =>null,
                "path" =>"/console/admin/down_all",
                "p_ids" =>json_encode([1,3]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"列表",
                "icon" =>null,
                "path" =>"/console/role/index",
                "p_ids" =>json_encode([1,4]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"权限列表",
                "icon" =>null,
                "path" =>"/console/auth/index",
                "p_ids" =>json_encode([1,4]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"授权",
                "icon" =>null,
                "path" =>"/console/role/auth",
                "p_ids" =>json_encode([1,4]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"新增",
                "icon" =>null,
                "path" =>"/console/role/create",
                "p_ids" =>json_encode([1,4]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"状态",
                "icon" =>null,
                "path" =>"/console/role/is_state",
                "p_ids" =>json_encode([1,4]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"编辑",
                "icon" =>null,
                "path" =>"/console/role/update",
                "p_ids" =>json_encode([1,4]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"删除",
                "icon" =>null,
                "path" =>"/console/role/remove",
                "p_ids" =>json_encode([1,4]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"搜索",
                "icon" =>null,
                "path" =>"/console/role/search",
                "p_ids" =>json_encode([1,4]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"批量删除",
                "icon" =>null,
                "path" =>"/console/role/batch_remove",
                "p_ids" =>json_encode([1,4]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"清空",
                "icon" =>null,
                "path" =>"/console/role/remove_all",
                "p_ids" =>json_encode([1,4]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"批量导出",
                "icon" =>null,
                "path" =>"/console/role/batch_down",
                "p_ids" =>json_encode([1,4]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"全部导出",
                "icon" =>null,
                "path" =>"/console/role/down_all",
                "p_ids" =>json_encode([1,4]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"列表",
                "icon" =>null,
                "path" =>"/console/auth/index",
                "p_ids" =>json_encode([1,5]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"新增",
                "icon" =>null,
                "path" =>"/console/auth/create",
                "p_ids" =>json_encode([1,5]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"编辑",
                "icon" =>null,
                "path" =>"/console/auth/update",
                "p_ids" =>json_encode([1,5]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"删除",
                "icon" =>null,
                "path" =>"/console/auth/remove",
                "p_ids" =>json_encode([1,5]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"清空",
                "icon" =>null,
                "path" =>"/console/auth/remove_all",
                "p_ids" =>json_encode([1,5]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"全部导出",
                "icon" =>null,
                "path" =>"/console/auth/down_all",
                "p_ids" =>json_encode([1,5]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"列表",
                "icon" =>null,
                "path" =>"/console/team/index",
                "p_ids" =>json_encode([1,6]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"新增",
                "icon" =>null,
                "path" =>"/console/team/create",
                "p_ids" =>json_encode([1,6]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"编辑",
                "icon" =>null,
                "path" =>"/console/team/update",
                "p_ids" =>json_encode([1,6]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"状态",
                "icon" =>null,
                "path" =>"/console/role/is_state",
                "p_ids" =>json_encode([1,6]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"删除",
                "icon" =>null,
                "path" =>"/console/team/remove",
                "p_ids" =>json_encode([1,6]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"清空",
                "icon" =>null,
                "path" =>"/console/team/remove_all",
                "p_ids" =>json_encode([1,6]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"全部导出",
                "icon" =>null,
                "path" =>"/console/team/down_all",
                "p_ids" =>json_encode([1,6]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"列表",
                "icon" =>null,
                "path" =>"/console/job/index",
                "p_ids" =>json_encode([1,7]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"新增",
                "icon" =>null,
                "path" =>"/console/job/create",
                "p_ids" =>json_encode([1,7]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"编辑",
                "icon" =>null,
                "path" =>"/console/job/update",
                "p_ids" =>json_encode([1,7]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"删除",
                "icon" =>null,
                "path" =>"/console/job/remove",
                "p_ids" =>json_encode([1,7]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"搜索",
                "icon" =>null,
                "path" =>"/console/job/search",
                "p_ids" =>json_encode([1,7]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"状态",
                "icon" =>null,
                "path" =>"/console/job/is_state",
                "p_ids" =>json_encode([1,7]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"批量删除",
                "icon" =>null,
                "path" =>"/console/job/batch_remove",
                "p_ids" =>json_encode([1,7]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"清空",
                "icon" =>null,
                "path" =>"/console/job/remove_all",
                "p_ids" =>json_encode([1,7]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"批量导出",
                "icon" =>null,
                "path" =>"/console/job/batch_down",
                "p_ids" =>json_encode([1,7]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"全部导出",
                "icon" =>null,
                "path" =>"/console/job/down_all",
                "p_ids" =>json_encode([1,7]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"列表",
                "icon" =>null,
                "path" =>"/console/dict/index",
                "p_ids" =>json_encode([2,8]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"新增",
                "icon" =>null,
                "path" =>"/console/dict/create",
                "p_ids" =>json_encode([2,8]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"编辑",
                "icon" =>null,
                "path" =>"/console/dict/update",
                "p_ids" =>json_encode([2,8]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"状态",
                "icon" =>null,
                "path" =>"/console/dict/is_state",
                "p_ids" =>json_encode([2,8]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"删除",
                "icon" =>null,
                "path" =>"/console/dict/remove",
                "p_ids" =>json_encode([2,8]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"搜索",
                "icon" =>null,
                "path" =>"/console/dict/search",
                "p_ids" =>json_encode([2,8]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"批量删除",
                "icon" =>null,
                "path" =>"/console/dict/batch_remove",
                "p_ids" =>json_encode([2,8]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"清空",
                "icon" =>null,
                "path" =>"/console/dict/remove_all",
                "p_ids" =>json_encode([2,8]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"批量导出",
                "icon" =>null,
                "path" =>"/console/dict/batch_down",
                "p_ids" =>json_encode([2,8]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"全部导出",
                "icon" =>null,
                "path" =>"/console/dict/down_all",
                "p_ids" =>json_encode([2,8]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"列表",
                "icon" =>null,
                "path" =>"/console/black-list/index",
                "p_ids" =>json_encode([2,9]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"新增",
                "icon" =>null,
                "path" =>"/console/black-list/create",
                "p_ids" =>json_encode([2,9]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"编辑",
                "icon" =>null,
                "path" =>"/console/black-list/update",
                "p_ids" =>json_encode([2,9]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"状态",
                "icon" =>null,
                "path" =>"/console/black-list/is_state",
                "p_ids" =>json_encode([2,9]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"删除",
                "icon" =>null,
                "path" =>"/console/black-list/remove",
                "p_ids" =>json_encode([2,9]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"批量删除",
                "icon" =>null,
                "path" =>"/console/black-list/batch_remove",
                "p_ids" =>json_encode([2,9]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"清空",
                "icon" =>null,
                "path" =>"/console/black-list/remove_all",
                "p_ids" =>json_encode([2,9]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"批量导出",
                "icon" =>null,
                "path" =>"/console/black-list/batch_down",
                "p_ids" =>json_encode([2,9]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"全部导出",
                "icon" =>null,
                "path" =>"/console/black-list/down_all",
                "p_ids" =>json_encode([2,9]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"列表",
                "icon" =>null,
                "path" =>"/console/interface-logs/index",
                "p_ids" =>json_encode([2,10]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"删除",
                "icon" =>null,
                "path" =>"/console/interface-logs/remove",
                "p_ids" =>json_encode([2,10]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"搜索",
                "icon" =>null,
                "path" =>"/console/interface-logs/search",
                "p_ids" =>json_encode([2,10]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"批量删除",
                "icon" =>null,
                "path" =>"/console/interface-logs/batch_remove",
                "p_ids" =>json_encode([2,10]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"清空",
                "icon" =>null,
                "path" =>"/console/interface-logs/remove_all",
                "p_ids" =>json_encode([2,10]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"批量导出",
                "icon" =>null,
                "path" =>"/console/interface-logs/batch_down",
                "p_ids" =>json_encode([2,10]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "title" =>"全部导出",
                "icon" =>null,
                "path" =>"/console/interface-logs/down_all",
                "p_ids" =>json_encode([2,10]),
                "is_menu" =>2,
                "sort" =>0
            ]
        ];

        $seed = $this->table('auth');
        $seed->insert($data)->save();
    }
}