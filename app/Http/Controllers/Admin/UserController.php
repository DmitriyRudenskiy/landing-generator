<?php
namespace App\Http\Controllers\Admin;

use App\Repository\UserRepository;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserController extends Controller
{
    const COUNT_ON_PAGE = 15;

    /**
     * @param UserRepository $repository
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(UserRepository $repository, Request $request)
    {
        $query = $request->get('email', '');
        $list = $repository->getList($query, self::COUNT_ON_PAGE);

        return view(
            'admin.user.index',
            [
                'list' => $list,
                'email' => $query
            ]
        );
    }

    /**
     * @param UserRepository $repository
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function view(UserRepository $repository, $id)
    {
        $user = $repository->find($id);

        if ($user === null) {
            throw new NotFoundHttpException();
        }

        return view('admin.user.view', ['user' => $user]);
    }

    /**
     * @param UserRepository $repository
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserRepository $repository, Request $request, $id)
    {
        $user = $repository->find($id);

        if ($user === null) {
            throw new NotFoundHttpException();
        }

        $data = $request->only(['email', 'name', 'password', 'role_id', 'category_id']);

        // Сохраняем пароль
        if (!empty($data['password'])) {
            $user->setPassword($data['password']);
        }

        if (empty($data['email'])) {
            unset($data['email']);
        } else {
            $data['email'] = strtolower(trim($data['email']));
        }

        $user->update($data);

        return redirect()->route('admin_user', ['success' => 1]);
    }
}
