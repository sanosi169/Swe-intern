<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\Auth\UserAuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



// Route::get('/book',[BookController::class,'index']);
// Route::post('book/store',[BookController::class,'store']);
// Route::put('/book/{id}/update',[BookController::class,'update']);
// Route::delete('/book/{id}/delete',[BookController::class,'delete']);

// Route::controller(BookController::class)->group(function(){
//     Route::get('/book','index');
//     Route::post('book/store','store');
//     Route::put('/book/{id}/update','update');
//     Route::delete('/book/{id}/delete','delete');
// });

Route::controller(BookController::class)->middleware('role:admin')->group(function(){
    Route::post('/book/store', 'store');
    Route::put('/book/{id}/update', 'update');
    Route::delete('/book/{id}/delete', 'delete');
});
Route::controller(BorrowingController::class)->middleware('role:admin')->group(function(){
    Route::put('/book/{id}/update','update');
    Route::delete('/book/{id}/delete','delete');
    Route::get('/borrowedReport','borrowedReport');
    Route::get('/popularReport','popularReport');

});
Route::middleware('role:user')->group(function(){
 Route::get('/book',[ BookController::class,'index']);
Route::post('/borrowBook/{bookId}',[ BorrowingController::class,'borrowBook']);
Route::post('/borrowBook/returnBook/{borrowId}',[ BorrowingController::class,'returnBook']);



});

    Route::post('/register', [UserAuthController::class,'register'])->name('user.register');
    Route::post('/login', [UserAuthController::class, 'login'])->name('user.login');
