<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ParserController;

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


// Route::post('/parse-contacts', [ParserController::class, 'parseContacts']);

// Route::post('/parse-form', [ParserController::class, 'parse'])->name('parse');
Route::get('/getinfo', [ParserController::class, 'getInfo'])->name('parse'); // все ок возвращает ассоциативный массив регулярок

Route::get('/check-form', [ParserController::class, 'showCheck'])->name('show-chek');
// Route::match(['get', 'post'], '/check', [ParserController::class, 'viewProperties'])->name('check');
Route::match(['get', 'post'], '/check', [ParserController::class, 'setProperties'])->name('check');
Route::match(['get', 'post'], '/get', [ParserController::class, 'getProperties'])->name('get');


Route::match(['get', 'post'], '/clean-form', [ParserController::class, 'clean'])->name('clean');

Route::match(['get', 'post'], '/parse-form', [ParserController::class, 'parseContacts'])->name('parse');
Route::match(['get', 'post'], '/parse', [ParserController::class, 'showForm'])->name('show');
