<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserModel;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function update(User $user, User $userModel)
    {
        return $user->id === $userModel->id;
    }

    public function delete(User $user, User $userModel)
    {
        return $user->id === $userModel->id;
    }
}
