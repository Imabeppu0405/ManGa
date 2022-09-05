<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\ReportController;
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
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// ゲーム一覧画面
Route::get('/home', [GameController::class, 'index'])->middleware(['auth'])->name('home');
// ゲーム管理画面
Route::get('/mst/game', [GameController::class, 'mstIndex'])->middleware(['auth'])->name('mst/game');
// ゲーム保存
Route::post('/mst/game/save', [GameController::class, 'save'])->middleware(['auth']);
// ゲーム削除処理
Route::post('/mst/game/delete', [GameController::class, 'delete'])->middleware(['auth']);
// アカウント画面
Route::get('/account', [ReportController::class, 'index'])->middleware(['auth'])->name('account');
// ゲーム記録保存
Route::post('/report/save', [ReportController::class, 'save'])->middleware(['auth']);
// ゲーム記録削除
Route::post('/report/delete', [ReportController::class, 'delete'])->middleware(['auth']);

require __DIR__.'/auth.php';
