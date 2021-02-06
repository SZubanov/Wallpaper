<?php

declare(strict_types=1);

namespace App\Observers\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserObserver
{
    public function creating(User $user): void
    {
        $user->name = $user->email;
        $user->password = Hash::make($user->password);
    }

    public function updating(User $user): void
    {
        if ($user->isDirty('email')) {
            $user->name = $user->email;
        }
        if ($user->isDirty('password')) {
            $user->password = Hash::make($user->password);
        }
    }

}
