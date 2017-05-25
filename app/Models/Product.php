<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model implements PrefixInterface, TypeParametersInterface
{
    protected $table = 'products';

    protected $fillable = [
        'type_id',
        'is_small',
        'visible',
        'priority',
        'equipment',
        'engine',
        'power',
        'transmission',
        'drive_unit',
        'body_type',
        'colour',
        'button'
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

    public function toArray()
    {
        $data = parent::toArray();
        $data['path'] = $this->getPath();

        return $data;
    }
}