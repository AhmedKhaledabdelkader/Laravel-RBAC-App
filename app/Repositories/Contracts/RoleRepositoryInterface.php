<?php

namespace App\Repositories\Contracts;

interface RoleRepositoryInterface
{
    

    public function findByRoleName(string $role);

    public function findByRoleId($id) ;


}
