<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;         
use App\Http\Controllers\PdfController;    
use App\Http\Controllers\DashboardController; 
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectAdminController;
use App\Http\Controllers\ProjectProfileController;
use App\Http\Controllers\FiledataController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

	Route::get('/google-auth/redirect', [LoginController::class, 		'redirect'])->middleware('guest')->name('login');
	Route::get('/google-auth/callback', [LoginController::class, 		'callback'])->middleware('guest')->name('login');

	Route::get('/', 					function () {return 			redirect('https://pinturaintumescente.cl/site');});
	// Route::get('/', 					[DashboardController::class, 	'index'])	->name('home');

	Route::get('/register', 			[RegisterController::class, 	'create'])	->middleware('guest')->name('register');
	Route::post('/register', 			[RegisterController::class, 	'store'])	->middleware('guest')->name('register.perform');
	Route::get('/login', 				[LoginController::class, 		'show'])	->middleware('guest')->name('login');
	Route::post('/login', 				[LoginController::class, 		'login'])	->middleware('guest')->name('login.perform');
	Route::get('/reset-password', 		[ResetPassword::class, 			'show'])	->middleware('guest')->name('reset-password');
	Route::post('/reset-password', 		[ResetPassword::class, 			'send'])	->middleware('guest')->name('reset.perform');
	Route::get('/change-password', 		[ChangePassword::class, 		'show'])	->middleware('guest')->name('change-password');
	Route::post('/change-password', 	[ChangePassword::class, 		'update'])	->middleware('guest')->name('change.perform');
				
Route::group(['middleware'=>'auth'], function () {

	Route::get('/dashboard', 			[DashboardController::class, 	'index'])	->name('home');

	Route::get('profile/{id}', 			[UserProfileController::class, 	'show'])	->name('profile.show');
	Route::post('/profile', 			[UserProfileController::class, 	'update'])	->name('userProfile.update');
	Route::get('/userProfile',			[UserProfileController::class,	'UserProfile'])	->name('userProfile'); 
	Route::get('/userProfileEdit',		[UserProfileController::class,	'userProfileEdit'])	->name('userProfileEdit'); 
	Route::get('/sign-in-static', 		[PageController::class, 		'signin'])	->name('sign-in-static');
	Route::get('/sign-up-static', 		[PageController::class, 		'signup'])	->name('sign-up-static'); 

	Route::post('logout', 				[LoginController::class, 		'logout'])	->name('logout');
	
	Route::get('pdf/{pdf}', 			[PdfController::class,			'create'])	->name('pdf');
	Route::get('/report', 				[PdfController::class,			'show'])	->name('report');
	
	Route::get('database', 				[DashboardController::class, 	'database'])->name('database');
	Route::get('/balance', 				[DashboardController::class, 	'balance'])	->name('balance');

	Route::resource('project',  	 	 ProjectController::class);
	Route::get('project/{project}/pdf',	[ProjectController::class,		'pdf'])		->name('project.pdf');

	Route::resource('user',  		  	 UserController::class);
	Route::resource('plan',  		  	 PlanController::class);
	Route::resource('role',  		  	 RoleController::class);	

	Route::resource('filedata',  		 FiledataController::class);
	Route::post('filedataImport', 		[FiledataController::class, 	'import'])	->name('filedata.Import');
	Route::get('filedataExport', 		[FiledataController::class, 	'export'])	->name('filedata.Export');
	Route::post('filedataOrder', 		[FiledataController::class, 	'order'])	->name('filedata.Order');
	Route::post('filedataOrderList',	[FiledataController::class, 	'orderList'])->name('filedata.OrderList');
	Route::post('filedataReset', 		[FiledataController::class, 	'reset'])	->name('filedata.Reset');
	
	//Route::get('projectDataTable',	[projectController::class, 'datatable'])	->name('projectDataTable');*/
	//Route::post('/dark-mode/toggle', 	[DashboardController::class, 'darkmode'])	->name('darkmode');

	Route::resource('projectAdmin',  	 				 ProjectAdminController::class);
	Route::put('projectAdmin/{projectAdmin}/update',	[ProjectAdminController::class,		'updateProjectAdmin'])		->name('updateProjectAdmin');
	Route::get('projectAdmin/{projectAdmin}/pdf',		[ProjectAdminController::class,		'pdf'])						->name('projectAdmin.pdf');
	Route::get('projectAdminProfile',					[ProjectAdminController::class,		'profile'])					->name('projectAdminProfile');

	Route::resource('projectProfile',  	 				 ProjectProfileController::class);
	
	//Route::get('/{page}', 								[PageController::class, 			'index'])	->name('page');
});