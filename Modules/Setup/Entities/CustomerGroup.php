<?php

namespace Modules\Setup\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerGroup extends Model
{
	use SoftDeletes;
	
	protected $table = 'customer_groups';
    protected $fillable = ['name', 'percentage','is_active'];
}
