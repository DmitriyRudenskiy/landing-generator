<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    protected $table = 'project';

    protected $fillable = ['title', 'alias'];
}