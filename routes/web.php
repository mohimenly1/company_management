<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\TeamsController;
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
    return view('auth.login');
});
Auth::routes();
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles','RoleController');
    Route::resource('users','UserController');
    });

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => ['auth']], function() {
Route::resource('roles','RoleController');
Route::resource('users','UserController');
});

Route::resource('teams', 'TeamsController');
Route::resource('team_members', 'TeamMembersController');
Route::resource('projects', 'ProjectController');

Route::resource('companies', 'CompaniesController');


Route::get('/tasks/create', [TasksController::class, 'create'])->name('tasks.create');
Route::post('/tasks', [TasksController::class, 'assignTask'])->name('tasks.assignTask');
Route::get('/tasks-show', [TasksController::class, 'index'])->name('teams.index');
Route::get('/tasks-show', [TasksController::class, 'index'])->name('tasks.index');
Route::get('/teams/{team}/members', [TasksController::class, 'showTeamMembers'])->name('teams.showMembers');
Route::post('/tasks/assign', [TasksController::class, 'assignTask'])->name('tasks.assign');
Route::get('/get-team-members/{team}', [TasksController::class, 'getTeamMembers']);

Route::middleware('auth:sanctum')->get('/getUserTasks', [TasksController::class, 'getUserTasks']);

Route::get('/{page}', 'AdminController@index');

// routes/web.php

Route::get('/team-members/chat', [ChatController::class, 'teamMembersChat'])->name('teamMembersChat');
Route::get('/team-members/chat/{receiverId}', [ChatController::class, 'showSendMessageForm'])->name('teamMembers.message');
Route::post('/team-members/chat/{receiverId}', [ChatController::class, 'sendMessage'])->name('teamMembers.sendMessage');
