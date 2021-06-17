<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\DepartmentService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class DepartmentController extends Controller
{
    private $departmentService;

    public function __construct(DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }

    /**
     * 创建部门
     *
     * @param Request $req
     * @return array
     * @throws Exception
     */
    public function create(Request $req): array
    {
        $request = $req->all();
        if (empty($request['access_token'])) {
            return $this->res(['code' => 1, 'data' => 41001]);
        }

        try {
            $validator = Validator::make($request, [
                'name' => 'required|string',
            ])->validate();
        } catch (ValidationException $e) {
            Log::info("validator error:{}", $e);
            return $this->res(['code' => 1, 'data' => 40035]);
        }
        if (strlen($request['name']) > 32) {
            return $this->res(['code' => 1, 'data' => 60001]);
        }
        //TODO-正则验证
        $is_match = preg_match("[^%&',;=?$\x22]", $request['name']);
        if ($is_match != 0) {
            return $this->res(['code' => 1, 'data' => 60009]);
        }

        $res = $this->departmentService->create($request);
        return $this->res($res);
    }

    public function update(Request $req): array
    {
        $request = $req->all();
        if (empty($request['access_token'])) {
            return $this->res(['code' => 1, 'data' => 41001]);
        }

        try {
            $validator = Validator::make($request, [
                'name' => 'required|string',
            ])->validate();
        } catch (ValidationException $e) {
            Log::info("validator error:{}", $e);
            return $this->res(['code' => 1, 'data' => 40035]);
        }
        if (strlen($request['name']) > 32) {
            return $this->res(['code' => 1, 'data' => 60001]);
        }
        //TODO-正则验证
        $is_match = preg_match("[^%&',;=?$\x22]", $request['name']);
        if ($is_match != 0) {
            return $this->res(['code' => 1, 'data' => 60009]);
        }

        $res = $this->departmentService->update($request);
        return $this->res($res);
    }
}
