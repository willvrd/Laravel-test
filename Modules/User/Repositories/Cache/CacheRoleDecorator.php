<?php

namespace Modules\User\Repositories\Cache;

use Modules\User\Repositories\RoleRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheRoleDecorator extends BaseCacheDecorator implements RoleRepository
{
    public function __construct(RoleRepository $role)
    {
        parent::__construct();
        $this->entityName = 'user.roles';
        $this->repository = $role;
    }

      /**
   * List or resources
   *
   * @return collection
   */
  public function getItemsBy($params)
  {
    return $this->remember(function () use ($params) {
      return $this->repository->getItemsBy($params);
    });
  }

  /**
   * find a resource by id or slug
   *
   * @return object
   */
  public function getItem($criteria, $params)
  {
    return $this->remember(function () use ($criteria, $params) {
      return $this->repository->getItem($criteria, $params);
    });
  }


}
