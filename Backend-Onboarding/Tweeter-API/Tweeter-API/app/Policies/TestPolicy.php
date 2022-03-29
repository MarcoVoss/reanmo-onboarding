<?php

namespace App\Policies;

use App\Models\Test;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

class TestPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {

        return true;
    }

    public function view(User $user, Test $testModel)
    {

        return true;
    }

    public function create(User $user)
    {
        return true;
    }

    public function update(User $user, Test $testModel)
    {
        Log::info(1);
        return true;
    }

    public function delete(User $user, Test $testModel)
    {
        return true;
    }

    public function restore(User $user, Test $testModel)
    {
        return true;
    }

    public function forceDelete(User $user, Test $testModel)
    {
        return true;
    }
}
