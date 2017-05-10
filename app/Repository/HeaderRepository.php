<?php
namespace App\Repository;


use App\Models\Header;
use Prettus\Repository\Eloquent\BaseRepository;

class HeaderRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Header::class;
    }

    public function get()
    {
        $list = Header::where('visible', 1)
            ->orderBy('id')
            ->first();

       return ($list === null) ? [] : $list->toArray();
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