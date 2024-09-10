<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\TasksController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/test',function(){
    return "ss";
});

Route::post('/login-app', [App\Http\Controllers\Api\LoginController::class, 'login']);
Route::get('/getUserTasks', [TasksController::class, 'getUserTasks']);
Route::post('/task/comment', [TasksController::class, 'storeComment']);



Route::get('/user/{id}/team-members', [ChatController::class, 'getTeamMembers']); // Get team members for a user
Route::post('/message/private', [ChatController::class, 'sendPrivateMessage']); // Send private message
Route::post('/message/group', [ChatController::class, 'sendGroupMessage']); // Send group message
Route::get('/message/private/{userId}/{otherUserId}', [ChatController::class, 'getPrivateMessages']); // Fetch private messages between two users
Route::get('/message/group/{teamId}', [ChatController::class, 'getGroupMessages']); // Fetch group messages for a team
