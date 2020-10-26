<?php

namespace Modules\Setup\Entities;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $guarded = [];


    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}