<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', [
    'as' => 'home_home', 'uses' => 'MainController@home'
]);

$router->get('/quiz/{id}', [
    'as' => 'quiz_quiz', 'uses' => 'QuizController@quiz'
]);

$router->post('/quiz/{id}', [
    'as' => 'quiz_quizPost', 'uses' => 'QuizController@quizPost'
]);

$router->get('/signup', [
    'as' => 'user_signup', 'uses' => 'UserController@signup'
]);

$router->post('/signup', [
    'as' => 'user_signupPost', 'uses' => 'UserController@signupPost'
]);

$router->post('/signinPost', [
    'as' => 'user_signinPost', 'uses' => 'UserController@signinPost'
]);

$router->get('/signin', [
    'as' => 'user_signin', 'uses' => 'UserController@signin'
]);

$router->get('/logout', [
    'as' => 'user_logout', 'uses' => 'UserController@logout'
]);

$router->get('/account', [
    'as' => 'user_profile', 'uses' => 'UserController@profile'
]);

$router->get('/tags', [
    'as' => 'tag_tags', 'uses' => 'TagController@tags'
]);

$router->get('/tags/{id}/quiz', [
    'as' => 'tag_quiz', 'uses' => 'TagController@quiz'
]);

$router->POST('/mail_verif', [
    'as' => 'user_profile_verif', 'uses' => 'UserController@mail_verif'
]);
