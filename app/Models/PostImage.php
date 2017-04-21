<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostImage extends Model
{
    protected $table = 'post_image';

    protected $fillable = ['post_id', 'path'];

    public $timestamps = false;

    public function pathUrl($prefix)
    {
        if ($this->path !== null) {
            return '/post/' .substr($this->path, 0, 3)
            . '/' .$prefix .$this->path;
        }
    }
}
