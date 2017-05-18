<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    protected $table = 'title';

    protected $fillable = ['key', 'value'];

    const TILE_MIME = 'title_mime';

    const TILE_PRODUCT = 'title_product';

    const TITLE_DOWN_BUTTON = 'title_down_button';

    const TITLE_YANDEX_METRIKA = 'metrika';

    public static function getKeys()
    {
        return [
            self::TILE_MIME => 1,
            self::TILE_PRODUCT => 2,
            self::TITLE_DOWN_BUTTON => 3,
            self::TITLE_YANDEX_METRIKA => 5
        ];
    }
}