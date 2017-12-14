<?php
Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    //Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('sistema/quiz', 'QuizController', ['names' => 'quiz']);
    Route::resource('sistema/questoes', 'QuestionController', ['names' => 'question']);

    //use for destroy answer in question edition
    Route::post('sistema/resposta/excluir', 'QuestionController@destroyAnswerAjax')->name('question.destoyAnswer');
});

//store email and name user in session
Route::post('quiz/responder', 'QuizAnswerController@answerSession')->name('quiz.answerSession');

//send the user from the quiz
Route::get('quiz/responder/{id}', 'QuizAnswerController@answer')->name('quiz.answer');

//save
Route::post('quiz/enviarquiz', 'QuizAnswerController@store')->name('quiz.sendQuiz');


Route::get('/','IndexController@index', ['names' => 'quiz'])->name('site.index');





