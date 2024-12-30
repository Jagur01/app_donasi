<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Check if the user can access admin features.
     */
    public function accessAdmin(User $user): bool
    {
        return $user->roles_id === 1; // 1 untuk admin
    }
}
