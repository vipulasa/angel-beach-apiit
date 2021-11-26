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
    ->group(function () {

        Route::get('/users', function () {
            // Matches The "/admin/users" URL
        })->name('users');

        Route::get('/roles', function () {
            // Matches The "/admin/users" URL
        })->name('roles');

    });


Route::get('/', function () {
    return view('welcome');
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

