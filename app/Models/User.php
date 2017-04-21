<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function pathUrl($prefix = 'b_')
    {
        if ($this->avatar !== null) {
            return '/avatar/' .substr($this->avatar, 0, 3)
            . '/' .$prefix .$this->avatar;
        }
    }

}
