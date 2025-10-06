<?php

namespace App\Repositories\Eloquent;

use App\Models\Role;
use App\Repositories\Contracts\RoleRepositoryInterface;

class RoleRepository implements RoleRepositoryInterface
{

    public function findByRoleName(string $role)
    {
        return Role::where("name",$role)->first();
    }
   
}
