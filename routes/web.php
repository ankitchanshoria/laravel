<?php

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

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:clear');
		$exitCode = Artisan::call('cache:clear');
		$exitCode = Artisan::call('view:clear');
		$exitCode = Artisan::call('route:clear');
    
  //  $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'AdminBeforeLoggedIn'], function () {
    
    Route::get('/login', [\App\Http\Controllers\Admin\UserController::class, 'login'])->name('admin.login');
    Route::post('/login', [UserController::class, 'postLogin'])->name('admin.post.login');
});
