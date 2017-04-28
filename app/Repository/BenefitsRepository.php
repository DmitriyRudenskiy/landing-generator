<?php
namespace App\Repository;

use App\Models\Benefits;
use Prettus\Repository\Eloquent\BaseRepository;

class BenefitsRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Benefits::class;
    }

    public function getList()
    {
        return Benefits::where('visible', 1)
            ->orderBy('priority', 'desc')
            ->get();
    }

    public function getAllList()
    {
        return Benefits::orderBy('visible', 'desc')
            ->orderBy('priority', 'desc')
            ->get();

    }

    public function add(array $data)
    {
        return $this->create($data);
    }

    public function edit(array $data, $id)
    {
        return $this->update($data, $id);
    }
}