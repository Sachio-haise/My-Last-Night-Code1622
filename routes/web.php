<?php

use App\Http\Controllers\Admin\AdminController ;

use App\Models\User;
use App\Models\UserDetails;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
  //return User::where('id',1)->with('userDetails')->first();
 // return UserDetails::where('id',1)->with('User')->first();
});

Route::get('/home',function(){
    return view('home');
})->middleware('auth');

Route::group(['middleware'=>'auth'],function () {

 Route::get('/home',function(){
        return view('home');
 });

 /*
 Route::group(['prefix'=>'admin','middleware'=>'role:admin','as'=>'admin.'],function () {
      Route::resource('user', adminController::class);
  });

  */

  Route::group(['prefix'=>'admin','as'=>'admin.','middleware'=>'role'],function () {
      Route::resource('/users',AdminController::class);
  });

});

