<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\EventController as PublicEventController;
use App\Http\Controllers\LiveStreamController;
use App\Http\Controllers\LiveAttendanceController;
use App\Http\Controllers\LiveCommentController;
use App\Http\Controllers\ServiceCenterController;
use App\Http\Controllers\Admin\HLifeController;



Route::get('/service-centers', [ServiceCenterController::class, 'index'])->name('centers.index');
Route::get('/api/search-centers', [ServiceCenterController::class, 'search'])->name('api.centers.search');

/*
|--------------------------------------------------------------------------
| Public Live Stream Endpoints
|--------------------------------------------------------------------------
*/

// Used by the modal in your frontend layout
Route::post('/live/attendance', [LiveAttendanceController::class, 'storeAttendance']);

Route::prefix('comments')->group(function () {
    Route::get('/stream/{streamId}', [LiveCommentController::class, 'index']);
    Route::post('/', [LiveCommentController::class, 'store']);
    Route::put('/{id}', [LiveCommentController::class, 'update']);
    Route::post('/{id}/reply', [LiveCommentController::class, 'reply']);
    Route::delete('/{id}', [LiveCommentController::class, 'destroy']);
});

/*
|--------------------------------------------------------------------------
| Studio / Dashboard Endpoints (Consolidated)
|--------------------------------------------------------------------------
*/

Route::prefix('studio')->group(function () {
    // 1. Stream Management (LiveStreamController)
    // Handled by the model responsible for the video link and status
    Route::get('/stream', [LiveStreamController::class, 'index']);
    Route::post('/update', [LiveStreamController::class, 'update']);
    Route::post('/toggle-live', [LiveStreamController::class, 'toggleLive']);

    // 2. Attendance & Analytics (LiveAttendanceController)
    // Handled by the model responsible for tracking viewers
    Route::get('/data', [LiveAttendanceController::class, 'getStudioData']);
    Route::post('/attend', [LiveAttendanceController::class, 'storeAttendance']);
});

/*
|--------------------------------------------------------------------------
| Events Endpoints
|--------------------------------------------------------------------------
*/

// Public Data
Route::get('/events-data', [PublicEventController::class, 'getPublicData'])->name('api.events.public');

// Admin Management
Route::prefix('admin')->group(function () {
    Route::get('/events', [EventController::class, 'index']);
    Route::post('/events', [EventController::class, 'store']);
    Route::put('/events/{event}', [EventController::class, 'update']);
    Route::delete('/events/{event}', [EventController::class, 'destroy']);
});

Route::get('/videos', [App\Http\Controllers\Admin\HLifeController::class, 'index']);
