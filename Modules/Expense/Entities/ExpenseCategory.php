<?php

namespace Modules\Expense\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Expense\Entities\Expense;

class ExpenseCategory extends Model
{
	use SoftDeletes;

	protected $table = 'expense_categories';
	protected $primaryKey = 'id';
    protected $fillable = ['code','name','description','is_active'];

    public function expense() {
    	return $this->hasMany(Expense::class);
    }

}
