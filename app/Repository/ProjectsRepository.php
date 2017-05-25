<?php
namespace App\Repository;

use App\Models\Projects as Model;
use Prettus\Repository\Eloquent\BaseRepository;

class ProjectsRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Model::class;
    }

    public function getList()
    {
        return Model::all();
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