<?php

namespace Modules\Expense\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Expense\Entities\ExpenseCategory;
use Modules\Entities\Http\Requests\ExpenseCategoryRequest;
class ExpenseCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Expense Category list
     */
    public function index()
    {
        $expenseCategory = ExpenseCategory::orderBy('id','DESC')->paginate(15);

        return $this->success($expenseCategory, 'Expense Category fetch successfully', 200);
    }

    /**
     * Store a newly created resource in storage.
     * @param ExpenseCategoryRequest $request
     * @return json
     */
    public function store(ExpenseCategoryRequest $request)
    {
        try{
            $data = $request->all();
            ExpenseCategory::create($data);

            return $this->success(null, 'Expense Category Created.',201);
        }catch(\Exception $e){
            return $this->error("{$e->getMessage()} at {$e->getFile()} in {$e->getLine()}",500);
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return ExpenseCategory
     */
    public function show($id)
    {
        try{
            $category = ExpenseCategory::findOrFail($id);

            return $this->success($category, 'Expense Category fetch successfully', 200);

        }catch(\Exception $e){
            return $this->error("{$e->getMessage()} at {$e->getFile()} in {$e->getLine()}",500);
        }
    }



    /**
     * Update the specified resource in storage.
     * @param ExpenseCategoryRequest $request
     * @param int $id
     * @return json
     */
    public function update(ExpenseCategory $request, $id)
    {
        try {
            $data = $request->all();
            $category = ExpenseCategory::findOrFail($id);
            $category->update($data);

            return $this->success(null,'Expense Category Updated.',204);
        } catch (\Exception $e) {
             return $this->error("{$e->getMessage()} at {$e->getFile()} in {$e->getLine()}",500);
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
            ExpenseCategory::find($id)->delete();
            return $this->success(null,'Expense Category Deleted.',200);
        } catch (\Exception $e) {
            return $this->error("{$e->getMessage()} at {$e->getFile()} in {$e->getLine()}",500);
        }
    }
}
