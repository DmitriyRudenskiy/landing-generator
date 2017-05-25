<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Label extends Model implements TypeParametersInterface
{
    protected $table = 'products_label';

    protected $fillable = [
        'type_id',
        'is_small',
        'visible',
        'priority',
        'name',
        'label'
    ];

    public function isLabel()
    {
        return ($this->type_id == self::TYPE_LIST);
    }

    public function isButton()
    {
        return ($this->type_id == self::TYPE_BUTTON);
    }
}