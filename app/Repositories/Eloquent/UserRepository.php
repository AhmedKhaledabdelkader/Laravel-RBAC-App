<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\UserRepositoryInterface;
use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
   

    public function create(array $data)
    {
        return User::create($data);
    }


    public function findByEmail(string $email)
    {
        return User::Where("email",$email)->first();
       
    }

    public function getUsers()
    {
        return User::all();
    }

    
}
