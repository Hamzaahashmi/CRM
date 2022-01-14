<?php

use Illuminate\Support\Facades\Route;
use App\Models\Role;
use App\Models\User;
use App\Models\Timelog;
use App\Http\controllers\TimelogController;
use App\Http\controllers\HomeController;
use App\Http\controllers\EmployeController;
use App\Http\controllers\CalendarController;
use App\Http\controllers\GallreyController;
use App\Http\controllers\KanbanController;
use App\Http\controllers\ProjectController;





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
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/form', function () {
     $roles=  Role::all();
    return view('admin.form',compact('roles'));
})->name('form');

Route::get('/allemployee', function () {
      $users = User::where('role','!=','admin')->get();
    return view('admin.viewemploye',compact('users'));
})->name('allemployee');

Route::post('create', [HomeController::class, 'create'])->name('create');
Route::get('employedashboard', [EmployeController::class, 'index'])->name('employedashboard');
// ->middleware('role:software');
Route::post('delete',[HomeController::class,'destroy'])->name('delete');
Route::post('timelog',[TimelogController::class,'starttime'])->name('starttime');


Route::get('/calendar', function () {
    return view('employe.calender');
})->name('calender');
Route::post('addevent',[CalendarController::class,'addevent'])->name('addevent');
Route::get('fetchevent',[CalendarController::class,'fetchevent'])->name('fetchevent');
Route::post('editevent',[CalendarController::class,'editevent'])->name('editevent');
Route::post('deleteevent',[CalendarController::class,'deleteevent'])->name('deleteevent');
Route::get('gallrey',[GallreyController::class,'index'])->name('gallrey');
Route::post('dropzone',[GallreyController::class,'dropzone'])->name('dropzone');
Route::post('deletefiles',[GallreyController::class,'deletefiles'])->name('deletefiles');
Route::get('kanbanboard/{id}',[KanbanController::class,'kanban'])->name('kanban');
Route::post('addticket',[KanbanController::class,'addticket'])->name('addticket');
Route::post('updticketstatus',[KanbanController::class,'updticketstatus'])->name('updticketstatus');
Route::post('deleteticket',[KanbanController::class,'deleteticket'])->name('deleteticket');
Route::get('allprojects',[ProjectController::class,'index'])->name('allprojects');
Route::post('addproject',[ProjectController::class,'addproject'])->name('addproject');
Route::get('board/{id}',[ProjectController::class,'projectboard'])->name('board');
Route::post('adminaddticket',[ProjectController::class,'adminaddticket'])->name('adminaddticket');
Route::get('eallprojects',[KanbanController::class,'eallprojects'])->name('eallprojects');
Route::post('deleteproject',[ProjectController::class,'deleteproject'])->name('deleteproject');
















