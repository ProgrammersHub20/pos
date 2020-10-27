<?php

namespace Modules\Setup\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
	use SoftDeletes;
	protected $table = 'brands';
	protected $primaryKey = 'id';
    protected $fillable = ['name','image','contact_person','contact_phone','contact_address','is_active'];


    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
