<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Header extends Model implements PrefixInterface
{
    protected $table = 'header';

    protected $fillable = [
        'visible',
        'bg',
        'title',
        'title',
        'sub_title',
        'description',
        'button',
        'add_1',
        'add_2',
        'add_3'
    ];

    public function getPath()
    {
        if (empty($this->bg)) {
            return null;
        }

        return DIRECTORY_SEPARATOR
            . self::PREFIX_HEADERS
            . DIRECTORY_SEPARATOR
            . $this->bg;
    }

    public function toArray()
    {
        return [
            'title' => $this->title,
            'sub_title' => $this->sub_title,
            'bg' => $this->getPath(),
            'description' => $this->description,
            'button' => $this->button,
            'add_1' => $this->add_1,
            'add_2'=> $this->add_2,
            'add_3' => $this->add_3
        ];
    }
}