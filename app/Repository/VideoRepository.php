<?php
namespace App\Repository;

use App\Models\Video as Model;
use Prettus\Repository\Eloquent\BaseRepository;

class VideoRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Model::class;
    }

    public function get()
    {
        $video =  Model::where('visible', true)->first();

        if ($video !== null) {
            return $video->toArray();
        }

        return [];
    }

    public function getAllList()
    {
        return Model::orderBy('visible', 'desc')
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