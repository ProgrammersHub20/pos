<?php

namespace Modules\Setup\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Setup\Entities\VarientValue;
class Varient extends Model
{
	use SoftDeletes;
    protected $fillable = ['name','description','is_active'];


    public function vairentValue()
    {
    	return $this->hasMany(VarientValue::class);
    }
}
