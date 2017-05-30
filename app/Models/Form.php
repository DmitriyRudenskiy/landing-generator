<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $table = 'form';

    protected $fillable = [
        'visible',
        'form_title',
        'name_label',
        'phone_label',
        'name_placeholder',
        'phone_placeholder',
        'button_title',
        'project_id',
        'form_description',
        'in_modal'
    ];
}