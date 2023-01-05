<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PacienteController;

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

/* Route::get('/pacientes', function () {
    return view('pacientes.index');
});

*/

/*
Route::get('/pacientes/create',[PacienteController::class,'create']);
*/

Route::resource('pacientes', PacienteController::class)->middleware('auth');
Auth::routes(['register'=>false,'reset'=>false]);




Route::get('/home', [PacienteController::class, 'index'])->name('home');



Route::group(['middleware' => 'auth'],function () {
    
    Route::get('/', [PacienteController::class, 'index'])->name('home');
});

