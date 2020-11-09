<?php

namespace Modules\Expense\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Expense\Entities\ExpenseCategory;
use Modules\Setup\Entities\Store;

class Expense extends Model
{
	use SoftDeletes;

	protected $table = 'expenses';
	protected $primaryKey = 'id';
    protected $fillable = ['reference_no','expense_category_id','store_id','amount','note'];

    public function expenseCategory()
    {
    	return $this->belongsTo(ExpenseCategory::class, 'expense_category_id');
    }

    public function expenseStore()
    {
    	return $this->belongsTo(Store::class, 'store_id');
    }

    
}
