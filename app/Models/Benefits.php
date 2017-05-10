<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Benefits extends Model implements  PrefixInterface
{
    protected $table = 'benefits';

    protected $fillable = [
        'visible',
        'priority',
        'cover',
        'title',
        'description'
    ];

    public function getPath()
    {
        return DIRECTORY_SEPARATOR
            . self::PREFIX_BENEFITS
            . DIRECTORY_SEPARATOR
            . $this->cover;
    }
}