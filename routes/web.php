<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrudController;

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

Route::get('/',[CrudController::class,'index'])->name('/');
Route::post('save-data',[CrudController::class,'saveData'])->name('save-data');
Route::get('show-data',[CrudController::class,'showData'])->name('show-data');
Route::get('edit-data/{id}',[CrudController::class,'editData'])->name('edit-data');
Route::post('update-data',[CrudController::class,'updateData'])->name('update-data');
Route::post('delete-data',[CrudController::class,'deleteData'])->name('delete-data');
