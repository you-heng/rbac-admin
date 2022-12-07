<?php
declare (strict_types = 1);

namespace app\admin\controller;

use app\admin\model\Job as jobModel;
use think\exception\ValidateException;
use think\facade\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use app\admin\validate\Job as jobValidate;

class Job extends Base
{
    /**
     * 列表
     * @return \think\Response
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function index()
    {
        $result = jobModel::page($this->page, $this->limit)->order('sort', 'desc')->select();
        if(!$result){
            return $this->message(201, '暂无内容~');
        }
        $count = jobModel::count('id');
        return $this->message(200, '请求成功', [
            'page' => $this->page,
            'limit' => $this->limit,
            'count' => $count,
            'data' => $result
        ]);
    }

    /**
     * 添加
     * @return \think\Response
     */
    public function create()
    {
        $data = Request::post();
        $this->check($data);
        $result = jobModel::create($data);
        if(!$result){
            return $this->message(201, '添加失败');
        }
        return $this->message(200, '添加成功');
    }

    /**
     * 编辑
     * @return \think\Response
     */
    public function update()
    {
        $data = Request::post();
        $this->check($data);
        $result = jobModel::update($data);
        if(!$result){
            return $this->message(201, '修改失败');
        }
        return $this->message(200, '修改成功');
    }

    /**
     * 验证
     * @param $data
     * @return \think\Response|void
     */
    public function check($data)
    {
        try {
            validate(jobValidate::class)->scene('create')->check($data);
        }catch (ValidateException $e){
            $msg = $e->getError();
            return $this->message(201, $msg);
        }
    }

    /**
     * 删除
     * @return \think\Response
     */
    public function remove()
    {
        $id = Request::post('id');
        $result = jobModel::destroy($id);
        if(!$result){
            return $this->message(201, '删除失败');
        }
        return $this->message(200, '删除成功');
    }

    /**
     * 批量删除
     * @return \think\Response
     */
    public function batch_remove()
    {
        $ids = Request::post('ids');
        $result = jobModel::destroy($ids);
        if(!$result){
            return $this->message(201, '删除失败');
        }
        return $this->message(200, '删除成功');
    }

    /**
     * 批量导出
     * @return void
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function batch_down()
    {
        $ids = Request::post('ids');
        $data = jobModel::where('id', 'in',$ids)->select()->toArray();
        //实例化spreadsheet对象
        $spreadsheet = new Spreadsheet();
        //获取活动工作簿
        $sheet = $spreadsheet->getActiveSheet();
        //设置单元格表头
        $sheet->setCellValue('A1', 'id');
        $sheet->setCellValue('B1', '岗位名称');
        $sheet->setCellValue('C1', '排序');
        $sheet->setCellValue('D1', '创建时间');
        $sheet->setCellValue('E1', '修改时间');
        $i=2;
        foreach($data as $v){
            $sheet->SetCellValueByColumnAndRow('1',$i,$v['id']);
            $sheet->SetCellValueByColumnAndRow('2',$i,$v['job_name']);
            $sheet->SetCellValueByColumnAndRow('3',$i,$v['sort']);
            $sheet->SetCellValueByColumnAndRow('4',$i,$v['create_time']);
            $sheet->SetCellValueByColumnAndRow('5',$i,$v['update_time']);
            $i++;
        }
        $common = new Common();
        $common->execl($spreadsheet);
    }

    /**
     * 全部导出
     * @return void
     */
    public function down_all()
    {

    }

    /**
     * 清空
     * @return \think\Response
     */
    public function remove_all()
    {
        $result = jobModel::where("1=1")->delete();
        if(!$result){
            return $this->message(201, '清空失败');
        }
        return $this->message(200, '清空成功');
    }

    /**
     * 搜索
     * @return \think\Response
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function search()
    {
        $data = Request::post();
        $result = jobModel::withSearch([$data['select']], [$data['select'] => $data['search']])->select()->toArray();
        if(!$result){
            return $this->message(201, '暂无内容~');
        }
        return $this->message(200, '请求成功', $result);
    }
}
