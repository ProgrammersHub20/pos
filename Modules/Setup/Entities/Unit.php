<?php

namespace Modules\Setup\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
	use SoftDeletes;
	protected $table = 'units';
	protected $primaryKey = 'id';
    protected $fillable = ['unit_code','unit_name','base_unit','operator','operation_value','is_active'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
