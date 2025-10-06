<?php

namespace App\Services;

use App\Repositories\Contracts\RoleRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserService
{

    public $userRepo,$roleRepo ;


    public function __construct(UserRepositoryInterface $userRepo,RoleRepositoryInterface $roleRepo)
    {
        $this->userRepo=$userRepo ;
        $this->roleRepo=$roleRepo ;
    }



    public function registerUser(array $data){


      $data["password"]=Hash::make($data["password"]);

      $user=$this->userRepo->create($data) ;

      $role=$this->roleRepo->findByRoleName('Viewer');

      $data["roles"]=[$role->id];

       $user->roles()->attach($data["roles"]);

       return $user ;


    }


public function login(array $data){


    $user=$this->userRepo->findByEmail($data["email"]);

    if($user && Hash::check($data["password"],$user->password)){

        $token=$user->createToken("api_token")->plainTextToken;

        return response()->json([

            "message"=>"login sucessfully",
            "access_token"=>$token,
            "token_type"=>"Bearer"

        ],200);

    }else{

        return response()->json([

            "message"=>"Invalid password"

        ],401);

    }




}







    public function updateRole(array $data){


        $user=$this->userRepo->findByEmail($data["email"]);


        $role=$this->roleRepo->findByRoleName($data["role"]);

        $data["roles"]=[$role->id];

         $user->roles()->syncWithoutDetaching($data["roles"]);

         return $user ;


    }



    public function retrieveUsers(){


        $users=$this->userRepo->getUsers();

        return response()->json([


            "message"=>"retrieving users successfully",
            "users"=>$users->load("roles")


        ],200);



    }













}
