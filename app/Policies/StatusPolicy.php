<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\User;
use App\Status;

class StatusPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function destroy(User $user,Status $status)
    {
      return $user->id===$status->user_id;
    }

    public function boot(Gate $gate){
      $this->registerPolicies($gate);
    }
}
