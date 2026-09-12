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

	Route::get('/google-auth/redirect', [LoginController::class, 		'redirect'])->middleware('guest')->name('redirect');
	Route::get('/google-auth/callback', [LoginController::class, 		'callback'])->middleware('guest')->name('callback');

	Route::get('/', function () {
		return view('site');
	})->name('site');

	Route::get('/site', function () {
		return view('site');
	});

	Route::get('/register', 			[RegisterController::class, 	'create'])	->middleware('guest')->name('register');
	Route::post('/register', 			[RegisterController::class, 	'store'])	->middleware('guest')->name('register.perform');
	Route::get('/login', 				[LoginController::class, 		'show'])	->middleware('guest')->name('login');
	Route::post('/login', 				[LoginController::class, 		'login'])	->middleware('guest')->name('login.perform');
	Route::get('/reset-password', 		[ResetPassword::class, 			'show'])	->middleware('guest')->name('reset-password');
	Route::post('/reset-password', 		[ResetPassword::class, 			'send'])	->middleware('guest')->name('reset.perform');
	Route::get('/change-password', 		[ChangePassword::class, 		'show'])	->middleware('guest')->name('change-password');
	Route::post('/change-password', 	[ChangePassword::class, 		'update'])	->middleware('guest')->name('change.perform');
	Route::post('/darkmode', 			[DashboardController::class, 	'darkmode'])->name('darkmode');
				
Route::group(['middleware' => ['auth', 'single.device']], function () {

	Route::get('/dashboard', 			[DashboardController::class, 	'index'])	->name('home');
	Route::get('/react-dashboard', function () {
		$user = auth()->user();
		$userProjects = $user->projects ?? collect();
		$userProfilesCount = 0;
		foreach ($userProjects as $project) {
			$userProfilesCount += $project->profiles()->count();
		}

		return inertia('SpecificationDashboard', [
			'user' => [
				'username' => $user->username ?? 'Usuario',
				'email' => $user->email ?? '',
				'name' => $user->name ?? 'Usuario',
			],
			'totals' => [
				'user' => $user->username ?? 'admin',
				'users' => \App\Models\User::count(),
				'data' => \App\Models\Filedata::count(),
				'plans' => \App\Models\Plan::count(),
				'projects' => \App\Models\Project::count(),
				'profiles' => \App\Models\Profile::count(),
				'roles' => \Spatie\Permission\Models\Role::count(),
				'user_projects' => $userProjects->count(),
				'user_profiles' => $userProfilesCount,
			],
			'permissions' => [
				'user' => $user->can('user'),
				'projectAdmin' => $user->can('projectAdmin'),
				'project' => $user->can('project'),
				'filedata' => $user->can('filedata'),
				'role' => $user->can('role'),
				'plan' => $user->can('plan'),
			],
			'active_device' => $user->activeDevice?->device_name ?? 'Estación Windows',
		]);
	})->name('react.dashboard');

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

	Route::resource('projectAdmin',  	 				 ProjectAdminController::class);
	Route::put('projectAdmin/{projectAdmin}/update',	[ProjectAdminController::class,		'updateProjectAdmin'])		->name('updateProjectAdmin');
	Route::put('project/{project}/update',				[ProjectController::class,			'updateProject'])			->name('updateProject');
	Route::get('projectAdminProfile',					[ProjectAdminController::class,		'profile'])					->name('projectAdminProfile');
	
	Route::get('project/{project}/pdf',					[PdfController::class,				'pdf'])						->name('project.pdf');
	//Route::get('projectAdmin/{projectAdmin}/pdf',		[ProjectAdminController::class,		'pdf'])						->name('projectAdmin.pdf');
	
	Route::resource('projectProfile',  	 				 ProjectProfileController::class);
	//Route::get('/{page}', 								[PageController::class, 			'index'])	->name('page');
});