<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\EmployeeController;
use App\Http\Controllers\loginController;
use App\Models\Employee;

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
    $jumlahpegawai = Employee::count();
    $jumlahpegawaiL = Employee::where('jeniskelamin','L')->count();
    $jumlahpegawaiP = Employee::where('jeniskelamin','P')->count();
    return view('welcome',compact('jumlahpegawai','jumlahpegawaiL','jumlahpegawaiP'));
})->middleware('auth');

Route::group(['middleware' =>['auth','hakakses:admin']], function(){
    Route::get('/pegawai', [EmployeeController::class, 'index'])->name('pegawai');
    Route::get('/tambahpegawai', [EmployeeController::class, 'tambahpegawai'])->name('tambahpegawai');
    Route::post('/insertdata', [EmployeeController::class, 'insertdata'])->name('insertdata');
    Route::get('/tampildata/{id}', [EmployeeController::class, 'tampildata'])->name('tampildata');
    Route::post('/updatedata/{id}', [EmployeeController::class, 'updatedata'])->name('updatedata');
    Route::get('/delete/{id}', [EmployeeController::class, 'delete'])->name('delete');
});


Route::get('/login', [loginController::class, 'login'])->name('login');
Route::get('/register', [loginController::class, 'register'])->name('register');
Route::post('/registeruser', [loginController::class, 'registeruser'])->name('registeruser');
Route::post('/loginproses', [loginController::class, 'loginproses'])->name('loginproses');
Route::get('/logout', [loginController::class, 'logout'])->name('logout');

