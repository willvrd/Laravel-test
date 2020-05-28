<?php

namespace Modules\User\Repositories;

use Modules\Core\Repositories\BaseRepository;

interface PermissionRepository extends BaseRepository
{

    public function assign($data);

    public function revoke($data);

    public function getModel($data);

}
