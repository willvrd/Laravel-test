<?php

namespace Modules\User\Repositories\Eloquent;

use Modules\User\Repositories\UserRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

// Hash
use Illuminate\Support\Facades\Hash;


class EloquentUserRepository extends EloquentBaseRepository implements UserRepository
{

    public function create($data){

        $this->hashPassword($data);

        $model = $this->model->create($data);

        if(isset($data['roles'])){
            $roles = $data['roles'];
        }else{
            $roles[0] = "user";
        }

        $model->syncRoles($roles);

        return $model;

    }

     /**
     * Hash the password key
     * @param array $data
     */
    private function hashPassword(array &$data)
    {
        $data['password'] = Hash::make($data['password']);
    }

}
