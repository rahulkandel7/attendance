<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Jenssegers\Agent\Agent;


$agent = new Agent();

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

if($agent->isMobile()){
    return abort(403);
} else {
   
    Route::get('/', function () {
        return view('auth.login');
    });

   Route::middleware('isExpire')->group(function(){
    Route::get('/dashboard', [FrontendController::class,'dashboard'])->name('dashboard')->middleware('auth');
    Route::get('/myattendance', [FrontendController::class,'empAttendance'])->name('empatt')->middleware(['auth']);

    Route::get('/employees', [FrontendController::class,'users'])->name('employee')->middleware(['auth','admin']);
    Route::get('/application-all', [FrontendController::class,'application'])->name('application')->middleware(['auth','admin']);
    Route::get('/application-today', [FrontendController::class,'todayapplication'])->name('todayapplication')->middleware(['auth','admin']);
    Route::get('/attendance', [FrontendController::class,'attendance'])->name('attendance')->middleware(['auth','admin']);
    Route::get('/attendance/{id}', [FrontendController::class,'attendanceView'])->name('attendanceview')->middleware(['auth','admin']);
    Route::get('/attendance/month/{id}', [FrontendController::class,'monthview'])->name('monthview')->middleware(['auth']);
    Route::get('/attendance/late/{id}', [FrontendController::class,'lateview'])->name('lateview')->middleware(['auth','admin']);
    Route::get('/birthdays', [FrontendController::class,'birthday'])->name('birthday')->middleware(['auth','admin']);

    Route::resource('attendances', AttendanceController::class)->middleware(['auth']);
    Route::post('/attendences/updated',[AttendanceController::class,'updated'])->middleware('auth')->name('attendances.updated');
    Route::resource('applications', LeaveController::class)->middleware(['auth']);
    Route::resource('users', UserController::class)->middleware('auth','admin');
    Route::put('users/expire/{id}', [UserController::class, 'expire'])->name('users.expire')->middleware('auth','admin');
    Route::put('users/revive/{id}', [UserController::class, 'revive'])->name('users.revive')->middleware('auth','admin');

    Route::get('/clockedin', [FrontendController::class,'clockedin'])->name('clockedin')->middleware(['admin','auth']);
    Route::get('/notclocked', [FrontendController::class,'notclocked'])->name('notclocked')->middleware(['admin','auth']);

    Route::get('/payments/{id}',[PaymentController::class, 'index'])->name('payments.index')->middleware(['auth','admin']);
    Route::post('/payments/store',[PaymentController::class, 'store'])->name('payments.store')->middleware(['auth','admin']);
    Route::put('/payments/update/{id}',[PaymentController::class, 'update'])->name('payments.update')->middleware(['auth','admin']);
    Route::get('/payments/edit/{id}',[PaymentController::class, 'edit'])->name('payments.edit')->middleware(['auth','admin']);
    Route::delete('/payments/delete/{id}',[PaymentController::class, 'delete'])->name('payments.delete')->middleware(['auth','admin']);

    Route::get('/my-payments',[FrontendController::class, 'payments'])->name('payment')->middleware(['auth']);

   });

    require __DIR__.'/auth.php';
}


