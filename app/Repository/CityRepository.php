<?php
namespace App\Repository;

use App\Models\City;
use Prettus\Repository\Eloquent\BaseRepository;

class CityRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return City::class;
    }

    public function getList()
    {
        return $this->all(['id', 'name']);
    }
}