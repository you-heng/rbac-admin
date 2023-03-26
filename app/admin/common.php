<?php
// 这是系统自动生成的公共文件
use think\facade\Config;

// 加密
function encry($str)
{
    return md5(sha1(md5($str, Config::get('admin.password_salt'))));
}

// 判断结果
function is_true($str)
{
    return isset($str) ? '成功' : '失败';
}

// 判断字典类型
function is_type($type)
{
    $is_type = 0;
    switch ($type){
        case 'text':
            $is_type = 1;
            break;
        case 'json':
            $is_type = 2;
            break;
        case 'image':
            $is_type = 3;
            break;
    }
    return $is_type;
}

//根据token获取用户名
function get_name($token)
{

}

//图片上传
function upload_img()
{

}

//ip转真实地址
function ip_to_address()
{

}

// 菜单结构
function menu_tree($data){
    $menu = fields($data);
    foreach($menu as $k => $v){
        unset($menu[$k]['is_menu']);

        if(array_key_exists($v['pid'],$menu)){
            $menu[$v['pid']]['is_show'] = true;
        }
    }
    return $menu;
}

// 过滤字段
function fields($data){
    $menu = [];
    foreach($data as $v){
        $menu[$v['id']]['id'] = $v['id'];
        $menu[$v['id']]['name'] = $v['title'];
        $menu[$v['id']]['path'] = $v['path'];
        $menu[$v['id']]['icon'] = $v['icon'];
        $menu[$v['id']]['is_show'] = false;
        $menu[$v['id']]['pid'] = $v['p_ids'][count($v['p_ids']) - 1];
        $menu[$v['id']]['is_menu'] = $v['is_menu'];
    }
    return $menu;
}

// 获取父级名称
function get_p_name($data, $name, $file){
    $result = [];
    foreach($data as $v){
        $v['pid'] = $v['p_ids'][count($v['p_ids']) - 1];
        $result[$v['id']] = $v;
    }

    foreach($result as $k => $v){
        $result[$k]['p_name'] = $result[$k]['pid'] == 0 ? $name : $result[$v['pid']][$file];
    }
    return $result;
}

// 树形结构
function tree_data($data, $pid = 0)
{
    $tree = [];
    foreach($data as $v){
        if($v['pid'] == $pid){
            $v['children'] = tree_data($data, $v['id']);
            $tree[] = $v;
        }
    }
    return $tree;
}

// api列表接口结构
function api_message($msg = '成功', $code = 200, $data = [])
{
    return json([
        'code'  => $code,
        'msg'   => $msg,
        'data'  => $data
    ]);
}