<?php

namespace Modules\HRM\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use SoftDeletes;
    protected $table = 'departments';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'details', 'is_active'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
