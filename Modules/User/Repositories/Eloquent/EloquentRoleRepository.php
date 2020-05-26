<?php

namespace Modules\User\Repositories\Eloquent;

use Modules\User\Repositories\RoleRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentRoleRepository extends EloquentBaseRepository implements RoleRepository
{

    public function assign($data){

        $user = app("Modules\User\Repositories\UserRepository")->find($data['userId']);
        $user->syncRoles($data['roles']);

    }

}
