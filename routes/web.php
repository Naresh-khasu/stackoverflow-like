<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\QuestionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\FacebookController;

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


Route::group(['middleware' => ['auth']], function () {
Route::resource('question',QuestionController::class);
});
Route::get('/', [HomeController::class,'home'])->name('home');
Route::get('/questions/{id}/{slug}', [HomeController::class,'questionDetail'])->name('questionDetail');
Route::post('post-comment',[HomeController::class,'postComment'])->name('postComment');
Route::post('update-comment',[HomeController::class,'updateComment'])->name('updateComment');

Route::prefix('facebook')->name('facebook.')->group( function(){
    Route::get('auth', [FaceBookController::class, 'loginUsingFacebook'])->name('login');
    Route::get('callback', [FacebookController::class, 'callbackFromFacebook'])->name('callback');
});
