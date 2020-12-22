<?php

use App\Http\Controllers\Blog\ThreadsController;
use App\Http\Controllers\Blog\ThreadSubscriptionController;
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
});

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
/** blog route **/
Route::get('/blog', [ThreadsController::class, 'index'])->name('blog');
Route::get('/blog/create', [ThreadsController::class, 'create']);
Route::post('/blog', [ThreadsController::class, 'store'])->middleware('must-be-confirmed');
Route::get('blog/{channel}/{thread}', [ThreadsController::class, 'show']);
Route::patch('blog/{channel}/{thread}', [ThreadsController::class, 'update']);
Route::delete('blog/{channel}/{thread}', [ThreadsController::class, 'destroy']);
Route::get('blog/{channel}', [ThreadsController::class, 'index']);
Route::post('locked-threads/{thread}', [App\Http\Controllers\LockedThreadsController::class, 'store'])
    ->name('locked-blog.store')->middleware('admin');
Route::delete('locked-threads/{thread}', [App\Http\Controllers\LockedThreadsController::class, 'destroy'])
    ->name('locked-blog.destroy')->middleware('admin');

/** subscription route **/
Route::post('/blog/{channel}/{thread}/subscription', [ThreadSubscriptionController::class, 'store'])->middleware('auth');
Route::delete('/blog/{channel}/{thread}/subscription', [ThreadSubscriptionController::class, 'destroy'])->middleware('auth');

/** replies route **/
Route::get('/blog/{channel}/{thread}/replies', [App\Http\Controllers\Blog\RepliesController::class, 'index']);
Route::post('/blog/{channel}/{thread}/replies', [App\Http\Controllers\Blog\RepliesController::class, 'store']);
Route::patch('/replies/{reply}', [App\Http\Controllers\Blog\RepliesController::class, 'update']);
Route::delete('/replies/{reply}', [App\Http\Controllers\Blog\RepliesController::class, 'destroy'])->name('reply.destroy');
Route::post('/reply/{reply}/favorites', [App\Http\Controllers\Blog\FavoritesController::class, 'store']);//like post reply
Route::delete('/reply/{reply}/favorites', [App\Http\Controllers\Blog\FavoritesController::class, 'destroy']);// like delete reply
Route::post('/replies/{reply}/best', [App\Http\Controllers\Blog\BestRepliesController::class, 'store'])->name('best-replies.store');

/** profiles route **/
Route::get('/profiles/{user}', [App\Http\Controllers\ProfilesController::class, 'show'])->name('profile');
Route::get('/profiles/{user}/notifications', [App\Http\Controllers\Blog\UserNotificationsController::class, 'index']);
Route::delete('/profiles/{user}/notifications/{notification}', [App\Http\Controllers\Blog\UserNotificationsController::class, 'destroy']);
Route::get('/register/confirm', [App\Http\Controllers\Auth\RegisterConfirmationController::class, 'index'])->name('register.confirm');

/** users route **/
Route::get('api/users', [App\Http\Controllers\Api\UserController::class, 'index']);
Route::post('api/users/{user}/avatar', [App\Http\Controllers\Api\UserAvatarController::class, 'store'])->middleware('auth')->name('avatar');
