<?php
namespace App\Repository;


use App\Models\Form as Model;
use Prettus\Repository\Eloquent\BaseRepository;

class FormRepository extends BaseRepository
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
        $list = Model::where('visible', 1)
            ->orderBy('priority', 'desc')
            ->get();

        if ($list === null) {
            return [];
        }

        return $list->toArray();
    }

    public function getAllList()
    {
        $list = Model::orderBy('visible', 'desc')
            ->get();

        if ($list === null) {
            return [];
        }

        return $list->toArray();
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