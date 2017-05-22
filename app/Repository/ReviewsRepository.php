<?php
namespace App\Repository;

use App\Models\Reviews;
use Prettus\Repository\Eloquent\BaseRepository;

class ReviewsRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Reviews::class;
    }

    public function getList()
    {
        return Reviews::where('visible', 1)
            ->orderBy('priority', 'desc')
            ->get();
    }

    public function getAllList()
    {
        return Reviews::orderBy('visible', 'desc')
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