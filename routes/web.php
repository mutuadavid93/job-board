<?php

use App\Http\Controllers\JobListingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get("/", fn() => Inertia::render('Home'))->name("home");
Route::post("/checkout", [JobListingController::class, "checkout"])->name("checkout.index");
Route::get("/success", [JobListingController::class, "success"])->name("checkout.success");
Route::post("/cancel", [JobListingController::class, "cancel"])->name("checkout.cancel");

// TIP: To test locally, Log into terminal and Run below command
// stripe listen --forward-to localhost:8000/webhook
Route::post('/webhook', [JobListingController::class, 'webhook'])->name('checkout.webhook');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get("/joblistings", fn() => Inertia::render('Jobs'))->name("jobs.index");

require __DIR__ . '/auth.php';
