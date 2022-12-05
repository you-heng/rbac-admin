rbac-admin
===============

当前系统是由`Vue3`前端和`ThinkPHP6`完成的权限管理系统

运行环境：`PHP7.4+mysql5.7+nginx1.2+reids`

## 命名规范

请理解并尽量遵循以下命名规范，可以减少在开发过程中出现不必要的错误

`ThinkPHP6.0`遵循`PSR-2`命名规范和`PSR-4`自动加载规范

### 目录和文件

- 目录使用小写+下划线；
- 类库、函数文件统一以`.php`为后缀；
- 类的文件名均以命名空间定义，并且命名空间的路径和类库文件所在路径一致；
- 类（包含接口和Trait）文件采用驼峰法命名（首字母大写），其它文件采用小写+下划线命名；
- 类名（包括接口和Trait）和文件名保持一致，统一采用驼峰法命名（首字母大写）；

### 函数和类、属性命名

- 类的命名采用驼峰法（首字母大写），例如 `User`、`UserType`；
- 函数的命名使用小写字母和下划线（小写字母开头）的方式，例如 `get_client_ip`；
- 方法的命名使用小写字母和下划线（小写字母开头）的方式，例如 `get_client_ip`；
- 属性的命名使用驼峰法（首字母小写），例如 `tableName`、`instance`；
- 特例：以双下划线`__`打头的函数或方法作为魔术方法，例如 `__call` 和 `__autoload`；

### 常量和配置

- 常量以大写字母和下划线命名，例如 `APP_PATH`；
- 配置参数以小写字母和下划线命名，例如 `url_route_on` 和`url_convert`；
- 环境变量定义使用大写字母和下划线命名，例如`APP_DEBUG`；

### 数据表和字段

- 数据表和字段采用小写加下划线方式命名，并注意字段名不要以下划线开头，例如 `think_user` 表和 `user_name`字段，不建议使用驼峰和中文作为数据表及字段命名。

> 请避免使用PHP保留字（保留字列表参见 <http://php.net/manual/zh/reserved.keywords.php> ）作为常量、类名和方法名，以及命名空间的命名，否则会造成系统错误。

## 目录结构

```
app ----------------------------------- 应用目录
    admin ----------------------------- 应用
        config ------------------------ 配置目录
            app.php ------------------- 应用配置
        controller -------------------- 控制器
            Admin.php
            Auth.php
            Base.php
            Common.php
            Dict.php
            Error.php
            Index.php
            Job.php
            Record.php
            Role.php
            Team.php
        middleware -------------------- 中间件目录
            Auth.php
            Check.php
            Logs.php
        model ------------------------- 模型目录
            Admin.php
            Auth.php
            Base.php
            Dict.php
            Job.php
            Record.php
            Role.php
            Team.php
        view
        common.php ------------------- 公共函数文件
        event.php 
        middleware.php --------------- 中间件文件
    error ---------------------------- error
        404.json --------------------- 错误
config ------------------------------- 全部配置
database ----------------------------- 数据库迁移
extend ------------------------------- 扩展类目录
public ------------------------------- 入口目录
    index.php ------------------------ 入口文件
route -------------------------------- 路由定义目录
runtime ------------------------------ 应用运行时目录
vendor ------------------------------- composer类库目录
view --------------------------------- 视图目录
.env --------------------------------- 环境变量
composer.json ------------------------ composer定义文件
README.md ---------------------------- README文件
think -------------------------------- 命令行入口文件
```

## 问题

1. 前后端分离的验证码

`composer`下载`think-captcha`

在`vendor/topthink/think-captcha/src/Captcha.php`文件中增加以下代码

```php
use think\facade\Cache;

/**
 * 前后端分离创建验证码
 * @return array
 * @throws Exception
 */
protected function generate_isolate(): array
{
    $bag = '';

    if ($this->math) {
        $this->useZh  = false;
        $this->length = 5;

        $x   = random_int(10, 30);
        $y   = random_int(1, 9);
        $bag = "{$x} + {$y} = ";
        $key = $x + $y;
        $key .= '';
    } else {
        if ($this->useZh) {
            $characters = preg_split('/(?<!^)(?!$)/u', $this->zhSet);
        } else {
            $characters = str_split($this->codeSet);
        }

        for ($i = 0; $i < $this->length; $i++) {
            $bag .= $characters[rand(0, count($characters) - 1)];
        }

        $key = mb_strtolower($bag, 'UTF-8');
    }

    $hash = password_hash($key, PASSWORD_BCRYPT, ['cost' => 10]);

    Cache::set($hash, $bag, 300);

    return [
        'value' => $bag,
        'key'   => $hash,
    ];
}

/**
 * 前后端分离验证验证码是否正确
 * @access public
 * @param string $code 用户验证码
 * @return bool 用户验证码是否正确
 */
public function check_isolate(string $code, string $key): bool
{
    if (!Cache::get($key)) {
        return false;
    }

    $code = mb_strtolower($code, 'UTF-8');

    $res = password_verify($code, $key);

    if ($res) {
        Cache::delete($key);
    }

    return $res;
}


/**
 * 前后端分离输出验证码并把验证码的值保存的Cache中
 * @access public
 * @param null|string $config
 * @param bool        $api
 * @return Response
 */
public function create_isolate(string $config = null, bool $api = false)
{
    $this->configure($config);

    $generator = $this->generate_isolate();

    // 图片宽(px)
    $this->imageW || $this->imageW = $this->length * $this->fontSize * 1.5 + $this->length * $this->fontSize / 2;
    // 图片高(px)
    $this->imageH || $this->imageH = $this->fontSize * 2.5;
    // 建立一幅 $this->imageW x $this->imageH 的图像
    $this->im = imagecreate((int) $this->imageW, (int) $this->imageH);
    // 设置背景
    imagecolorallocate($this->im, $this->bg[0], $this->bg[1], $this->bg[2]);

    // 验证码字体随机颜色
    $this->color = imagecolorallocate($this->im, mt_rand(1, 150), mt_rand(1, 150), mt_rand(1, 150));

    // 验证码使用随机字体
    $ttfPath = __DIR__ . '/../assets/' . ($this->useZh ? 'zhttfs' : 'ttfs') . '/';

    if (empty($this->fontttf)) {
        $dir  = dir($ttfPath);
        $ttfs = [];
        while (false !== ($file = $dir->read())) {
            if (substr($file, -4) == '.ttf' || substr($file, -4) == '.otf') {
                $ttfs[] = $file;
            }
        }
        $dir->close();
        $this->fontttf = $ttfs[array_rand($ttfs)];
    }

    $fontttf = $ttfPath . $this->fontttf;

    if ($this->useImgBg) {
        $this->background();
    }

    if ($this->useNoise) {
        // 绘杂点
        $this->writeNoise();
    }
    if ($this->useCurve) {
        // 绘干扰线
        $this->writeCurve();
    }

    // 绘验证码
    $text = $this->useZh ? preg_split('/(?<!^)(?!$)/u', $generator['value']) : str_split($generator['value']); // 验证码

    foreach ($text as $index => $char) {

        $x     = $this->fontSize * ($index + 1) * ($this->math ? 1 : 1.5);
        $y     = $this->fontSize + mt_rand(10, 20);
        $angle = $this->math ? 0 : mt_rand(-40, 40);

        imagettftext($this->im, $this->fontSize, $angle, (int) $x, (int) $y, $this->color, $fontttf, $char);
    }

    ob_start();
    // 输出图像
    imagepng($this->im);
    $content = ob_get_clean();
    imagedestroy($this->im);

    return json_encode([
        'key' => $generator['key'],
        'captcha' => 'data:image/png;base64,' . base64_encode($content)
    ]);
}
```

在`vendor/topthink/think-captcha/src/helper.php`文件中增加以下代码

```php
/**
 * 前后端分离验证
 * @param string $value
 * @return bool
 */
function captcha_isolate_check($value, $key)
{
    return Captcha::check_isolate($value, $key);
}

/**
 * 前后端分离验证码
 */
function create_isolate($config = null)
{
    return Captcha::create_isolate();
}
```

使用

```php
use think\captcha\facade\Captcha;

/**
 * 验证码
 * @return \think\Response
 */
public function captcha()
{
    return Captcha::create_isolate();
}

public function login()
{
    $data = Request::post();
    $captcha = Captcha::check_isolate($data['code'], $data['key']);
    if(!$captcha){
        return $this->message(201, '验证码错误');
    }
}
```