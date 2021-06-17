<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var string[]
     * 全局错误
     */
    protected $err_msg = [
        41001 => "缺少access_token参数",
        40035 => "不合法的参数",
        60004 => "父部门不存在",
        60008 => "部门已存在",
        60009 => "部门名称含有非法字符",
        60001 => "部门长度不符合限制",
        60005 => "部门下存在成员",
        60006 => "部门下存在子部门",
        60007 => "不允许删除根部门",
    ];

    public function res($res)
    {
        if ($res['code'] == 0) {
            return $this->success($res['data']);
        } else {
            return $this->fail($res['data']);
        }
    }

    private function success($data): array
    {
        return array_merge(["errcode" => 0, "errmsg" => null], $data);
    }

    private function fail($err_code): array
    {
        return ["errcode" => $err_code, "errmsg" => $this->err_msg[$err_code]];
    }
}
