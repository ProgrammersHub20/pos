<?php

namespace Modules\Expense\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Modules\Expense\Entities\Expense;
use Modules\Entities\Http\Requests\ExpenseRequest;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Expense list
     */
    public function index()
    {
         $aa_expenses = Expense::with(['expenseCategory', 'expenseStore'])->orderBy('id','DESC')->paginate(15);

        return $this->success($aa_expenses, 'Expense fetch successfully', 200);
    }


    /**
     * Store a newly created resource in storage.
     * @param ExpenseRequest $request
     * @return json
     */
    public function store(ExpenseRequest $request)
    {

        try{

            $data = $request->all();
            $data['reference_no'] = 'ex-' . date("Ymd") . '-'. date("his");

            Expense::create($data);

            return $this->success(null, 'Expense Created.',201);
        }catch(\Exception $e){
            return $this->error("{$e->getMessage()} at {$e->getFile()} in {$e->getLine()}",500);
        }


    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Expense 
     */
    public function show($id)
    {
         try{
            $aa_expense = Expense::findOrFail($id);

            return $this->success($aa_expense, 'Expense fetch successfully', 200);

        }catch(\Exception $e){
            return $this->error("{$e->getMessage()} at {$e->getFile()} in {$e->getLine()}",500);
        }
    }



    /**
     * Update the specified resource in storage.
     * @param ExpenseRequest $request
     * @param int $id
     * @return json
     */
    public function update(ExpenseRequest $request, $id)
    {
        try {
            $data = $request->all();
            $aa_expense = Expense::with(['expenseCategory', 'expenseStore'])->findOrFail($id);
            $aa_expense->update($data);

            return $this->success(null,'Expense Updated.',204);
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
            Expense::find($id)->delete();

            return $this->success(null,'Expense Deleted.',200);
        } catch (\Exception $e) {
            return $this->error("{$e->getMessage()} at {$e->getFile()} in {$e->getLine()}",500);
        }
    }
}
