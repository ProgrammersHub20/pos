<?php

namespace Modules\Setup\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tax extends Model
{
	use SoftDeletes;
	protected $table = 'taxes';
	protected $primaryKey = 'id';
    protected $fillable = ['name', 'rate', 'is_active'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
