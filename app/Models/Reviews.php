<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model implements  PrefixInterface
{
    protected $table = 'reviews';

    protected $fillable = [
        'visible',
        'priority',
        'avatar',
        'name',
        'content',
        'url'
    ];

    public function getPath()
    {
        return DIRECTORY_SEPARATOR
            . self::PREFIX_REVIEWS
            . DIRECTORY_SEPARATOR
            . $this->avatar;
    }
}