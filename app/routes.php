<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/




Route::get('/', function() {
    return View::make('tasks');
    //return View::make('hello');
})->before('auth');

Route::resource('user', 'UserController', [
    'only' => ['index', 'create', 'store']
]);

Route::post('user/profile_picture', [
    'as' => 'user.profile_picture',
    'uses' => 'UserController@postProfile'
]);

Route::get('user/login', [
    'as' => 'user.login',
    'uses' => 'UserController@login',
]);

Route::get('user/logout', [
    'as'   => 'user.logout',
    function () {
        Auth::logout();

        return Redirect::route('user.index');
    }
])->before('auth');

Route::get('taskEdit/{id}', array('as' => 'task.edit', 'uses' => 'ListsController@edit'));

Route::post('user/auth', [
    'as' => 'user.auth',
    'uses' => 'UserController@auth'
]);

Route::post('user/auth', [
    'as' => 'user.auth',
    'uses' => 'UserController@auth'
]);


Route::resource('lijst', 'ListsController', [
    'only' => ['index', 'store']
]);

Route::resource('task', 'TaskController', [
    'only' => ['index', 'create', 'store']
]);


Route::group(['prefix' => 'api', 'before' => 'auth'], function () {
    Route::resource('lists'  , 'ListsController');
    Route::resource('pomodoro', 'PomodoroController');
    Route::resource('label'   , 'LabelController');
    Route::resource('users' , 'UserController@getUsers');
    Route::resource('deletedusers' , 'UserController@getDeletedUserList');
    Route::resource('userDel' , 'UserController@destroy');
    Route::resource('userRestore' , 'UserController@restore');
    Route::resource('alltask' , 'TaskController@getAllTasks');
    Route::resource('tasklijst' , 'TaskController@getTasks');
    Route::resource('finishedlijst' , 'TaskController@getFinished');
    Route::resource('list' , 'ListsController@getLijst');
    Route::resource('listDel' , 'ListsController@destroy');
    Route::resource('listEdit' , 'ListsController@edit');
    Route::resource('taskDel' , 'TaskController@destroy');
    Route::resource('taskEdit' , 'TaskController@edit');
    Route::resource('taskDone' , 'TaskController@finished');
    Route::resource('taskRedo' , 'TaskController@unfinished');
    Route::post('taskEdit/{id}', [
        'as' => 'task.update',
        'uses' => 'TaskController@update'
    ]);
    Route::post('listEdit/{id}', [
        'as' => 'list.update',
        'uses' => 'ListsController@update'
    ]);


});


Route::get('admin', [
    'as' => 'user.admin',
    'uses' => 'UserController@admin',
]);


