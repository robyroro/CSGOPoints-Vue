<?php

use App\Http\Controllers\API\PostsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostbackController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\DataController;
use App\Http\Controllers\API\ApiController;
use App\Http\Controllers\API\AdminController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\RewardController;




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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::post('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

Route::group(['prefix' => 'data','middleware' => 'auth:sanctum'], function() {
  Route::get('dashboard', [DataController::class, 'getdata']);
  Route::get('recentfeeds', [DataController::class, 'recentfeeds']);
  Route::get('walls', [DataController::class, 'getwalls']);
  Route::get('items',[DataController::class,'items']);
  Route::post('order/item',[DataController::class,'order']);
  Route::post('item/track',[DataController::class,'trackorder']);

});

//Chat Routes
Route::get('/chat/rooms',[ChatController::class,'rooms'])->middleware('auth:sanctum');
Route::get('/chat/room/{id}/messages',[ChatController::class,'messages'])->middleware('auth:sanctum');
Route::post('/chat/room/{id}/message',[ChatController::class,'newmessage'])->middleware('auth:sanctum');


//Postback Routes
Route::get('/postback/wall/{hash}',[PostbackController::class,'getrequest']);
Route::post('/postback/wall/{hash}',[PostbackController::class,'getrequest']);


Route::get('/logs/rooms',[DataController::class,'rooms'])->middleware('auth:sanctum');


//Reward Routes 
Route::group(['prefix' => 'get','middleware' => 'auth:sanctum'], function() {
  Route::get('inventory/data', [RewardController::class,'getitems']);
  Route::post('withdraw', [RewardController::class,'withdraw']);
  Route::post('swap_item', [RewardController::class,'swap']);
  Route::get('winners', [RewardController::class,'getwinners']);
});




//Api Routes 
Route::get('import_items',[ApiController::class,'import']);
Route::get('order/item',[DataController::class,'order']);


//Admin Routes 
Route::group(['prefix' => 'admin','middleware' => 'auth:sanctum'], function() {
  Route::get('data', [AdminController::class,'dashboard']);
});


Route::group(['prefix' => 'posts','middleware' => 'auth:sanctum'], function() {
    Route::get('/', [PostsController::class,'index']);
    Route::post('add', [PostsController::class,'add']);
    Route::post('update/{id}', [PostsController::class,'update']);
    Route::get('edit/{id}', [PostsController::class,'edit']);
    Route::delete('delete/{id}', [PostsController::class,'delete']);
});