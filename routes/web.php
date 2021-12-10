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
Auth::routes();

Route::prefix('admin')
    ->name('admin.')
    ->middleware([
        'auth',
        'auth.admin'
    ])
    ->group(function () {

        Route::get('dashboard', [
            \App\Http\Controllers\AdminDashboardController::class,
            'index'
        ])->name('dashboard');

        Route::resource('users', \App\Http\Controllers\UserController::class);

        Route::resource('roles', \App\Http\Controllers\RoleController::class);
    });


Route::get('/', function () {
    return view('home');
});

Route::get('/menu/{name?}', function ($name = null) {
    dd('Menu name :' . $name);
})->middleware([
    'auth',
    'auth.customer'
])->name('menu');

Route::get('/blog/{name?}', [\App\Http\Controllers\BlogController::class, 'index']);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home');

