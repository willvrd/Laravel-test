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
        return $this->model->create($data);

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
