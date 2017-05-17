<?php
namespace App\Repository;

use App\Models\Title;
use Prettus\Repository\Eloquent\BaseRepository;

class TitleRepository extends BaseRepository
{
    /**
     * @return string
     */
    public function model()
    {
        return Title::class;
    }

    public function getList()
    {
        $result = [];
        $list = $this->all(['key', 'value']);
        $key = Title::getKeys();

        foreach ($list as $value) {
            if (isset($key[$value->key])) {
                $result[$value->key] = $value->value;
            }
        }

        return $result;
    }

    public function add($id, $key, $value)
    {
        $title = $this->find($id);

        if ($title !== null) {

            if ($key !== $title->key) {
                $title->key = $key;
            }

            $title->value = $value;
            $title->save();

            return $title;
        }

        return Title::forceCreate([
            'id' => $id,
            'key' => $key,
            'value' => $value
        ]);
    }
}