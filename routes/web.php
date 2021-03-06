<?php

use App\Http\Controllers\Blog\FavoritesController;
use App\Http\Controllers\Blog\LockedThreadsController;
use App\Http\Controllers\Blog\RepliesController;
use App\Http\Controllers\Blog\ThreadsController;
use App\Http\Controllers\Blog\ThreadSubscriptionController;
use App\Http\Controllers\Blog\UserNotificationsController;
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
// Switch between the included languages
Route::get('lang/{lang}', [\App\Http\Controllers\LocaleController::class, 'change'])->name('locale.change');

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
Route::post('locked-threads/{thread}', [LockedThreadsController::class, 'store'])
    ->name('locked-blog.store')->middleware('admin');
Route::delete('locked-threads/{thread}', [LockedThreadsController::class, 'destroy'])
    ->name('locked-blog.destroy')->middleware('admin');

/** subscription route **/
Route::post('/blog/{channel}/{thread}/subscription', [ThreadSubscriptionController::class, 'store'])->middleware('auth');
Route::delete('/blog/{channel}/{thread}/subscription', [ThreadSubscriptionController::class, 'destroy'])->middleware('auth');

/** replies route **/
Route::get('/blog/{channel}/{thread}/replies', [RepliesController::class, 'index']);
Route::post('/blog/{channel}/{thread}/replies', [RepliesController::class, 'store']);
Route::patch('/replies/{reply}', [RepliesController::class, 'update']);
Route::delete('/replies/{reply}', [RepliesController::class, 'destroy'])->name('reply.destroy');
Route::post('/reply/{reply}/favorites', [FavoritesController::class, 'store']);//like post reply
Route::delete('/reply/{reply}/favorites', [FavoritesController::class, 'destroy']);// like delete reply
Route::post('/replies/{reply}/best', [App\Http\Controllers\Blog\BestRepliesController::class, 'store'])->name('best-replies.store');

/** profiles route **/
Route::get('/profiles/{user}', [App\Http\Controllers\ProfilesController::class, 'show'])->name('profile');
Route::get('/profiles/{user}/notifications', [UserNotificationsController::class, 'index']);
Route::delete('/profiles/{user}/notifications/{notification}', [UserNotificationsController::class, 'destroy']);
Route::get('/register/confirm', [App\Http\Controllers\Auth\RegisterConfirmationController::class, 'index'])->name('register.confirm');

/** users route **/
Route::get('api/users', [App\Http\Controllers\Api\UserController::class, 'index']);
Route::post('api/users/{user}/avatar', [App\Http\Controllers\Api\UserAvatarController::class, 'store'])->middleware('auth')->name('avatar');
