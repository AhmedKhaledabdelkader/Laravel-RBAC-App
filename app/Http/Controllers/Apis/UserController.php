<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Http\Resources\RegisterResource;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{

    public $userService ;

    public function __construct(UserService $userService)
    {
        $this->userService=$userService ;
        
    }

    public function register(Request $request){


      $user=$this->userService->registerUser($request->all()) ;


      return (new RegisterResource($user->load('roles')))->response()->setStatusCode(201);





    }


    public function authenticateUser(Request $request){


        
     return $this->userService->login($request->all());


    }




    public function updateRole(Request $request){


        $user=$this->userService->updateRole($request->all());

        return response()->json(

            [

                "message"=>"update role sucessfully",
                "user"=>$user->load("roles")


            ]

        ,200);




    }


    public function retrieveUsers(){


        return $this->userService->retrieveUsers();


    }




    public function updatePremissions(Request $request,$id){



        return $this->userService->updatePremissions($request->all(),$id);



    }






    
}
