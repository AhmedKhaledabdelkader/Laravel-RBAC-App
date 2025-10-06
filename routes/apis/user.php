<?php

use App\Http\Controllers\Apis\UserController;
use Illuminate\Support\Facades\Route;


Route::post('/register', [UserController::class, 'register'])->middleware(['validate.user']);

Route::post('/login', [UserController::class, 'authenticateUser']) ->middleware(['validate.userLogin']);

Route::post('/update-role', [UserController::class, 'updateRole'])->middleware(['auth','validate.admin','validate.modifyRole']);

Route::get('/getAll', [UserController::class, 'retrieveUsers'])->middleware(['auth','premission:get_users']);