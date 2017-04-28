<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'company';

    protected $fillable = ['city_id', 'name', 'address', 'work_times', 'phone', 'site', 'latitude', 'longitude'];

    public function city()
    {
        return $this->belongsTo(Benefits::class, 'city_id');
    }

    public function images()
    {
        return $this->hasMany(CompanyImage::class);
    }
}