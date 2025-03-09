<?php
use App\Http\Controllers\RouteController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\StopController;
use App\Http\Controllers\StopTimeController;


Route::get('/routes', [RouteController::class, 'index'])->name('routes.index');
Route::get('/', [RouteController::class, 'index'])->name('routes.index');
Route::get('/routes/{id}', [RouteController::class, 'show'])->name('routes.show'); 


Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware('auth')->group(function () {
    Route::get('/routes/create', [RouteController::class, 'create'])->name('routes.create');
    Route::post('/routes', [RouteController::class, 'store'])->name('admin.routes.store');


   // Route::get('/routes/{id}', [RouteController::class, 'show'])->name('routes.show');
    Route::get('/your/route/data', [RouteController::class, 'getChartData']);

    Route::get('your', [RouteController::class, 'yourRouteAction'])->name('your.routes');


    Route::delete('/stop/{id}', [StopController::class, 'destroy'])->name('stop.destroy');
    Route::put('/stop/{id}', [StopController::class, 'update'])->name('stop.update');
    Route::get('/stops', [StopController::class, 'index'])->name('stops.index');

    Route::get('/routes/{id}/stops/create', [RouteController::class, 'createStop'])->name('routes.stops.create');


    Route::get('/stops/create', [StopController::class, 'create'])->name('stops.create');
    Route::post('/stops', [StopController::class, 'store'])->name('stops.store');


    Route::get('/stop_times/{id}/edit', [StopTimeController::class, 'edit'])->name('stop_times.edit');
    Route::put('/stop_times/{id}', [StopTimeController::class, 'update'])->name('stop_times.update');

    Route::delete('/stop_times/{id}', [StopTimeController::class, 'destroy'])->name('stop_times.destroy');
    Route::resource('stop_times', StopTimeController::class);


    Route::middleware(\App\Http\Middleware\IsAdmin::class)->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
        Route::resource('routes', RouteController::class, ['as' => 'admin']);
        Route::resource('stops', StopController::class, ['as' => 'admin']);
        Route::get('assign-route', [AdminController::class, 'assignRouteForm'])->name('admin.assign-route');
        Route::post('assign-route', [AdminController::class, 'assignRoute'])->name('admin.assign-route.post');
    });


    Route::get('admin/assign', [AdminController::class, 'showAssignRouteForm'])->name('admin.assign');
    Route::post('admin/assign', [AdminController::class, 'assignRoute'])->name('admin.assign.post');

    Route::post('/routes/{route}/stops/add', [RouteController::class, 'addStops'])->name('routes.stop_add.store');

    Route::post('/admin/remove-route', [AdminController::class, 'removeRoute'])->name('admin.remove-route.post');

    Route::get('/routes/{route}/stops/add', [RouteController::class, 'showAddStopsForm'])->name('routes.stop_add');

    Route::middleware(\App\Http\Middleware\IsAdmin::class)->group(function () {
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });


    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('can:update,user');
    Route::put('/users/{user}/update', [UserController::class, 'update'])->name('users.update')->middleware('can:update,user');

    Route::delete('routes/{route}', [RouteController::class, 'destroy'])->name('routes.destroy');


});


Route::any('{any}', function () {
    return redirect()->route('login');
})->where('any', '.*');
