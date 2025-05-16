<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Str;

class UserController extends Controller
{

    public function getUser($id)
    {
        $user = User::find($id);
        if ($user) {
            return response()->json($user);
        } else {
            return response()->json(['error' => '用户不存在'], 404);
        }
    }

    public function updateUser(Request $request)
    {
        $data = $request->only(['name', 'password']);
        $user = User::find($request->userId);
        if ($user) {
            $user->fill($data);

            if ($request->hasFile('avatar')) {
                $avatarName = Str::uuid()->toString() . '.' . $request->avatar->getClientOriginalExtension();
                $request->avatar->storeAs('images/avatars', $avatarName, 'public');

                $user->avatar = $avatarName;
            }

            $user->save();
            return response()->json(['success' => '1']);
        } else {
            return response()->json(['error' => '用户不存在'], 404);
        }
    }

    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(User $user)
    {
        //
    }


    public function edit(User $user)
    {
        //
    }

    public function update(Request $request, User $user)
    {
        //
    }

    public function destroy(User $user)
    {
        //
    }
}
