<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Benefits extends Model
{
    protected $table = 'benefits';

    protected $fillable = [
        'visible',
        'priority',
        'cover',
        'title',
        'description'
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