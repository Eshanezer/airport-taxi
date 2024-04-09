<?php

use App\Http\Controllers\DriverController;
use App\Http\Controllers\ExecutiveController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PricingController;
use App\Http\Controllers\RepresentativeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserTypeController;
use App\Http\Controllers\VehicleTypeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware(['auth']);

Route::get('/logout', [UserController::class, 'logout'])->name('admin.logout');

Route::prefix('/users')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::post('/enroll', [UserController::class, 'enroll'])->name('admin.users.enroll')->middleware(['auth']);
    Route::get('/list', [UserController::class, 'list'])->name('admin.users.list')->middleware(['auth']);
    Route::get('/get', [UserController::class, 'getOne'])->name('admin.users.get.one')->middleware(['auth']);
    Route::get('/delete', [UserController::class, 'deleteOne'])->name('admin.users.delete.one')->middleware(['auth']);
});

Route::prefix('/usertypes')->group(function () {
    Route::get('/', [UserTypeController::class, 'index']);
    Route::post('/enroll', [UserTypeController::class, 'enroll'])->name('admin.usertypes.enroll')->middleware(['auth']);
    Route::get('/list', [UserTypeController::class, 'list'])->name('admin.usertypes.list')->middleware(['auth']);
    Route::get('/get', [UserTypeController::class, 'getOne'])->name('admin.usertypes.get.one')->middleware(['auth']);
    Route::get('/delete', [UserTypeController::class, 'deleteOne'])->name('admin.usertypes.delete.one')->middleware(['auth']);
});

Route::prefix('drivers')->group(function () {
    Route::get('/', [DriverController::class, 'index']);
    Route::post('/enroll', [DriverController::class, 'enroll'])->name('admin.drivers.enroll')->middleware(['auth']);;
    Route::get('/list', [DriverController::class, 'list'])->name('admin.drivers.list')->middleware(['auth']);
    Route::get('/get', [DriverController::class, 'getOne'])->name('admin.drivers.get.one')->middleware(['auth']);
    Route::get('/delete', [DriverController::class, 'deleteOne'])->name('admin.drivers.delete.one')->middleware(['auth']);
    Route::get('/block', [DriverController::class, 'blockOne'])->name('admin.drivers.block.one')->middleware(['auth']);
    Route::get('/valiation/turnno', [DriverController::class, 'isValidTurnNo'])->name('admin.drivers.validate.turnno')->middleware(['auth']);
});

Route::prefix('locations')->group(function () {
    Route::get('/', [LocationController::class, 'index']);
    Route::post('/enroll', [LocationController::class, 'enroll'])->name('admin.locations.enroll')->middleware(['auth']);
    Route::get('/list', [LocationController::class, 'list'])->name('admin.locations.list')->middleware(['auth']);
    Route::get('/get', [LocationController::class, 'getOne'])->name('admin.locations.get.one')->middleware(['auth']);
    Route::get('/delete', [LocationController::class, 'deleteOne'])->name('admin.locations.delete.one')->middleware(['auth']);
});

Route::prefix('vehicletypes')->group(function () {
    Route::get('/', [VehicleTypeController::class, 'index']);
    Route::post('/enroll', [VehicleTypeController::class, 'enroll'])->name('admin.vehicletypes.enroll')->middleware(['auth']);
    Route::get('/list', [VehicleTypeController::class, 'list'])->name('admin.vehicletypes.list')->middleware(['auth']);
    Route::get('/get', [VehicleTypeController::class, 'getOne'])->name('admin.vehicletypes.get.one')->middleware(['auth']);
    Route::get('/delete', [VehicleTypeController::class, 'deleteOne'])->name('admin.vehicletypes.delete.one')->middleware(['auth']);
});

Route::prefix('executives')->group(function () {
    Route::get('/', [ExecutiveController::class, 'index']);
    Route::post('/enroll', [ExecutiveController::class, 'enroll'])->name('admin.executives.enroll')->middleware(['auth']);
    Route::get('/list', [ExecutiveController::class, 'list'])->name('admin.executives.list')->middleware(['auth']);
    Route::get('/get', [ExecutiveController::class, 'getOne'])->name('admin.executives.get.one')->middleware(['auth']);
    Route::get('/delete', [ExecutiveController::class, 'deleteOne'])->name('admin.executives.delete.one')->middleware(['auth']);
});

Route::prefix('representatives')->group(function () {
    Route::get('/', [RepresentativeController::class, 'index']);
    Route::post('/enroll', [RepresentativeController::class, 'enroll'])->name('admin.representatives.enroll')->middleware(['auth']);
    Route::get('/list', [RepresentativeController::class, 'list'])->name('admin.representatives.list')->middleware(['auth']);
    Route::get('/get', [RepresentativeController::class, 'getOne'])->name('admin.representatives.get.one')->middleware(['auth']);
    Route::get('/delete', [RepresentativeController::class, 'deleteOne'])->name('admin.representatives.delete.one')->middleware(['auth']);
});

Route::prefix('pricing')->group(function () {
    Route::get('/', [PricingController::class, 'index']);
    Route::post('/enroll', [PricingController::class, 'enroll'])->name('admin.pricing.enroll')->middleware(['auth']);
    Route::get('/list', [PricingController::class, 'list'])->name('admin.pricing.list')->middleware(['auth']);
    Route::get('/get', [PricingController::class, 'getOne'])->name('admin.pricing.get.one')->middleware(['auth']);
    Route::get('/start/end/get', [PricingController::class, 'getSuitablePricing'])->name('admin.start.end.get.one')->middleware(['auth']);
    Route::get('/delete', [PricingController::class, 'deleteOne'])->name('admin.pricing.delete.one')->middleware(['auth']);
    Route::get('/export/excel/{exportable}', [PricingController::class, 'export'])->name('admin.pricing.export.excel')->middleware(['auth']);
    Route::post('/import/excel', [PricingController::class, 'import'])->name('admin.pricing.import.excel')->middleware(['auth']);
    Route::get('/export/sample', [PricingController::class, 'sample'])->name('admin.pricing.export.excel.sample')->middleware(['auth']);
});

Route::prefix('representatives/assign')->group(function () {
    Route::get('/', [RepresentativeController::class, 'indexAssignRep']);
    Route::post('/enroll', [RepresentativeController::class, 'enroll'])->name('admin.representatives.assign.enroll')->middleware(['auth']);
    Route::get('/list', [RepresentativeController::class, 'list'])->name('admin.representatives.assign.list')->middleware(['auth']);
    Route::get('/get', [RepresentativeController::class, 'getOne'])->name('admin.representatives.assign.get.one')->middleware(['auth']);
    Route::get('/delete', [RepresentativeController::class, 'deleteOne'])->name('admin.representatives.assign.delete.one')->middleware(['auth']);
});

Route::prefix('invoice')->group(function () {
    Route::get('/', [InvoiceController::class, 'index']);
    Route::get('/billed/list', [InvoiceController::class, 'billedList'])->name('admin.invoice.billed.list')->middleware(['auth']);
    Route::get('/enroll', [InvoiceController::class, 'enroll'])->name('admin.invoice.enroll')->middleware(['auth']);
    Route::get('/export/excel/{exportable}', [InvoiceController::class, 'export'])->name('admin.invoice.export')->middleware(['auth']);
    Route::get('/list', [InvoiceController::class, 'list'])->name('admin.invoice.list')->middleware(['auth']);
    Route::get('/view/{id}', [InvoiceController::class, 'getInvoiceView'])->name('admin.invoice.view.one')->middleware(['auth']);
    Route::get('/delete', [InvoiceController::class, 'deleteOne'])->name('admin.invoice.delete.one')->middleware(['auth']);
});
