<?php
namespace App\Repository;

use App\Models\CompanyImage;
use Prettus\Repository\Eloquent\BaseRepository;

class CompanyImageRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return CompanyImage::class;
    }
}


