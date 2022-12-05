<?php
declare (strict_types = 1);

namespace app\admin\controller;

use think\exception\ValidateException;
use think\facade\Request;
use app\admin\model\Dict as dictModel;
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Common extends Base
{
    // 上传
    public function upload()
    {
        $data = Request::file('file');
        try {
            validate(['file' => ['fileSize:102400,fileExt:gif,jpg,png']])->check(['file' => $data]);
        }catch (ValidateException $e){
            return $this->message(201, $e->getMessage());
        }
        $config = dictModel::where('key', 'in', ['qiniu_access_key', 'qiniu_secret_key', 'qiniu_bucket', 'pic_url'])->column('key,val');
        $config = array_column($config, 'val', 'key');
        $auth = new Auth($config['qiniu_access_key'], $config['qiniu_secret_key']);
        $token = $auth->uploadToken($config['qiniu_bucket']);
        $suffix = substr($data->getOriginalName(),strripos($data->getOriginalName(),".")+1);
        $key = md5($data->getOriginalName()) . '.' . $suffix;
        $uploadMgr = new UploadManager();
        list($ret, $err) = $uploadMgr->putFile($token, $key, $data->getPathname());
        if($err !== null){
            return $this->message(201, '上传失败');
        }else{
            $ret['key'] = $config['pic_url'] . $ret['key'];
            return $this->message(200, '上传成功', $ret);
        }
    }

    // 导出execl
    public function execl($spreadsheet)
    {
        $fileName = '('.date("Y-m-d",time()) .'导出）';
        //MIME协议，文件的类型，不设置描绘默认html
        header('Content-Type:application/vnd.openxmlformats-officedoument.spreadsheetml.sheet');
        //MIME 协议的扩展
        header("Content-Disposition:attachment;filename={$fileName}.xlsx");
        //缓存控制
        header('Cache-Control:max-age=0');

        $writer = IOFactory::createWriter($spreadsheet,'Xlsx');
        $writer->save('php://output');
    }
}
