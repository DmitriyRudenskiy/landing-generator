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
        $header = Header::where('visible', 1)
            ->orderBy('id')
            ->first();

        if ($header === null) {
            $header = new Header();
        }

        return $header->toArray();
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