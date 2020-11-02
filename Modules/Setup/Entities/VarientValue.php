<?php

namespace Modules\Setup\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VarientValue extends Model
{
	use SoftDeletes;
    protected $fillable = ['varient_id','name', 'value', 'is_active'];
}
