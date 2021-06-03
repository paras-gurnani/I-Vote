<?php

// use App\Http\Controllers\ElectionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Events\Logout;

// use App\Http\Controllers\CandidateController;

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

Route::get('/', 'HomeController@index')->name('home');
// Route::get('/home','PagesController@dashboard');
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('candidates',CandidateController::class);
Route::resource('elections',ElectionController::class);
Route::post('/elections/vote','ElectionController@vote')->name('elections.vote');

Auth::routes();


?>