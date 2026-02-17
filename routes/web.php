<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
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

/*
|--------------------------------------------------------------------------
| 1. Public Web Routes
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => view('welcome'))->name('home');
Route::get('/about', function () {
    return view('about'); // Ensure resources/views/about.blade.php exists
})->name('about');
Route::get('/find-center', [ServiceCenterController::class, 'index'])->name('centers.index');
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/live', [LiveStreamController::class, 'index'])->name('livestream.view');
Route::get('/h-life', fn() => view('h-life'));
Route::get('/contact', fn() => view('contact'));
Route::post('/contact/submit', [ContactController::class, 'store'])->name('contact.store');

// TESTIMONIES SYSTEM
Route::get('/testimonies', [TestimonyController::class, 'index'])->name('testimonies.index');
// Public Submission
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
        // FIXED: Removed the stray character before Route::get
        Route::get('/stream/{streamId}', [LiveCommentController::class, 'index'])->name('api.comments.index');
        Route::post('/', [LiveCommentController::class, 'store']);
        Route::put('/{id}', [LiveCommentController::class, 'update']);
        Route::post('/{id}/reply', [LiveCommentController::class, 'reply']);
        Route::delete('/{id}', [LiveCommentController::class, 'destroy']);
    });

    Route::post('/live/attendance', [LiveAttendanceController::class, 'storeAttendance']);
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
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::post('/update', [ProfileController::class, 'update'])->name('update');
        Route::post('/photo', [ProfileController::class, 'updatePhoto'])->name('photo');
    });

    // --- ADMIN PANEL ---
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [MembersController::class, 'index'])->name('dashboard');
        Route::get('/members', [MembersController::class, 'index'])->name('members');
        Route::get('/blog', [MembersController::class, 'index'])->name('blog');
        Route::get('/live-stream', [MembersController::class, 'index'])->name('live-stream.view');

        // Admin Testimony Management
        Route::get('/testimonies/export', [TestimonyController::class, 'exportCsv'])->name('testimonies.export');
        Route::get('/testimonies', [TestimonyController::class, 'adminIndex'])->name('testimonies.index');
        Route::patch('/testimonies/{testimony}/toggle', [TestimonyController::class, 'toggleApproval'])->name('testimonies.toggle');
        Route::delete('/testimonies/{testimony}', [TestimonyController::class, 'destroy'])->name('testimonies.destroy');

        // NEW: Testimony Update Route
        Route::put('/testimonies/{testimony}', [TestimonyController::class, 'update'])->name('testimonies.update');
    });
});
