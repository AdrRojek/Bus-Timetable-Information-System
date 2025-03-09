<?php
namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view or edit the model.
     */
    public function update(User $currentUser, User $user)
    {
        return $currentUser->id === $user->id || $currentUser->isAdmin();
    }

}
