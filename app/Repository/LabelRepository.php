<?php
namespace App\Repository;

use App\Models\Benefits;
use App\Models\Label;
use Prettus\Repository\Eloquent\BaseRepository;

class LabelRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Label::class;
    }

    public function getList()
    {
        $list = Label::select(["visible", "name", "label"])
            ->where('visible', 1)
            ->orderBy('priority', 'desc')
            ->get();

        if ($list === null) {
            return [];
        }

        return $list->toArray();
    }

    public function getAllList()
    {
        $list = Label::select(["visible", "name", "label"])
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