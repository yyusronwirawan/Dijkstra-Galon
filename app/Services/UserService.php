<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function store($userRequest)
    {
        #saving data
        $user = User::create($userRequest->all());

        #upload image
        if ($image = $userRequest->file('image')) {
            $user->addMedia($image)->toMediaCollection();
        }

        #assigning role
        $user->assignRole('Pengguna');

        return $user;
    }

    public function update($userRequest, $id)
    {
        #update data
        $user = User::find($id);
        $user->update($userRequest->all());

        #upload image
        if ($image = $userRequest->file('image')) {
            $user->clearMediaCollection();
            #remove image
            $user->addMedia($image)->toMediaCollection();
        }

        return $user;
    }

    public function destroy($id)
    {
        User::destroy($id);
    }
}
