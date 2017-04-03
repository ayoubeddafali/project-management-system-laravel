<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


use Illuminate\Support\Facades\View;

 // بسم الله 

/*
MY USELESS IRRITATING DISGUSTING ROUTES
IT'S NOT THAT PROFESSIONAL BUT IT NEEDS TO BE REFACTORED 
BEST REGARDS
    AYOUB DEV
*/



// PROJECTS RESOURCES ==> best route till now
Route::resource('projects','projectsController');
Route::get('/projects/{project_id}/delete',['middleware'=>'admin' ,'uses'=>'projectsController@remove']);
Route::post('/projects/{project_id}/budget',['middleware'=>'admin','uses'=>'projectsController@addBudget']);
Route::post('/projects/budget/{project_id}/edit/{cout_id}',['middleware'=>'admin','uses'=>'projectsController@editBudget']);
Route::get('/projects/search/{user_id}/{text}','projectsController@searchByUserId');
Route::auth();

// MAIN PAGE 
Route::get('/', function (){
    return view('index');
});

// MY SPECTACULAR DASHBOARD
Route::get('/admin/dashboard','adminController@dashboard');

// PROFILE/USERS DEPENDENCIES
Route::get('/profile/create',['middleware'=>'admin','uses'=>'usersController@create']);
Route::get('/profile/{user_id}','usersController@profile');
Route::post('/profile/store',['middleware'=>'admin','uses'=>'usersController@store']);
Route::get('/profile/{user_id}/edit','usersController@edit_profile');
Route::post('/profile/{user_id}',['middleware'=>'owner','uses'=>'usersController@storeUser']);
Route::get('/users/{user_id}/delete',['middleware'=>'admin','uses'=>'usersController@delete']);

// SETTING DEPENDENCIES
Route::get('/admin',['middleware'=>'admin','uses'=>'adminController@index']);
Route::get('/admin/users',['middleware'=>'admin','uses'=>'adminController@users']);

// TO DO DEPENDENCIES
Route::post('/admin/{admin_id}/addTodo','adminController@addTodo')->name('addTodo');
Route::get('/admin/todo/{todo_id}/delete','adminController@deleteTodo');
Route::get('/admin/todo/{todo_id}/edit','adminController@editTodo');
Route::post('/admin/sent_message','adminController@sent_message');

// MESSAGES DEPENDENCIES
Route::get('/messages/all','messagesController@index');
Route::get('/messages/sent','messagesController@sent');
Route::post('/messages/respond/{from}','messagesController@respond');
Route::get('/messages/{message_id}/delete',['middleware'=>'admin','uses'=>'messagesController@delete']);
Route::get('/message/show/{message_id}','messagesController@show');

// TASKS DEPENDENCIES
Route::post('/tasks/add/{project_id}','tasksController@store');
Route::get('tasks/{task_id}/delete/{project_id}','tasksController@delete');
Route::get('tasks/{task_id}/delete','tasksController@remove');
Route::get('/tasks/index','tasksController@index');
Route::get('/tasks/transmitted','tasksController@transmitted');

//RISKS DEPENDENCIES
Route::post('/risks/add/{project_id}','risksController@store');
Route::get('/risks/{risk_id}/delete/{project_id}',[ 'middleware'=>'admin' ,'uses'=>'risksController@delete']);

// MILESTONES DEPENDECIES
Route::post('/milestones/add/{project_id}',['middleware'=>'admin','uses'=>'milestonesController@add']);
Route::get('/milestones/delete/{project_id}','milestonesController@delete');


//UPLOAD DEPENDENCIES
Route::post('apply/upload/{project_id}', 'applyController@upload');
Route::get('/files/{file_id}/delete/{project_id}',['middleware'=>'admin','uses'=>'applyController@delete']);

//ADVANCED SERACH DEPENDENCIES
Route::get('/search','searchController@index');
Route::post('/search/result','searchController@lists');

//USELESS CALENDAR 
Route::get('/calendar','calendarController@index');

// EXPORT PACKAGE == still useless right now // DO NOT FORGET => EXPORT BLADE TEMPLATE 
Route::get('/export','exportController@export');
Route::get('/export/all/{project_id}','exportController@exportAll');
Route::post('/import','exportController@import');

// COLLABORATION DEPENDENCIES
Route::post('/collaboration/add/{project_id}','collaborationsController@add');
Route::get('/collaboration/{collaboration_id}/delete/{project_id}','collaborationsController@delete');

//REPORTS DEPENDENCIES
Route::get('/reports','reportsController@index');
// FORBIDDEN
Route::get('/forbidden',function(){
    return view('layouts.forbidden');
});