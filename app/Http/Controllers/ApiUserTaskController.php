<?php

namespace App\Http\Controllers;

use App\Http\Requests\DestroyUser;
use App\Http\Requests\ListUsers;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;
use App\User;
use Illuminate\Http\Request;

class ApiUserTaskController extends Controller
{
    public function index(ListUsers $request)
    {
        return User::all();
    }

    public function store(StoreUser $request)
    {
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => $request->password,
        ]);

        return $user;
    }

    /**
     * Delete.
     *
     * @param Request $request
     * @param User    $user
     */
    public function destroy(DestroyUser $request, User $user)
    {
        $user->delete();

        return $user;
    }

    /**
     * Update.
     *
     * @param Request $request
     * @param User    $user
     */
    public function update(UpdateUser $request, User $user)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $user->name = $request->name;
        $user->save();

        return $user;
    }
}
