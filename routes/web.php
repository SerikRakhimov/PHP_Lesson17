<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return 'index';
});
Route::redirect('/', '/home');

Auth::routes();
Route::get('/home', 'HomeController@index')
    ->middleware('auth')
    ->name('home');

// CRUD routes
Route::resource('posts', 'PostController');

Route::post('/posts/{post}/likes/count', 'LikeController@count')
    ->name('posts.likes.count');
Route::post('/posts/{post}/is_liked', 'LikeController@isLiked')
    ->name('posts.likes.is_liked');
Route::post('/posts/like/{post}', 'LikeController@like')
    ->name('posts.like')
    ->middleware('auth');

Route::post('/posts/{post}/favorites/count', 'FavoriteController@count')
    ->name('posts.favorites.count');
Route::post('/posts/{post}/is_favorited', 'FavoriteController@isfavorited')
    ->name('posts.favorites.is_favorited');
Route::post('/posts/favorite/{post}', 'FavoriteController@favorite')
    ->name('posts.favorite')
    ->middleware('auth');

Route::name('comments.')
    ->prefix('comments')
    ->middleware('auth')
    ->group(function () {

        Route::post('/', 'CommentController@store')
            ->name('store');
        Route::delete('/{comment}', 'CommentController@destroy')
            ->name('destroy');

    });

