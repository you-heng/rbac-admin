<?php
declare (strict_types = 1);

namespace app\admin\controller;

use think\exception\ValidateException;
use think\facade\Request;
use app\admin\model\Dict as dictModel;
use Qiniu\Auth;
use Qiniu\Storage\UploadManager;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Common extends Base
{
    /**
     * @return \think\Response
     * @throws \Exception
     * 上传
     */
    public function upload()
    {
        $data = Request::file('file');
        try {
            validate(['file' => ['fileSize:102400,fileExt:gif,jpg,png']])->check(['file' => $data]);
        }catch (ValidateException $e){
            return $this->message($e->getMessage());
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
            return $this->message('上传失败', 201);
        }else{
            $ret['key'] = $config['pic_url'] . $ret['key'];
            return $this->message('上传成功', 200, $ret);
        }
    }

    /**
     * @param $filename
     * @param $head
     * @param $value
     * @param $data
     * @return void
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     * 导出execl
     */
    public function excel($filename, $head, $value, $data)
    {
        //实例化spreadsheet对象
        $spreadsheet = new Spreadsheet();
        //获取活动工作簿
        $sheet = $spreadsheet->getActiveSheet();
        // 循环设置表头
        $count = count($head);
        for($i=65; $i<$count + 65; $i++){
            $sheet->setCellValue(strtoupper(chr($i)) . '1', $head[$i - 65]);
        }
        // 设置单元格
        foreach($data as $k => $v){
            for($i = 65; $i<$count + 65; $i++){
                for ($i = 65; $i < $count + 65; $i++) {
                    //数字转字母从65开始：
                    $sheet->setCellValue(strtoupper(chr($i)) . ($k + 2), $v[$value[$i - 65]]);
                    //固定列宽
                    $spreadsheet->getActiveSheet()->getColumnDimension(strtoupper(chr($i)))->setWidth(20);
                }
            }
        }
        //MIME协议，文件的类型，不设置描绘默认html
        header('Content-Type:application/vnd.openxmlformats-officedoument.spreadsheetml.sheet');
        //MIME 协议的扩展
        header("Content-Disposition:attachment;filename={$filename}.xlsx");
        //缓存控制
        header('Cache-Control:max-age=0');

        $writer = IOFactory::createWriter($spreadsheet,'Xlsx');
        $writer->save('php://output');
    }
}
