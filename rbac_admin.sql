-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- 主机： localhost
-- 生成日期： 2022-12-05 15:34:41
-- 服务器版本： 5.7.26
-- PHP 版本： 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `rbac_admin`
--

-- --------------------------------------------------------

--
-- 表的结构 `rbac_admin`
--

CREATE TABLE `rbac_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户名',
  `password` char(32) COLLATE utf8_unicode_ci NOT NULL COMMENT '密码',
  `avatar` varchar(150) COLLATE utf8_unicode_ci NOT NULL COMMENT '头像',
  `phone` char(11) COLLATE utf8_unicode_ci NOT NULL COMMENT '手机号',
  `email` varchar(80) COLLATE utf8_unicode_ci NOT NULL COMMENT '邮箱',
  `role_ids` json NOT NULL COMMENT '角色id组',
  `team_ids` json NOT NULL COMMENT '部门id组',
  `job_id` int(11) NOT NULL COMMENT '岗位id',
  `sort` int(11) NOT NULL DEFAULT '1' COMMENT '排序',
  `is_state` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 1-启用 2-禁用',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `rbac_admin`
--

INSERT INTO `rbac_admin` (`id`, `username`, `password`, `avatar`, `phone`, `email`, `role_ids`, `team_ids`, `job_id`, `sort`, `is_state`, `create_time`) VALUES
(1, 'admin', '44209a6a592dea91bcf7d4dd53e47a5a', 'http://81.71.88.243/avatar.jpg', '15000000000', '123456@qq.com', '[\"超级管理员\"]', '[1, 3]', 2, 1, 1, '2022-12-05 04:51:17'),
(2, 'demo', '44209a6a592dea91bcf7d4dd53e47a5a', 'http://81.71.88.243/avatar.jpg', '15000000000', '123456@qq.com', '[\"演示\"]', '[1, 2]', 4, 0, 1, '2022-12-05 05:43:18');

-- --------------------------------------------------------

--
-- 表的结构 `rbac_auth`
--

CREATE TABLE `rbac_auth` (
  `id` int(11) NOT NULL,
  `title` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '权限名',
  `icon` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '字体图标',
  `path` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT '地址',
  `p_ids` json NOT NULL COMMENT '父级id组',
  `is_menu` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1-菜单 2-权限',
  `sort` int(11) NOT NULL DEFAULT '1' COMMENT '排序',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '修改时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `rbac_auth`
--

INSERT INTO `rbac_auth` (`id`, `title`, `icon`, `path`, `p_ids`, `is_menu`, `sort`, `create_time`, `update_time`) VALUES
(1, '系统管理', 'icon-xitong', '/system', '[0]', 1, 1, '2022-12-05 04:51:17', '2022-12-05 04:51:17'),
(2, '系统设置', 'icon-shezhi', '/config', '[0]', 1, 1, '2022-12-05 04:51:17', '2022-12-05 04:51:17'),
(3, '用户管理', 'icon-guanliyuan', '/system/admin', '[1]', 1, 1, '2022-12-05 04:51:17', '2022-12-05 04:51:17'),
(4, '角色管理', 'icon-jiaose', '/system/role', '[1]', 1, 1, '2022-12-05 04:51:17', '2022-12-05 04:51:17'),
(5, '权限管理', 'icon-quanxianpeizhi', '/system/auth', '[1]', 1, 1, '2022-12-05 04:51:17', '2022-12-05 04:51:17'),
(6, '部门管理', 'icon-tuandui', '/system/team', '[1]', 1, 1, '2022-12-05 04:51:17', '2022-12-05 04:51:17'),
(7, '职位管理', 'icon-zhiwei', '/system/job', '[1]', 1, 1, '2022-12-05 04:51:17', '2022-12-05 04:51:17'),
(8, '字典管理', 'icon-shujuzidian', '/config/dict', '[2]', 1, 1, '2022-12-05 04:51:17', '2022-12-05 04:51:17'),
(9, '日志管理', 'icon-peizhi', '/config/logs', '[2]', 1, 1, '2022-12-05 04:51:17', '2022-12-05 04:51:17'),
(10, '列表', NULL, '/console/admin/index', '[1, 3]', 2, 0, '2022-12-05 05:11:11', '2022-12-05 05:11:11'),
(11, '根据部门获取用户', NULL, '/console/admin/team', '[1, 3]', 2, 0, '2022-12-05 05:11:33', '2022-12-05 05:11:33'),
(12, '部门列表', NULL, '/console/team/index', '[1, 3]', 2, 0, '2022-12-05 05:12:43', '2022-12-05 05:12:43'),
(13, '职位列表', NULL, '/console/admin/job', '[1, 3]', 2, 0, '2022-12-05 05:13:12', '2022-12-05 05:13:12'),
(14, '角色列表', NULL, '/console/admin/role', '[1, 3]', 2, 0, '2022-12-05 05:13:33', '2022-12-05 05:13:33'),
(15, '新增', NULL, '/console/admin/create', '[1, 3]', 2, 0, '2022-12-05 05:13:53', '2022-12-05 05:13:53'),
(16, '状态', NULL, '/console/admin/is_state', '[1, 3]', 2, 0, '2022-12-05 05:14:08', '2022-12-05 05:14:08'),
(17, '编辑', NULL, '/console/admin/update', '[1, 3]', 2, 0, '2022-12-05 05:14:25', '2022-12-05 05:14:25'),
(18, '删除', NULL, '/console/admin/remove', '[1, 3]', 2, 0, '2022-12-05 05:14:38', '2022-12-05 05:14:38'),
(19, '搜索', NULL, '/console/admin/search', '[1, 3]', 2, 0, '2022-12-05 05:14:53', '2022-12-05 05:14:53'),
(20, '批量删除', NULL, '/console/admin/batch_remove', '[1, 3]', 2, 0, '2022-12-05 05:16:34', '2022-12-05 05:16:34'),
(21, '清空', NULL, '/console/admin/remove_all', '[1, 3]', 2, 0, '2022-12-05 05:16:53', '2022-12-05 05:16:53'),
(22, '批量导出', NULL, '/console/admin/batch_down', '[1, 3]', 2, 0, '2022-12-05 05:17:38', '2022-12-05 05:17:38'),
(23, '导出全部', NULL, '/console/admin/down_all', '[1, 3]', 2, 0, '2022-12-05 05:17:56', '2022-12-05 05:17:56'),
(24, '列表', NULL, '/console/role/index', '[1, 4]', 2, 0, '2022-12-05 05:18:57', '2022-12-05 05:18:57'),
(25, '权限列表', NULL, '/console/auth/index', '[1, 4]', 2, 0, '2022-12-05 05:19:20', '2022-12-05 05:19:20'),
(26, '授权', NULL, '/console/role/auth', '[1, 4]', 2, 0, '2022-12-05 05:19:34', '2022-12-05 05:19:34'),
(27, '新增', NULL, '/console/role/create', '[1, 4]', 2, 0, '2022-12-05 05:19:48', '2022-12-05 05:19:48'),
(28, '状态', NULL, '/console/role/is_state', '[1, 4]', 2, 0, '2022-12-05 05:20:01', '2022-12-05 05:20:01'),
(29, '编辑', NULL, '/console/role/update', '[1, 4]', 2, 0, '2022-12-05 05:20:17', '2022-12-05 05:20:17'),
(30, '删除', NULL, '/console/role/remove', '[1, 4]', 2, 0, '2022-12-05 05:20:33', '2022-12-05 05:20:33'),
(31, '搜索', NULL, '/console/role/search', '[1, 4]', 2, 0, '2022-12-05 05:20:47', '2022-12-05 05:20:47'),
(32, '批量删除', NULL, '/console/role/batch_remove', '[1, 4]', 2, 0, '2022-12-05 05:21:04', '2022-12-05 05:21:04'),
(33, '清空', NULL, '/console/role/remove_all', '[1, 4]', 2, 0, '2022-12-05 05:21:18', '2022-12-05 05:21:18'),
(34, '批量导出', NULL, '/console/role/batch_down', '[1, 4]', 2, 0, '2022-12-05 05:22:25', '2022-12-05 05:22:25'),
(35, '全部导出', NULL, '/console/role/down_all', '[1, 4]', 2, 0, '2022-12-05 05:22:48', '2022-12-05 05:22:48'),
(36, '列表', NULL, '/console/auth/index', '[1, 5]', 2, 0, '2022-12-05 05:26:11', '2022-12-05 05:26:11'),
(37, '新增', NULL, '/console/auth/create', '[1, 5]', 2, 0, '2022-12-05 05:26:40', '2022-12-05 05:26:40'),
(38, '编辑', NULL, '/console/auth/update', '[1, 5]', 2, 0, '2022-12-05 05:26:54', '2022-12-05 05:26:54'),
(39, '删除', NULL, '/console/auth/remove', '[1, 5]', 2, 0, '2022-12-05 05:27:14', '2022-12-05 05:27:14'),
(40, '清空', NULL, '/console/auth/remove_all', '[1, 5]', 2, 0, '2022-12-05 05:27:40', '2022-12-05 05:27:40'),
(41, '全部导出', NULL, '/console/auth/down_all', '[1, 5]', 2, 0, '2022-12-05 05:28:20', '2022-12-05 05:28:20'),
(42, '列表', NULL, '/console/team/index', '[1, 6]', 2, 0, '2022-12-05 05:28:48', '2022-12-05 05:28:48'),
(43, '新增', NULL, '/console/team/create', '[1, 6]', 2, 0, '2022-12-05 05:29:03', '2022-12-05 05:29:03'),
(44, '编辑', NULL, '/console/team/update', '[1, 6]', 2, 0, '2022-12-05 05:29:21', '2022-12-05 05:29:21'),
(45, '状态', NULL, '/console/role/is_state', '[1, 6]', 2, 0, '2022-12-05 05:29:41', '2022-12-05 05:29:41'),
(46, '删除', NULL, '/console/team/remove', '[1, 6]', 2, 0, '2022-12-05 05:29:58', '2022-12-05 05:29:58'),
(47, '清空', NULL, '/console/team/remove_all', '[1, 6]', 2, 0, '2022-12-05 05:30:19', '2022-12-05 05:30:19'),
(48, '全部导出', NULL, '/console/team/down_all', '[1, 6]', 2, 0, '2022-12-05 05:30:47', '2022-12-05 05:30:47'),
(49, '列表', NULL, '/console/job/index', '[1, 7]', 2, 0, '2022-12-05 05:31:57', '2022-12-05 05:31:57'),
(50, '新增', NULL, '/console/job/create', '[1, 7]', 2, 0, '2022-12-05 05:32:14', '2022-12-05 05:32:14'),
(51, '编辑', NULL, '/console/job/update', '[1, 7]', 2, 0, '2022-12-05 05:32:29', '2022-12-05 05:32:29'),
(52, '删除', NULL, '/console/job/remove', '[1, 7]', 2, 0, '2022-12-05 05:32:43', '2022-12-05 05:32:43'),
(53, '搜索', NULL, '/console/job/search', '[1, 7]', 2, 0, '2022-12-05 05:32:58', '2022-12-05 05:32:58'),
(54, '状态', NULL, '/console/job/is_state', '[1, 7]', 2, 0, '2022-12-05 05:33:15', '2022-12-05 05:33:15'),
(55, '批量删除', NULL, '/console/job/batch_remove', '[1, 7]', 2, 0, '2022-12-05 05:33:32', '2022-12-05 05:33:32'),
(56, '清空', NULL, '/console/job/remove_all', '[1, 7]', 2, 0, '2022-12-05 05:33:47', '2022-12-05 05:33:47'),
(57, '批量导出', NULL, '/console/job/batch_down', '[1, 7]', 2, 0, '2022-12-05 05:34:17', '2022-12-05 05:34:17'),
(58, '全部导出', NULL, '/console/job/down_all', '[1, 7]', 2, 0, '2022-12-05 05:34:33', '2022-12-05 05:34:33'),
(59, '列表', NULL, '/console/dict/index', '[2, 8]', 2, 0, '2022-12-05 05:35:09', '2022-12-05 05:35:09'),
(60, '新增', NULL, '/console/dict/create', '[2, 8]', 2, 0, '2022-12-05 05:35:22', '2022-12-05 05:35:22'),
(61, '编辑', NULL, '/console/dict/update', '[2, 8]', 2, 0, '2022-12-05 05:35:34', '2022-12-05 05:35:34'),
(62, '状态', NULL, '/console/dict/is_state', '[2, 8]', 2, 0, '2022-12-05 05:35:49', '2022-12-05 05:35:49'),
(63, '删除', NULL, '/console/dict/remove', '[2, 8]', 2, 0, '2022-12-05 05:36:08', '2022-12-05 05:36:08'),
(64, '搜索', NULL, '/console/dict/search', '[2, 8]', 2, 0, '2022-12-05 05:36:28', '2022-12-05 05:36:28'),
(65, '批量删除', NULL, '/console/dict/batch_remove', '[2, 8]', 2, 0, '2022-12-05 05:36:42', '2022-12-05 05:36:42'),
(66, '清空', NULL, '/console/dict/remove_all', '[2, 8]', 2, 0, '2022-12-05 05:37:40', '2022-12-05 05:37:40'),
(67, '批量导出', NULL, '/console/dict/batch_down', '[2, 8]', 2, 0, '2022-12-05 05:38:17', '2022-12-05 05:38:17'),
(68, '全部导出', NULL, '/console/dict/down_all', '[2, 8]', 2, 0, '2022-12-05 05:38:30', '2022-12-05 05:38:30'),
(69, '列表', NULL, '/console/record/index', '[2, 9]', 2, 0, '2022-12-05 05:38:50', '2022-12-05 05:38:50'),
(70, '删除', NULL, '/console/record/remove', '[2, 9]', 2, 0, '2022-12-05 05:39:05', '2022-12-05 05:39:05'),
(71, '搜索', NULL, '/console/record/search', '[2, 9]', 2, 0, '2022-12-05 05:39:17', '2022-12-05 05:39:17'),
(72, '批量删除', NULL, '/console/record/batch_remove', '[2, 9]', 2, 0, '2022-12-05 05:39:35', '2022-12-05 05:39:35'),
(73, '清空', NULL, '/console/record/remove_all', '[2, 9]', 2, 0, '2022-12-05 05:39:50', '2022-12-05 05:39:50'),
(74, '批量导出', NULL, '/console/record/batch_down', '[2, 9]', 2, 0, '2022-12-05 05:40:28', '2022-12-05 05:40:28'),
(75, '全部导出', NULL, '/console/record/down_all', '[2, 9]', 2, 0, '2022-12-05 05:40:41', '2022-12-05 05:40:41');

-- --------------------------------------------------------

--
-- 表的结构 `rbac_dict`
--

CREATE TABLE `rbac_dict` (
  `id` int(11) NOT NULL,
  `key` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '配置名',
  `val` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT '配置值',
  `remark` varchar(80) COLLATE utf8_unicode_ci NOT NULL COMMENT '备注',
  `sort` int(11) NOT NULL DEFAULT '1' COMMENT '排序',
  `is_state` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 1-启用 2-禁用',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '修改时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `rbac_dict`
--

INSERT INTO `rbac_dict` (`id`, `key`, `val`, `remark`, `sort`, `is_state`, `create_time`, `update_time`) VALUES
(1, 'user_pass', '123456', '用户默认密码', 1, 1, '2022-12-05 04:51:17', '2022-12-05 04:51:17'),
(2, 'user_avatar', 'http://81.71.88.243/avatar.jpg', '用户默认头像', 1, 1, '2022-12-05 04:51:17', '2022-12-05 04:51:17'),
(3, 'sys_upload_url', 'http://sys.anmixiu.com/', '图片上传链接', 1, 1, '2022-12-05 04:51:17', '2022-12-05 04:51:17'),
(4, 'user_phone', '15000000000', '默认手机号码', 1, 1, '2022-12-05 04:51:17', '2022-12-05 04:51:17'),
(5, 'user_email', '123456@qq.com', '默认邮箱', 1, 1, '2022-12-05 04:51:17', '2022-12-05 04:51:17'),
(6, 'jwt_sub', 'http://rbac.com/', 'jwt所面向用户', 1, 1, '2022-12-05 04:51:17', '2022-12-05 04:51:17'),
(7, 'jwt_time', '86400', '过期时间->86400一天', 1, 1, '2022-12-05 04:51:17', '2022-12-05 04:51:17'),
(8, 'jwt_key', 'rbac.com', 'jwt的key', 1, 1, '2022-12-05 04:51:17', '2022-12-05 04:51:17'),
(9, 'pic_url', 'http://sys.anmixiu.com/', '上传图片的域名', 1, 1, '2022-12-05 04:51:17', '2022-12-05 04:51:17'),
(10, 'qiniu_access_key', 'uvBhV1VdIykjB5snuJQZs3JVARZQCEYUdkzj5dwu', '七牛云配置：accesskey', 1, 1, '2022-12-05 04:51:17', '2022-12-05 04:51:17'),
(11, 'qiniu_secret_key', 'QpwBv4uva8Ztqf-LNRsG_TEesbkpZ6uHEx_uvfpR', '七牛云配置：secretkey', 1, 1, '2022-12-05 04:51:17', '2022-12-05 04:51:17'),
(12, 'qiniu_bucket', 'system-upload', '七牛云配置：bucket', 1, 1, '2022-12-05 04:51:17', '2022-12-05 04:51:17'),
(13, 'white_list', '[\"\\/console\\/index\\/captcha\",\"\\/console\\/index\\/login\",\"\\/console\\/index\\/logout\",\"\\/console\\/index\\/config\",\"\\/console\\/auth\\/menu\"]', '接口白名单', 1, 1, '2022-12-05 04:51:17', '2022-12-05 04:51:17'),
(14, 'sys_title', '权限管理系统', '系统名称', 1, 1, '2022-12-05 04:51:17', '2022-12-05 04:51:17'),
(15, 'sys_log', '/vite.svg', '系统logo', 1, 1, '2022-12-05 04:51:17', '2022-12-05 04:51:17');

-- --------------------------------------------------------

--
-- 表的结构 `rbac_job`
--

CREATE TABLE `rbac_job` (
  `id` int(11) NOT NULL,
  `job_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '岗位名称',
  `sort` int(11) NOT NULL DEFAULT '1' COMMENT '排序',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '修改时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `rbac_job`
--

INSERT INTO `rbac_job` (`id`, `job_name`, `sort`, `create_time`, `update_time`) VALUES
(1, '前端', 1, '2022-12-05 04:51:17', '2022-12-05 04:51:17'),
(2, '后端', 1, '2022-12-05 04:51:17', '2022-12-05 04:51:17'),
(3, '测试', 1, '2022-12-05 04:51:17', '2022-12-05 04:51:17'),
(4, '演示', 0, '2022-12-05 05:43:04', '2022-12-05 05:43:04');

-- --------------------------------------------------------

--
-- 表的结构 `rbac_login_log`
--

CREATE TABLE `rbac_login_log` (
  `id` int(11) NOT NULL,
  `username` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '用户名',
  `path` varchar(80) COLLATE utf8_unicode_ci NOT NULL COMMENT 'uri',
  `ip` char(15) COLLATE utf8_unicode_ci NOT NULL COMMENT 'ip',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `rbac_login_log`
--

INSERT INTO `rbac_login_log` (`id`, `username`, `path`, `ip`, `create_time`) VALUES
(1, 'demo', '/console/auth/menu', '127.0.0.1', '2022-12-05 06:02:11'),
(2, 'demo', '/console/admin/index', '127.0.0.1', '2022-12-05 06:02:11'),
(3, 'demo', '/console/team/index', '127.0.0.1', '2022-12-05 06:02:11');

-- --------------------------------------------------------

--
-- 表的结构 `rbac_migrations`
--

CREATE TABLE `rbac_migrations` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `rbac_migrations`
--

INSERT INTO `rbac_migrations` (`version`, `migration_name`, `start_time`, `end_time`, `breakpoint`) VALUES
(20221004063113, 'RbacAdminTable', '2022-12-05 04:51:15', '2022-12-05 04:51:15', 0),
(20221004063232, 'RbacRoleTable', '2022-12-05 04:51:15', '2022-12-05 04:51:15', 0),
(20221004063255, 'RbacAuthTable', '2022-12-05 04:51:15', '2022-12-05 04:51:15', 0),
(20221004063310, 'RbacTeamTable', '2022-12-05 04:51:15', '2022-12-05 04:51:15', 0),
(20221004063330, 'RbacJobTable', '2022-12-05 04:51:15', '2022-12-05 04:51:15', 0),
(20221004063355, 'RbacDictTable', '2022-12-05 04:51:15', '2022-12-05 04:51:15', 0),
(20221122052454, 'RbacLoginLogTable', '2022-12-05 04:51:15', '2022-12-05 04:51:15', 0);

-- --------------------------------------------------------

--
-- 表的结构 `rbac_role`
--

CREATE TABLE `rbac_role` (
  `id` int(11) NOT NULL,
  `role_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '角色名',
  `intro` varchar(80) COLLATE utf8_unicode_ci NOT NULL COMMENT '角色描述',
  `menu_ids` json DEFAULT NULL COMMENT '菜单id组',
  `auth_ids` json DEFAULT NULL COMMENT '权限id组',
  `sort` int(11) NOT NULL DEFAULT '1' COMMENT '排序',
  `is_state` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 1-启用 2-禁用',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '修改时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `rbac_role`
--

INSERT INTO `rbac_role` (`id`, `role_name`, `intro`, `menu_ids`, `auth_ids`, `sort`, `is_state`, `create_time`, `update_time`) VALUES
(1, '超级管理员', '拥有至高无上的权限', '[\"*\"]', '[\"*\"]', 1, 1, '2022-12-05 04:51:17', '2022-12-05 04:51:17'),
(2, '演示', '拥有当前系统的读取权限', '[1, 3, 4, 5, 6, 7, 2, 8, 9]', '[10, 11, 12, 24, 36, 42, 49, 59, 69]', 0, 1, '2022-12-05 05:09:12', '2022-12-05 05:09:12');

-- --------------------------------------------------------

--
-- 表的结构 `rbac_team`
--

CREATE TABLE `rbac_team` (
  `id` int(11) NOT NULL,
  `team_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '部门名称',
  `p_ids` json NOT NULL COMMENT '父级id组',
  `sort` int(11) NOT NULL DEFAULT '1' COMMENT '排序',
  `is_state` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 1-启用 2-禁用',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '修改时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 转存表中的数据 `rbac_team`
--

INSERT INTO `rbac_team` (`id`, `team_name`, `p_ids`, `sort`, `is_state`, `create_time`, `update_time`) VALUES
(1, 'xxx公司', '[0]', 1, 1, '2022-12-05 04:51:17', '2022-12-05 04:51:17'),
(2, '管理部', '[1]', 1, 1, '2022-12-05 04:51:17', '2022-12-05 04:51:17'),
(3, '研发部', '[1]', 1, 1, '2022-12-05 04:51:17', '2022-12-05 04:51:17'),
(4, '客服部', '[1]', 1, 1, '2022-12-05 04:51:17', '2022-12-05 04:51:17');

--
-- 转储表的索引
--

--
-- 表的索引 `rbac_admin`
--
ALTER TABLE `rbac_admin`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `rbac_auth`
--
ALTER TABLE `rbac_auth`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `rbac_dict`
--
ALTER TABLE `rbac_dict`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `rbac_job`
--
ALTER TABLE `rbac_job`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `rbac_login_log`
--
ALTER TABLE `rbac_login_log`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `rbac_migrations`
--
ALTER TABLE `rbac_migrations`
  ADD PRIMARY KEY (`version`);

--
-- 表的索引 `rbac_role`
--
ALTER TABLE `rbac_role`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `rbac_team`
--
ALTER TABLE `rbac_team`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `rbac_admin`
--
ALTER TABLE `rbac_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `rbac_auth`
--
ALTER TABLE `rbac_auth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- 使用表AUTO_INCREMENT `rbac_dict`
--
ALTER TABLE `rbac_dict`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- 使用表AUTO_INCREMENT `rbac_job`
--
ALTER TABLE `rbac_job`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 使用表AUTO_INCREMENT `rbac_login_log`
--
ALTER TABLE `rbac_login_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `rbac_role`
--
ALTER TABLE `rbac_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `rbac_team`
--
ALTER TABLE `rbac_team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
