<?php

namespace App\Http\Controllers;

use App\Handler\ImageUploadHandler;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;

class UsersController extends Controller
{
    //
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(UserRequest $request, User $user, ImageUploadHandler $uploadHandler)
    {
        dd($request->all());
        return;
//        $data = $user->update($request->all());
//        if ($request->avatar) {
//            $result = $uploadHandler->save($request->avatar, 'avatars', $user->id);
//            if ($result) {
//                $data['avatar'] = $request['path'];
//            }
//        }
//        $user->update($data);
//        return redirect()->route('users.show', $user->id)->with('success', '个人信息更新成功');

    }
}
