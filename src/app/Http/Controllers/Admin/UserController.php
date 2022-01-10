<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Users\CreateRequest;
use App\Http\Requests\Admin\Users\FilterRequest;
use App\Http\Requests\Admin\Users\UpdateRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->middleware('can:admin-panel');
        $this->userService = $userService;
    }

    public function index(FilterRequest $request)
    {
        $users = $this->getUsers($request);

        $statuses = [
            User::STATUS_WAIT => 'Wait',
            User::STATUS_ACTIVE => 'Active'
        ];
        $roles = [
            User::ROLE_USER => 'User',
            User::ROLE_ADMIN => 'Admin'
        ];

        return view('admin.users.index', compact('users', 'statuses', 'roles'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(CreateRequest $request)
    {
        $user = $this->userService->new($request);
        flash('User was success created')->success();
        return redirect()->route('admin.users.show', $user);
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = [
            User::ROLE_USER => 'User',
            User::ROLE_ADMIN => 'Admin'
        ];
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function update(UpdateRequest $request, User $user)
    {
        $user->update($request->only(['name', 'email', 'role']));
        flash()->info('User was success updated');
        return redirect()->route('admin.users.show', $user);
    }

    public function destroy(User $user)
    {
        $user->delete();
        flash()->info('User was success deleted');
        return redirect()->route('admin.users.index');
    }

    public function verify(User $user)
    {
        try {
            $this->userService->verify($user->id);
            flash('User has been successfully verified')->success();
            return redirect()->route('admin.users.show', $user);
        } catch (\Exception $e) {
            flash($e->getMessage())->error();
            return redirect()->route('admin.users.show', $user);
        }
    }

    protected function getUsers(Request $request)
    {
        $query = User::query();

        if (!empty($id = $request->get('id'))) {
            $query->where('id', $id);
        }

        if (!empty($name = $request->get('name'))) {
            $query->where('name', 'like', '%' . $name . '%');
        }

        if (!empty($email = $request->get('email'))) {
            $query->where('email', 'like', '%' . $email . '%');
        }

        if (!empty($status = $request->get('status'))) {
            $query->where('status', $status);
        }

        if (!empty($status = $request->get('role'))) {
            $query->where('role', $status);
        }

        if (!empty($sort = $request['sort'])) {
            $query->orderBy($sort, $request['order'] ?: 'desc');
        } else {
            $query->orderBy('id', 'desc');
        }

        return $query->paginate(10);
    }
}
