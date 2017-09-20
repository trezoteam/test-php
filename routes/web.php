<?php

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

///////Rotas public//////////
Route::get('/', 'PublicController@index');

Route::post('play/', 'PublicController@quiz');
Route::get('account/{id}', 'PublicController@index_user');
Route::post('result/', 'PublicController@result');

Route::get('/dropdown', 'Quiz\QuizController@direct_result');
Route::get('/administrator/', function () {
    return view('auth.login');
});

Auth::routes();

//// Rotas que precisam de autenticação////////
Route::group(['middleware' => ['auth']], function () {

    ////administrator/////
    Route::get('/home', 'Quiz\QuizController@index');
    Route::get('/finish', 'Quiz\QuizController@index');
    Route::post('/add_quiz', 'Quiz\QuizController@insert');
    Route::get('/delete_quiz/{id}', 'Quiz\QuizController@delete');
    Route::get('/edit_quiz/{id}', 'Question\QuestionController@index');
    Route::get('/result/{id}', 'Quiz\QuizController@result');
    Route::post('/add_question', 'Question\QuestionController@insert');


});


