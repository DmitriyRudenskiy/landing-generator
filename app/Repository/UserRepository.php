<?php
namespace App\Repository;

use App\Models\User;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Contracts\CacheableInterface;
use Prettus\Repository\Traits\CacheableRepository;

class UserRepository extends BaseRepository implements CacheableInterface
{
    use CacheableRepository;

    protected $cacheMinutes = 90;
    protected $cacheOnly = ['getUser'];
    //protected $cacheExcept = ['find'];

    /**
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    public function getUser($id)
    {
        return $this->with(['profile'])->find($id);
    }

    /**
     * @param string $query
     * @param int $limit
     * @return User[]
     */
    public function getList($query, $limit)
    {
        $queryBuilder = User::orderBy('email');

        if (!empty($query)) {
            $queryBuilder->where('email', 'like', '%' . $query . '%');
        }

        return $queryBuilder->paginate($limit);
    }
}