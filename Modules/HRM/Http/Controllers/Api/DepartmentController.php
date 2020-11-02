<?php

namespace Modules\HRM\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\HRM\Entities\Department;
use Modules\HRM\Http\Requests\DepartmentRequest;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return DepartmentCollection
     */
    public function index()
    {
        $departments = Department::active()->orderBy('id', 'DESC')->paginate(15);

        return $this->success($departments, 'Department data fetch successfully', Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     * @return json
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return json
     */
    public function store(DepartmentRequest $request)
    {
        try {
            $departments = new Department();
            $departments->fill($request->all())->save();
            return $this->success(null, 'Department Created.', Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return $this->error("{$e->getMessage()} at {$e->getFile()} in {$e->getLine()}", Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return json
     */
    public function show($id)
    {
        try {
            $department = Department::findOrFail($id);

            return $this->success($department, 'Department fetch successfully', Response::HTTP_OK);

        } catch (\Exception $e) {
            return $this->error("{$e->getMessage()} at {$e->getFile()} in {$e->getLine()}", Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return json
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return json
     */
    public function update(DepartmentRequest $request, $id)
    {
        try {
            $data = $request->all();
            $department = Department::findOrFail($id);
            $department->update($data);

            return $this->success(null, 'Department Updated.', Response::HTTP_OK);
        } catch (\Exception $e) {
            return $this->error("{$e->getMessage()} at {$e->getFile()} in {$e->getLine()}", Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return json
     */
    public function destroy($id)
    {
        try {
            Department::find($id)->delete();
            return $this->success(null, 'Department Deleted.', Response::HTTP_OK);
        } catch (\Exception $e) {
            return $this->error("{$e->getMessage()} at {$e->getFile()} in {$e->getLine()}", Response::HTTP_OK);
        }
    }
}
