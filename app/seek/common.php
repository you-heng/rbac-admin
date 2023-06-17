<?php
// 这是系统自动生成的公共文件

/**
 * 按照顺序获取当前文件名
 * @param $path
 * @return int
 */
function get_num_name($path)
{
    $num = scandir($path);
    return count($num) - 2 + 1;
}

/**
 * 清空文件夹中的文件
 * @param $dirname
 * @return bool
 */
function file_clear($dirname)
{
    return unlink($dirname);
}