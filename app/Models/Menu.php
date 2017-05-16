<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model implements PrefixInterface
{
    /**
     *
     */
    const TYPE_LOGO = 1;

    /**
     *
     */
    const TYPE_ITEM = 3;

    /**
     *
     */
    const TYPE_PHONE = 5;

    protected $table = 'menu';

    protected $fillable = [
        'visible',
        'priority',
        'type_id',
        'title',
        'url'
    ];

    /**
     * @return bool
     */
    public function isLogo()
    {
        return $this->type_id == self::TYPE_LOGO;
    }

    /**
     * @return bool
     */
    public function isItem()
    {
        return $this->type_id == self::TYPE_ITEM;
    }

    /**
     * @return bool
     */
    public function isPhone()
    {
        return $this->type_id == self::TYPE_PHONE;
    }

    /**
     * @return mixed
     */
    public static function getLogo()
    {
        $logo = self::where('type_id', self::TYPE_LOGO)->first();

        if ($logo === null) {
            $logo = new self;
            $logo->type_id = self::TYPE_LOGO;
        }

        return $logo;
    }

    /**
     * @return mixed
     */
    public static function getPhone()
    {
        $phone = self::where('type_id', self::TYPE_PHONE)->first();

        if ($phone === null) {
            $phone = new self;
            $phone->type_id = self::TYPE_PHONE;
        }

        return $phone;
    }

    public static function getItems()
    {
        return self::where('type_id', self::TYPE_ITEM)->get();
    }

    public function getPath()
    {
        return DIRECTORY_SEPARATOR
        . self::PREFIX_MENU_LOGO
        . DIRECTORY_SEPARATOR
        . $this->title;
    }

}