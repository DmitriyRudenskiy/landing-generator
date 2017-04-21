<?php
namespace App\Repository;

use App\Models\Company;
use Prettus\Repository\Eloquent\BaseRepository;

class CompanyRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Company::class;
    }

    public function getList($limit)
    {
        return Company::paginate($limit);
    }
}


