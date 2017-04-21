<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyImage extends Model
{
    protected $table = 'company_image';

    protected $fillable = ['company_id', 'path', 'order_image', 'cover', 'name'];

    public $timestamps = false;

    public function pathUrl($prefix)
    {
        if ($this->path !== null) {
            return '/company/' .substr($this->path, 0, 3)
            . '/' .$prefix .$this->path;
        }
    }
}