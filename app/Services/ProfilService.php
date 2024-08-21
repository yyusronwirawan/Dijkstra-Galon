<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfilService
{
    public function updatePicture($request)
    {
        $user = User::find(Auth::id());
        // #upload image
        if ($image = $request->file('image')) {

            $user->clearMediaCollection();

            $user->addMedia($image)->toMediaCollection();
        }
    }
}
