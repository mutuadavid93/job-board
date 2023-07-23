<?php

use App\Http\Controllers\ApplicationController;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JoblistingController;

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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });
Route::get('/search', fn() => Inertia::render('SearchJoblistings'));
Route::get('/thank-you', fn() => Inertia::render('ThankYou'))->name("thankyou");

Route::get("/", [JoblistingController::class, "displayJobs"])->name("home");
Route::get("/test-form", fn() => Inertia::render('TestForm'))->name("test.form");
Route::post("/checkout", [JoblistingController::class, "checkout"])->name("checkout.index");
Route::get("/success", [JoblistingController::class, "success"])->name("checkout.success");
Route::post("/cancel", [JoblistingController::class, "cancel"])->name("checkout.cancel");

// TIP: To test locally, Log into terminal and Run below command
// stripe listen --forward-to localhost:8000/webhook
Route::post('/webhook', [JoblistingController::class, 'webhook'])->name('checkout.webhook');

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get("/joblistings", [JoblistingController::class, "index"])->name("jobs.index");
Route::get("/joblistings/{joblisting}", [JoblistingController::class, "show"])->name("jobs.show");

// only users with the "employer" role or the "edit joblisting" permission can access the route.
Route::get("/joblistings/{joblisting}/edit", [JoblistingController::class, "edit"])
    ->middleware(["role_or_permission:employer|edit joblisting"])
    ->name("joblistings.edit");

Route::post("/joblistings/{joblisting}", [JoblistingController::class, "update"])->name("joblistings.update");

Route::get("/application/{joblisting}", [ApplicationController::class, "apply"])->name("applications.apply");
Route::post("/application/{joblisting}", [ApplicationController::class, "store"])->name("applications.store");
Route::get('/reload-captcha', [ApplicationController::class, 'reloadCaptcha']);

// User must be authorized to create a Joblisting
Route::post('/joblistings', [JoblistingController::class, 'store'])
    ->middleware("auth")
    ->name('jobs.store');

require __DIR__ . '/auth.php';
