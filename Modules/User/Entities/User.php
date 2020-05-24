<?php

namespace Modules\User\Entities;

use Spatie\Permission\Traits\HasRoles;

class User extends \App\User
{

   use HasRoles;


}
