<?php

namespace Modules\User\Repositories\Cache;

use Modules\User\Repositories\UserRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheUserDecorator extends BaseCacheDecorator implements UserRepository
{
    public function __construct(UserRepository $user)
    {
        parent::__construct();
        $this->entityName = 'user.users';
        $this->repository = $user;
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
