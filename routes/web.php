<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/x', function () {
    return shell_exec('php ../parser/parser.php');
});

Route::get('/pessoa', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoa', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoa/pessoa', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoa', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoafisica', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoafisica', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoafisica/pessoafisica', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoafisica', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoajuridica', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoajuridica', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoajuridica/pessoajuridica', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoajuridica', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoa', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoa', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoa/pessoa', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoa', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoafisica', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoafisica', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoafisica/pessoafisica', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoafisica', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoajuridica', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoajuridica', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoajuridica/pessoajuridica', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoajuridica', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoa', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoa', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoa/pessoa', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoa', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoafisica', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoafisica', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoafisica/pessoafisica', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoafisica', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoajuridica', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoajuridica', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoajuridica/pessoajuridica', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoajuridica', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoa', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoa', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoa/pessoa', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoa', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoafisica', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoafisica', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoafisica/pessoafisica', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoafisica', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoajuridica', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoajuridica', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoajuridica/pessoajuridica', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoajuridica', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoa', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoa', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoa/pessoa', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoa', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoafisica', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoafisica', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoafisica/pessoafisica', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoafisica', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoajuridica', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoajuridica', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoajuridica/pessoajuridica', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoajuridica', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoa', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoa', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoa/pessoa', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoa', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoafisica', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoafisica', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoafisica/pessoafisica', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoafisica', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoajuridica', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoajuridica', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoajuridica/pessoajuridica', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoajuridica', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoa', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoa', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoa/pessoa', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoa', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoafisica', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoafisica', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoafisica/pessoafisica', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoafisica', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoajuridica', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoajuridica', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoajuridica/pessoajuridica', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoajuridica', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoa', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoa', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoa/pessoa', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoa', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoafisica', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoafisica', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoafisica/pessoafisica', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoafisica', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoajuridica', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoajuridica', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoajuridica/pessoajuridica', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoajuridica', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoa', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoa', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoa/pessoa', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoa', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoafisica', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoafisica', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoafisica/pessoafisica', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoafisica', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoajuridica', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoajuridica', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoajuridica/pessoajuridica', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoajuridica', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoa', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoa', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoa/pessoa', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoa', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoafisica', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoafisica', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoafisica/pessoafisica', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoafisica', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoajuridica', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoajuridica', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoajuridica/pessoajuridica', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoajuridica', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoa', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoa', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoa/pessoa', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoa', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoafisica', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoafisica', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoafisica/pessoafisica', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoafisica', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoajuridica', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoajuridica', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoajuridica/pessoajuridica', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoajuridica', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoa', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoa', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoa/pessoa', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoa', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoafisica', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoafisica', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoafisica/pessoafisica', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoafisica', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoajuridica', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoajuridica', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoajuridica/pessoajuridica', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoajuridica', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoa', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoa', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoa/pessoa', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoa', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoafisica', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoafisica', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoafisica/pessoafisica', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoafisica', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoajuridica', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoajuridica', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoajuridica/pessoajuridica', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoajuridica', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoa', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoa', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoa/pessoa', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoa', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoafisica', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoafisica', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoafisica/pessoafisica', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoafisica', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoajuridica', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoajuridica', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoajuridica/pessoajuridica', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoajuridica', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoa', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoa', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoa/pessoa', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoa', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoafisica', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoafisica', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoafisica/pessoafisica', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoafisica', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoajuridica', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoajuridica', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoajuridica/pessoajuridica', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoajuridica', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoa', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoa', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoa/pessoa', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoa', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoafisica', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoafisica', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoafisica/pessoafisica', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoafisica', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoajuridica', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoajuridica', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoajuridica/pessoajuridica', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoajuridica', [App\Http\Controllers\RoleController::class, 'destroy']);
