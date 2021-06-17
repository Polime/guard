<?php


namespace App\Http\Services;


use App\Models\DepartmentModel;
use App\Models\UsersRelDepartmentsModel;
use Exception;

class DepartmentService
{
    private $departmentModel;
    private $usersRelDepartmentsModel;

    public function __construct(DepartmentModel $departmentModel, UsersRelDepartmentsModel $usersRelDepartmentsModel)
    {
        $this->departmentModel = $departmentModel;
        $this->usersRelDepartmentsModel = $usersRelDepartmentsModel;
    }

    /**
     * 创建部门
     * @param $
     * name     是    部门名称。同一个层级的部门名称不能重复。长度限制为1~32个字符，字符不能包括\:?”<>｜
     * name_en  否    英文名称。同一个层级的部门名称不能重复。需要在管理后台开启多语言支持才能生效。长度限制为1~32个字符，字符不能包括\:?”<>｜
     * parentid 是    父部门id，32位整型
     * order    否    在父部门中的次序值。order值大的排序靠前。有效的值范围是[0, 2^32)
     * id       否    部门id，32位整型，指定时必须大于1。若不填该参数，将自动生成id
     * @throws Exception
     */
    public function create($department)
    {
        unset($department['access_token']);

        //没有父级id
        if (!isset($department['parentid']) || $department['parentid'] == 0) {
            //是否存在没有父级id的部门,存在这返回失败
            $parent_department = $this->departmentModel->where('parentid', 0)->get();
            if (!$parent_department->isEmpty()) {
                return ['code' => 1, 'data' => 60004];
            }
            $department['parentid'] = 0;
        } else {
            $parent_department = $this->departmentModel->where('id', $department['parentid'])->get();
            //不存在的父级部门,返回失败
            if ($parent_department->isEmpty()) {
                return ['code' => 1, 'data' => 60004];
            }
        }

        //部门名称已存在
        $get_department_by_name = $this->departmentModel->where('name', $department['name'])->get();
        if (!$get_department_by_name->isEmpty()) {
            return ['code' => 1, 'data' => 60008];
        }

        //自动生成id
        if (!isset($department['id'])) {
            $department['id'] = $this->getRandomId();
        } else {
            //部门id已存在
            $get_department_by_id = $this->departmentModel->where('id', $department['id'])->get();
            if (!$get_department_by_id->isEmpty()) {
                return ['code' => 1, 'data' => 60008];
            }
        }
        //随机的order
        if (!isset($department['order'])) {
            $department['order'] = random_int(1, 2147483647);
        }
        $department = $this->departmentModel->baseAdd($department);
        return ['code' => 0, 'data' => ["id" => $this->departmentModel->insertGetId($department)]];
    }

    /**
     * @throws Exception
     */
    private function getRandomId(): int
    {
        $all_id = DepartmentModel::get("id");
        $id = random_int(1, 2147483647);
        if (!empty($all_id->id) && in_array($id, $all_id->id)) {
            return $this->getRandomId();
        } else {
            return $id;
        }
    }

    public function update($department)
    {
        $department = $this->departmentModel->where('id', $department['id'])->first();
        if ($department->isEmpty()) {
            return ['code' => 1, 'data' => 60003];
        }
        if ($department->parentid == 0) {
            return ['code' => 1, 'data' => 60007];
        }
        $child_department = $this->departmentModel->where("parentid", $department->id)->get();
        if (!$child_department->isEmpty()) {
            return ['code' => 1, 'data' => 60006];
        }
        $department_user = $this->usersRelDepartmentsModel->where('department_uuid', $department->uuid)->get();
        if ($department_user->isEmpty()) {
            return ['code' => 1, 'data' => 60005];
        }
    }
}
