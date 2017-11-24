<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ApiUserTaskController extends Controller
{
    public function index()
    {
        return User::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
        ]);

        return $user;
    }

    /**
     * Delete.
     *
     * @param Request $request
     * @param User    $user
     */
    public function destroy(Request $request, User $user)
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
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $user->name = $request->name;
        $user->save();

        return $user;
    }
}
