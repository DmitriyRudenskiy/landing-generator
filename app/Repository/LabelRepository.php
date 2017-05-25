<?php
namespace App\Repository;

use App\Models\Label as Model;
use Prettus\Repository\Eloquent\BaseRepository;

class LabelRepository extends BaseRepository
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
        $list = Model::select(["visible", "name", "label"])
            ->where('visible', true)
            ->where('type_id', Model::TYPE_LIST)
            ->orderBy('priority', 'desc')
            ->get();

        if ($list === null) {
            return [];
        }

        return $list->toArray();
    }

    public function getButton()
    {
        return  Model::where('visible', true)
            ->where('type_id', Model::TYPE_BUTTON)
            ->orderBy('priority', 'desc')
            ->first();
    }

    public function getAllList()
    {
        $list = Model::select(["visible", "name", "label"])
            ->orderBy('visible', 'desc')
            ->orderBy('priority', 'desc')
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