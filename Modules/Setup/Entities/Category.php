<?php

namespace Modules\Setup\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
	use SoftDeletes;

	protected $table = 'categories';
	protected $primaryKey = 'id';
    protected $fillable = ['name','description','parent_id','is_active'];


    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
