<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;         
use App\Http\Controllers\PdfController;    
use App\Http\Controllers\DashboardController; 
use App\Http\Controllers\FileController;
use App\Http\Controllers\ProjectController;
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

Route::get('/', function () {return view('welcome');});

//Auth::routes();

//Route::get('/home', 				[App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route::get('/', function () {return redirect('/dashboard');})->middleware('auth');
	Route::get('/register', 		[RegisterController::class, 'create'])		->middleware('guest')->name('register');
	Route::post('/register', 		[RegisterController::class, 'store'])		->middleware('guest')->name('register.perform');
	Route::get('/login', 			[LoginController::class, 'show'])			->middleware('guest')->name('login');
	Route::post('/login', 			[LoginController::class, 'login'])			->middleware('guest')->name('login.perform');
	Route::get('/reset-password', 	[ResetPassword::class, 'show'])				->middleware('guest')->name('reset-password');
	Route::post('/reset-password', 	[ResetPassword::class, 'send'])				->middleware('guest')->name('reset.perform');
	Route::get('/change-password', 	[ChangePassword::class, 'show'])			->middleware('guest')->name('change-password');
	Route::post('/change-password', [ChangePassword::class, 'update'])			->middleware('guest')->name('change.perform');
	Route::get('/dashboard', 		[HomeController::class, 'index'])			->name('home')->middleware('auth');

Route::group(['middleware'=>'auth'], function () {

	Route::get('/profile', 			[UserProfileController::class, 'show'])		->name('profile');
	Route::post('/profile', 		[UserProfileController::class, 'update'])	->name('profile.update');
	Route::get('/profile-static', 	[PageController::class, 'profile'])			->name('profile-static'); 
	Route::get('/sign-in-static', 	[PageController::class, 'signin'])			->name('sign-in-static');
	Route::get('/sign-up-static', 	[PageController::class, 'signup'])			->name('sign-up-static'); 

	Route::post('logout', 			[LoginController::class, 'logout'])			->name('logout');
	
	Route::get('/pdf', 				[PdfController::class,'create'])			->name('pdf');
	Route::get('/report', 			[PdfController::class,'show'])				->name('report');
	Route::get('/profile', 			[DashboardController::class, 'profile'])	->name('profile'); //sin uso
	Route::get('/users', 			[DashboardController::class, 'users'])		->name('users');
	Route::get('/data', 			[DashboardController::class, 'data'])		->name('data');
	Route::get('/balance', 			[DashboardController::class, 'balance'])	->name('balance');

	Route::resource('file',  		 FileController::class);
	Route::post('import', 			[FileController::class, 'import'])			->name('import');
	Route::get('export', 			[FileController::class, 'export'])			->name('export');
	Route::get('excel', 			[FileController::class, 'excel'])			->name('excel');
	Route::get('datatable',			[FileController::class, 'datatable'])		->name('datatable');

	
	Route::get('projectindex',		[ProjectController::class, 'index'])		->name('project.index');
	Route::get('projectcreate',		[ProjectController::class, 'create'])		->name('project.create');
	Route::post('projectstore',		[ProjectController::class, 'store'])		->name('project.store');
	Route::get('projectshow',		[ProjectController::class, 'show'])			->name('project.show');	
	Route::get('projectedit',		[ProjectController::class, 'edit'])			->name('project.edit');	
	Route::put('projectupdate',		[ProjectController::class, 'update'])		->name('project.update');
	Route::get('projectdestroy',	[ProjectController::class, 'destroy'])		->name('project.destroy');

	Route::get('/{page}', 			[PageController::class, 'index'])			->name('page');
	
});