<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
// Imported the Admin-specific EventController with an alias
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\LiveCommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController as MemberLoginController;
use App\Http\Controllers\Admin\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\MembersController;
use App\Http\Controllers\Admin\HLifeController;
use App\Http\Controllers\LiveStreamController;
use App\Http\Controllers\ServiceCenterController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LiveAttendanceController;
use App\Http\Controllers\TestimonyController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| 1. Public Web Routes
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => view('welcome'))->name('home');
Route::get('/about', fn() => view('about'))->name('about');
Route::get('/find-center', [ServiceCenterController::class, 'index'])->name('centers.index');
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/live', [LiveStreamController::class, 'index'])->name('livestream.view');
Route::get('/h-life', fn() => view('h-life'));
Route::get('/contact', fn() => view('contact'));
Route::post('/contact/submit', [ContactController::class, 'store'])->name('contact.store');

// TESTIMONIES SYSTEM
Route::get('/testimonies', [TestimonyController::class, 'index'])->name('testimonies.index');
Route::post('/testimonies/store', [TestimonyController::class, 'store'])->name('testimonies.store');

/*
|--------------------------------------------------------------------------
| 2. Guest Routes (Member & Admin Login)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    // Member Auth
    Route::get('/login', [MemberLoginController::class, 'show'])->name('login');
    Route::post('/login', [MemberLoginController::class, 'authenticate']);
    Route::get('/register', [RegisterController::class, 'show'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);

    // Admin Auth
    Route::prefix('admin')->group(function () {
        Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
        Route::post('/login', [AdminLoginController::class, 'login']);
    });
});

/*
|--------------------------------------------------------------------------
| 3. Public API Endpoints
|--------------------------------------------------------------------------
*/
Route::prefix('api')->group(function() {
    Route::prefix('comments')->group(function () {
        Route::get('/stream/{streamId}', [LiveCommentController::class, 'index'])->name('api.comments.index');
        Route::post('/', [LiveCommentController::class, 'store']);
        Route::put('/{id}', [LiveCommentController::class, 'update']);
        Route::post('/{id}/reply', [LiveCommentController::class, 'reply']);
        Route::delete('/{id}', [LiveCommentController::class, 'destroy']);
        Route::get('/public-events', [EventController::class, 'getPublicData'])->name('api.public-events');
    });

    Route::post('/live/attendance', [LiveAttendanceController::class, 'storeAttendance']);

    // Public Video Route for H-Life sync
    Route::get('/videos', [HLifeController::class, 'index']);
});

/*
|--------------------------------------------------------------------------
| 4. Protected Routes (Auth Required)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Logout
    Route::post('/logout', [MemberLoginController::class, 'logout'])->name('logout');
    Route::get('/logout', [MemberLoginController::class, 'logout']);
    Route::post('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
    Route::get('/admin/logout', [AdminLoginController::class, 'logout']);

    // Profile
    Route::prefix('profile')->name('profile.')->group(function () {

    // This will now be: route('profile.edit')
    Route::get('/', [ProfileController::class, 'edit'])->name('edit');

    Route::post('/update', [ProfileController::class, 'update'])->name('update');
    Route::post('/photo', [ProfileController::class, 'updatePhoto'])->name('photo');

    // CHANGE THIS LINE:
    Route::get('/index', [ProfileController::class, 'index'])->name('index');

    Route::post('/notifications', [ProfileController::class, 'toggleNotifications'])->name('notifications');

    Route::delete('/destroy', [ProfileController::class, 'destroy'])->name('destroy');
});

    // --- ADMIN PANEL ---
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/analytics', [DashboardController::class, 'index'])->name('analytics');
        // routes/web.php
        Route::get('/admin/analytics/export', [DashboardController::class, 'export'])->name('admin.analytics.export');
        Route::get('/admin/analytics/export', [App\Http\Controllers\DashboardController::class, 'export'])->name('admin.analytics.export');
        Route::get('/analytics/export', [DashboardController::class, 'export'])->name('analytics.export');
        Route::get('/dashboard', [MembersController::class, 'index'])->name('dashboard');
        Route::get('/members', [MembersController::class, 'index'])->name('members');
        Route::get('/blog', [MembersController::class, 'index'])->name('blog');
        Route::get('/live-stream', [MembersController::class, 'index'])->name('live-stream.view');

        // ADMIN API MANAGEMENT
        Route::prefix('api')->group(function () {
            // Video Management
            Route::get('/videos', [HLifeController::class, 'index'])->name('videos.index');
            Route::post('/videos', [HLifeController::class, 'store'])->name('videos.store');
            Route::match(['post', 'put', 'patch'], '/videos/{id}', [HLifeController::class, 'update'])->name('videos.update');
            Route::delete('/videos/{id}', [HLifeController::class, 'destroy'])->name('videos.destroy');
            Route::get('/studio-data', [LiveAttendanceController::class, 'getStudioData'])->name('studio-data');

            // --- FIXED EVENT MANAGEMENT ROUTES ---
            // These now point to the correct api methods in your AdminEventController
            Route::get('/events', [AdminEventController::class, 'apiIndex'])->name('events.index');
            Route::post('/events', [AdminEventController::class, 'apiSave'])->name('events.store');
            Route::post('/events/{id}', [AdminEventController::class, 'apiSave'])->name('events.update'); // For multipart/form-data updates
            Route::delete('/events/{id}', [AdminEventController::class, 'apiDestroy'])->name('events.destroy');

            // This is for the Blade view itself
            Route::get('/events-page', [AdminEventController::class, 'index'])->name('events.page');
        });

        // Admin Testimony Management
        Route::get('/testimonies/export', [TestimonyController::class, 'exportCsv'])->name('testimonies.export');
        Route::get('/testimonies', [TestimonyController::class, 'adminIndex'])->name('testimonies.index');
        Route::patch('/testimonies/{testimony}/toggle', [TestimonyController::class, 'toggleApproval'])->name('testimonies.toggle');
        Route::delete('/testimonies/{testimony}', [TestimonyController::class, 'destroy'])->name('testimonies.destroy');
        Route::put('/testimonies/{testimony}', [TestimonyController::class, 'update'])->name('testimonies.update');
    });
});
