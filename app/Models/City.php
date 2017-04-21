<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'city';

    public $timestamps = false;

    public function __toString()
    {
        return $this->name;
    }
}
