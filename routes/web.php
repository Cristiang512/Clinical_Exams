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

Route::get('/', function () {
    return view('auth.login');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');





Route::resource ('patient','App\Http\Controllers\PatientController')->middleware('auth');
Route::resource ('admin','App\Http\Controllers\AdminController')->middleware('auth');
Route::resource ('specialty','App\Http\Controllers\SpecialtyController')->middleware('auth');
Route::resource ('service','App\Http\Controllers\ServiceController')->middleware('auth');
Route::get('/patient/{id}/index', 'App\Http\Controllers\Manejos_extintoresController@index')->middleware('patientLogued');
Route::get('/patient/{id}/index', 'App\Http\Controllers\Manejos_extintoresController@index')->name('cliente_extintor');
Route::post('/patient/{id}/guardar', 'App\Http\Controllers\Manejos_extintoresController@store')->name('guardarextintor');
Route::get('patient/ocultar/{resultado_id}', 'App\Http\Controllers\Manejos_extintoresController@ocultar');
Route::post('import/list/excel', 'App\Http\Controllers\PatientController@importExcelTest')->name('users.import.excel');
Route::get('/change-password', 'App\Http\Controllers\PatientController@changePassword')->name('change-password');
Route::post('/change-password', 'App\Http\Controllers\PatientController@updatePassword')->name('update-password');


require __DIR__.'/auth.php';
