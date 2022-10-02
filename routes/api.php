<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request)
 {
   if($request->user()->tokenCan('read'))
   {
     return ['message','Successfully'];
   }
   else{
    return ['message','You are not allow'];
   }
});


Route::get('/usersdata',[UserController::class,'index'])->name('index');
Route::post('/useradd',[UserController::class,'store'])->name('store');
Route::post('/login',[UserController::class,'login'])->name('login');
