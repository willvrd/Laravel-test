<?php

namespace Modules\User\Repositories\Eloquent;

use Modules\User\Repositories\PermissionRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentPermissionRepository extends EloquentBaseRepository implements PermissionRepository
{

    public function assign($data){

        $model = $this->getModel($data);
        $model->syncPermissions($data['permissions']);

    }

    public function revoke($data){

        $model = $this->getModel($data);
        $model->revokePermissionTo($data['permission']);

    }

    public function getModel($data){

        $repo = "Modules\User\Repositories\RoleRepository";
        if($data['criteriaType']==="user")
            $repo = "Modules\User\Repositories\UserRepository";

        $model = app($repo)->find($data['criteriaId']);

        if (!$model) throw new \Exception('Item not found', 204);

        return $model;

    }

}
