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


Route::get('/pessoa', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoa', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoa/pessoa', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoa', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoa', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoa', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoa/pessoa', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoa', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoa', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoa', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoa/pessoa', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoa', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoa', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoa', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoa/pessoa', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoa', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoa', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoa', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoa/pessoa', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoa', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoa', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoa', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoa/pessoa', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoa', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoa', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoa', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoa/pessoa', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoa', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoa', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoa', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoa/pessoa', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoa', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoa', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoa', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoa/pessoa', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoa', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoa', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoa', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoa/pessoa', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoa', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoa', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoa', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoa/pessoa', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoa', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoa', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoa', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoa/pessoa', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoa', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoa', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoa', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoa/pessoa', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoa', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoa', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoa', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoa/pessoa', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoa', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoa', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoa', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoa/pessoa', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoa', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoa', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoa', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoa/pessoa', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoa', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoa', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoa', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoa/pessoa', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoa', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoa', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoa', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoa/pessoa', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoa', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoa', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoa', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoa/pessoa', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoa', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/pessoa', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/pessoa', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/pessoa/pessoa', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/pessoa', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/aluno', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/aluno', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/aluno/aluno', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/aluno', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/professor', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/professor', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/professor/professor', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/professor', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/turma', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/turma', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/turma/turma', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/turma', [App\Http\Controllers\RoleController::class, 'destroy']);

Route::get('/escola', [App\Http\Controllers\RoleController::class, 'index']);
Route::post('/escola', [App\Http\Controllers\RoleController::class, 'store']);
Route::put('/escola/escola', [App\Http\Controllers\RoleController::class, 'update']);
Route::delete('/escola', [App\Http\Controllers\RoleController::class, 'destroy']);
