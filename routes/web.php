<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\controls\PageController as ControlsPageController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MemberSessionController;
use App\Http\Controllers\PageController;

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



Route::get('/', [PageController::class, 'home']);

Route::prefix('member')->name('member.')->group(function(){
    Route::resource('/', MemberController::class)->only(['create', 'store']);
    Route::delete('/session', [MemberSessionController::class, 'delete'])->name('session.delete');
    Route::resource('session', MemberSessionController::class)
        ->only(['create', 'store']);

});

Route::prefix('controls')->middleware(['auth'])->name('controls.')->group(function(){
    Route::get('/', [ControlsPageController::class , 'home'])->name('home');
});



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');


require __DIR__.'/auth.php';
