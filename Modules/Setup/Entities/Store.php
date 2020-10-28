<?php

namespace Modules\Setup\Entities;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
	protected $table = 'stores';
    protected $fillable = ['name','address','contact_person','contact_phone','weekend', 'open_time', 'close_time', 'is_active'];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
