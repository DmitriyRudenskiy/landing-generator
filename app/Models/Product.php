<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model implements PrefixInterface
{
    protected $table = 'products';

    protected $fillable = [
        'visible',
        'priority',
        'equipment',
        'engine',
        'power',
        'transmission',
        'drive_unit',
        'body_type',
        'colour'
    ];

    public function getPath()
    {
        if (empty($this->photo)) {
            return null;
        }

        return DIRECTORY_SEPARATOR
            . self::PREFIX_PRODUCTS
            . DIRECTORY_SEPARATOR
            . $this->photo;
    }
}