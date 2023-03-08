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
        /*$data = [
            0 => [
                'id' => 1,
                'title' => '系统管理',
                'icon' => 'icon-xitong',
                'path' => '/system',
                'p_ids' => json_encode([0]),
                'is_menu' => 1
            ],
            1 => [
                'id' => 2,
                'title' => '系统设置',
                'icon' => 'icon-shezhi',
                'path' => '/config',
                'p_ids' => json_encode([0]),
                'is_menu' => 1
            ],
            2 => [
                'id' => 3,
                'title' => '用户管理',
                'icon' => 'icon-guanliyuan',
                'path' => '/system/admin',
                'p_ids' => json_encode([1]),
                'is_menu' => 1
            ],
            3 => [
                'id' => 4,
                'title' => '角色管理',
                'icon' => 'icon-jiaose',
                'path' => '/system/role',
                'p_ids' => json_encode([1]),
                'is_menu' => 1
            ],
            4 => [
                'id' => 5,
                'title' => '权限管理',
                'icon' => 'icon-quanxianpeizhi',
                'path' => '/system/auth',
                'p_ids' => json_encode([1]),
                'is_menu' => 1
            ],
            5 => [
                'id' => 6,
                'title' => '部门管理',
                'icon' => 'icon-tuandui',
                'path' => '/system/team',
                'p_ids' => json_encode([1]),
                'is_menu' => 1
            ],
            6 => [
                'id' => 7,
                'title' => '职位管理',
                'icon' => 'icon-zhiwei',
                'path' => '/system/job',
                'p_ids' => json_encode([1]),
                'is_menu' => 1
            ],
            7 => [
                'id' => 8,
                'title' => '字典管理',
                'icon' => 'icon-shujuzidian',
                'path' => '/config/dict',
                'p_ids' => json_encode([2]),
                'is_menu' => 1
            ],
            8 => [
                'id' => 9,
                'title' => '日志管理',
                'icon' => 'icon-peizhi',
                'path' => '/config/logs',
                'p_ids' => json_encode([2]),
                'is_menu' => 1
            ],
        ];*/

        /*$data = [
            [
                "id" =>1,
                "title" =>"系统管理",
                "icon" =>"icon-xitong",
                "path" =>"/system",
                "p_ids" =>json_encode([0]),
                "is_menu" =>1,
                "sort" =>1
            ],
            [
                "id" =>2,
                "title" =>"系统设置",
                "icon" =>"icon-shezhi",
                "path" =>"/config",
                "p_ids" =>json_encode([0]),
                "is_menu" =>1,
                "sort" =>1
            ],
            [
                "id" =>3,
                "title" =>"用户管理",
                "icon" =>"icon-guanliyuan",
                "path" =>"/system/admin",
                "p_ids" =>json_encode([1]),
                "is_menu" =>1,
                "sort" =>1
            ],
            [
                "id" =>4,
                "title" =>"角色管理",
                "icon" =>"icon-jiaose",
                "path" =>"/system/role",
                "p_ids" =>json_encode([1]),
                "is_menu" =>1,
                "sort" =>1
            ],
            [
                "id" =>5,
                "title" =>"权限管理",
                "icon" =>"icon-quanxianpeizhi",
                "path" =>"/system/auth",
                "p_ids" =>json_encode([1]),
                "is_menu" =>1,
                "sort" =>1
            ],
            [
                "id" =>6,
                "title" =>"部门管理",
                "icon" =>"icon-tuandui",
                "path" =>"/system/team",
                "p_ids" =>json_encode([1]),
                "is_menu" =>1,
                "sort" =>1
            ],
            [
                "id" =>7,
                "title" =>"职位管理",
                "icon" =>"icon-zhiwei",
                "path" =>"/system/job",
                "p_ids" =>json_encode([1]),
                "is_menu" =>1,
                "sort" =>1
            ],
            [
                "id" =>8,
                "title" =>"字典管理",
                "icon" =>"icon-shujuzidian",
                "path" =>"/config/dict",
                "p_ids" =>json_encode([2]),
                "is_menu" =>1,
                "sort" =>1
            ],
            [
                "id" =>9,
                "title" =>"黑名单ip",
                "icon" =>"icon-shujuzidian",
                "path" =>"/config/black_list",
                "p_ids" =>json_encode([2]),
                "is_menu" =>1,
                "sort" =>1
            ],
            [
                "id" =>9,
                "title" =>"日志管理",
                "icon" =>"icon-peizhi",
                "path" =>"/config/logs",
                "p_ids" =>json_encode([2]),
                "is_menu" =>1,
                "sort" =>1
            ],
            [
                "id" =>10,
                "title" =>"列表",
                "icon" =>null,
                "path" =>"/console/admin/index",
                "p_ids" =>json_encode([1,3]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>11,
                "title" =>"根据部门获取用户",
                "icon" =>null,
                "path" =>"/console/admin/team",
                "p_ids" =>json_encode([1,3]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>12,
                "title" =>"部门列表",
                "icon" =>null,
                "path" =>"/console/team/index",
                "p_ids" =>json_encode([1,3]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>13,
                "title" =>"职位列表",
                "icon" =>null,
                "path" =>"/console/admin/job",
                "p_ids" =>json_encode([1,3]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>14,
                "title" =>"角色列表",
                "icon" =>null,
                "path" =>"/console/admin/role",
                "p_ids" =>json_encode([1,3]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>15,
                "title" =>"新增",
                "icon" =>null,
                "path" =>"/console/admin/create",
                "p_ids" =>json_encode([1,3]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>16,
                "title" =>"状态",
                "icon" =>null,
                "path" =>"/console/admin/is_state",
                "p_ids" =>json_encode([1,3]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>17,
                "title" =>"编辑",
                "icon" =>null,
                "path" =>"/console/admin/update",
                "p_ids" =>json_encode([1,3]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>18,
                "title" =>"删除",
                "icon" =>null,
                "path" =>"/console/admin/remove",
                "p_ids" =>json_encode([1,3]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>19,
                "title" =>"搜索",
                "icon" =>null,
                "path" =>"/console/admin/search",
                "p_ids" =>json_encode([1,3]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>20,
                "title" =>"批量删除",
                "icon" =>null,
                "path" =>"/console/admin/batch_remove",
                "p_ids" =>json_encode([1,3]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>21,
                "title" =>"清空",
                "icon" =>null,
                "path" =>"/console/admin/remove_all",
                "p_ids" =>json_encode([1,3]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>22,
                "title" =>"批量导出",
                "icon" =>null,
                "path" =>"/console/admin/batch_down",
                "p_ids" =>json_encode([1,3]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>23,
                "title" =>"导出全部",
                "icon" =>null,
                "path" =>"/console/admin/down_all",
                "p_ids" =>json_encode([1,3]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>24,
                "title" =>"列表",
                "icon" =>null,
                "path" =>"/console/role/index",
                "p_ids" =>json_encode([1,4]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>25,
                "title" =>"权限列表",
                "icon" =>null,
                "path" =>"/console/auth/index",
                "p_ids" =>json_encode([1,4]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>26,
                "title" =>"授权",
                "icon" =>null,
                "path" =>"/console/role/auth",
                "p_ids" =>json_encode([1,4]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>27,
                "title" =>"新增",
                "icon" =>null,
                "path" =>"/console/role/create",
                "p_ids" =>json_encode([1,4]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>28,
                "title" =>"状态",
                "icon" =>null,
                "path" =>"/console/role/is_state",
                "p_ids" =>json_encode([1,4]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>29,
                "title" =>"编辑",
                "icon" =>null,
                "path" =>"/console/role/update",
                "p_ids" =>json_encode([1,4]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>30,
                "title" =>"删除",
                "icon" =>null,
                "path" =>"/console/role/remove",
                "p_ids" =>json_encode([1,4]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>31,
                "title" =>"搜索",
                "icon" =>null,
                "path" =>"/console/role/search",
                "p_ids" =>json_encode([1,4]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>32,
                "title" =>"批量删除",
                "icon" =>null,
                "path" =>"/console/role/batch_remove",
                "p_ids" =>json_encode([1,4]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>33,
                "title" =>"清空",
                "icon" =>null,
                "path" =>"/console/role/remove_all",
                "p_ids" =>json_encode([1,4]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>34,
                "title" =>"批量导出",
                "icon" =>null,
                "path" =>"/console/role/batch_down",
                "p_ids" =>json_encode([1,4]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>35,
                "title" =>"全部导出",
                "icon" =>null,
                "path" =>"/console/role/down_all",
                "p_ids" =>json_encode([1,4]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>36,
                "title" =>"列表",
                "icon" =>null,
                "path" =>"/console/auth/index",
                "p_ids" =>json_encode([1,5]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>37,
                "title" =>"新增",
                "icon" =>null,
                "path" =>"/console/auth/create",
                "p_ids" =>json_encode([1,5]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>38,
                "title" =>"编辑",
                "icon" =>null,
                "path" =>"/console/auth/update",
                "p_ids" =>json_encode([1,5]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>39,
                "title" =>"删除",
                "icon" =>null,
                "path" =>"/console/auth/remove",
                "p_ids" =>json_encode([1,5]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>40,
                "title" =>"清空",
                "icon" =>null,
                "path" =>"/console/auth/remove_all",
                "p_ids" =>json_encode([1,5]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>41,
                "title" =>"全部导出",
                "icon" =>null,
                "path" =>"/console/auth/down_all",
                "p_ids" =>json_encode([1,5]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>42,
                "title" =>"列表",
                "icon" =>null,
                "path" =>"/console/team/index",
                "p_ids" =>json_encode([1,6]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>43,
                "title" =>"新增",
                "icon" =>null,
                "path" =>"/console/team/create",
                "p_ids" =>json_encode([1,6]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>44,
                "title" =>"编辑",
                "icon" =>null,
                "path" =>"/console/team/update",
                "p_ids" =>json_encode([1,6]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>45,
                "title" =>"状态",
                "icon" =>null,
                "path" =>"/console/role/is_state",
                "p_ids" =>json_encode([1,6]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>46,
                "title" =>"删除",
                "icon" =>null,
                "path" =>"/console/team/remove",
                "p_ids" =>json_encode([1,6]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>47,
                "title" =>"清空",
                "icon" =>null,
                "path" =>"/console/team/remove_all",
                "p_ids" =>json_encode([1,6]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>48,
                "title" =>"全部导出",
                "icon" =>null,
                "path" =>"/console/team/down_all",
                "p_ids" =>json_encode([1,6]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>49,
                "title" =>"列表",
                "icon" =>null,
                "path" =>"/console/job/index",
                "p_ids" =>json_encode([1,7]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>50,
                "title" =>"新增",
                "icon" =>null,
                "path" =>"/console/job/create",
                "p_ids" =>json_encode([1,7]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>51,
                "title" =>"编辑",
                "icon" =>null,
                "path" =>"/console/job/update",
                "p_ids" =>json_encode([1,7]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>52,
                "title" =>"删除",
                "icon" =>null,
                "path" =>"/console/job/remove",
                "p_ids" =>json_encode([1,7]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>53,
                "title" =>"搜索",
                "icon" =>null,
                "path" =>"/console/job/search",
                "p_ids" =>json_encode([1,7]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>54,
                "title" =>"状态",
                "icon" =>null,
                "path" =>"/console/job/is_state",
                "p_ids" =>json_encode([1,7]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>55,
                "title" =>"批量删除",
                "icon" =>null,
                "path" =>"/console/job/batch_remove",
                "p_ids" =>json_encode([1,7]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>56,
                "title" =>"清空",
                "icon" =>null,
                "path" =>"/console/job/remove_all",
                "p_ids" =>json_encode([1,7]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>57,
                "title" =>"批量导出",
                "icon" =>null,
                "path" =>"/console/job/batch_down",
                "p_ids" =>json_encode([1,7]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>58,
                "title" =>"全部导出",
                "icon" =>null,
                "path" =>"/console/job/down_all",
                "p_ids" =>json_encode([1,7]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>59,
                "title" =>"列表",
                "icon" =>null,
                "path" =>"/console/dict/index",
                "p_ids" =>json_encode([2,8]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>60,
                "title" =>"新增",
                "icon" =>null,
                "path" =>"/console/dict/create",
                "p_ids" =>json_encode([2,8]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>61,
                "title" =>"编辑",
                "icon" =>null,
                "path" =>"/console/dict/update",
                "p_ids" =>json_encode([2,8]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>62,
                "title" =>"状态",
                "icon" =>null,
                "path" =>"/console/dict/is_state",
                "p_ids" =>json_encode([2,8]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>63,
                "title" =>"删除",
                "icon" =>null,
                "path" =>"/console/dict/remove",
                "p_ids" =>json_encode([2,8]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>64,
                "title" =>"搜索",
                "icon" =>null,
                "path" =>"/console/dict/search",
                "p_ids" =>json_encode([2,8]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>65,
                "title" =>"批量删除",
                "icon" =>null,
                "path" =>"/console/dict/batch_remove",
                "p_ids" =>json_encode([2,8]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>66,
                "title" =>"清空",
                "icon" =>null,
                "path" =>"/console/dict/remove_all",
                "p_ids" =>json_encode([2,8]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>67,
                "title" =>"批量导出",
                "icon" =>null,
                "path" =>"/console/dict/batch_down",
                "p_ids" =>json_encode([2,8]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>68,
                "title" =>"全部导出",
                "icon" =>null,
                "path" =>"/console/dict/down_all",
                "p_ids" =>json_encode([2,8]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>69,
                "title" =>"列表",
                "icon" =>null,
                "path" =>"/console/record/index",
                "p_ids" =>json_encode([2,9]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>70,
                "title" =>"删除",
                "icon" =>null,
                "path" =>"/console/record/remove",
                "p_ids" =>json_encode([2,9]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>71,
                "title" =>"搜索",
                "icon" =>null,
                "path" =>"/console/record/search",
                "p_ids" =>json_encode([2,9]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>72,
                "title" =>"批量删除",
                "icon" =>null,
                "path" =>"/console/record/batch_remove",
                "p_ids" =>json_encode([2,9]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>73,
                "title" =>"清空",
                "icon" =>null,
                "path" =>"/console/record/remove_all",
                "p_ids" =>json_encode([2,9]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>74,
                "title" =>"批量导出",
                "icon" =>null,
                "path" =>"/console/record/batch_down",
                "p_ids" =>json_encode([2,9]),
                "is_menu" =>2,
                "sort" =>0
            ],
            [
                "id" =>75,
                "title" =>"全部导出",
                "icon" =>null,
                "path" =>"/console/record/down_all",
                "p_ids" =>json_encode([2,9]),
                "is_menu" =>2,
                "sort" =>0
            ]
        ];*/

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
                "title" =>"黑名单ip",
                "icon" =>"icon-shujuzidian",
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