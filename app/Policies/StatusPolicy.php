<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\User;
use App\Status;

class StatusPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the given user can delete the status.
     *
     * @param  \App\User   $user
     * @param  \App\Status $status
     * @return bool
     */
    public function destroy(User $user,Status $status)
    {
      return $user->id===$status->user_id;
    }

    public function boot(Gate $gate){
      $this->registerPolicies($gate);
    }
}
