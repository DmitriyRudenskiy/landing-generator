<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Header extends Model
{
    protected $table = 'header';

    protected $fillable = [
        'visible',
        'bg',
        'title',
        'title',
        'sub_title'
    ];

    const PREFIX_BENEFITS = 'benefits';

    public function getPath()
    {
        return DIRECTORY_SEPARATOR
            . self::PREFIX_BENEFITS
            . DIRECTORY_SEPARATOR
            . $this->cover;
    }
}