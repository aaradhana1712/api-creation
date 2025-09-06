<?php
// routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\Admin\AdminController;  
use App\Http\Controllers\Admin\UserController;  
use App\Http\Controllers\Admin\AuthController;

// Root route
Route::get('/', function () {
    return response()->json([
        'message' => 'Laravel API is running 🚀',
        'version' => '1.0.0',
        'database' => 'media_db',
        'status' => 'active',
        'timestamp' => now()->toISOString(),
        'endpoints' => [
            'GET /api/users' => 'Get all users',
            'POST /api/users' => 'Create new user',
            'GET /api/users/{id}' => 'Get specific user',
            'PUT /api/users/{id}' => 'Update user',
            'DELETE /api/users/{id}' => 'Delete user',
            'Admin Panel' => [
                'GET /admin/login' => 'Admin login page',
                'POST /admin/login' => 'Admin login',
                'GET /admin/register' => 'Admin register page',
                'POST /admin/register' => 'Admin register',
                'GET /admin/dashboard' => 'Admin dashboard (authenticated)',
                'POST /admin/logout' => 'Admin logout'
            ]
        ]
    ]);
})->name('home');

// API Resource Routes
Route::apiResource('users', UsersController::class);

// Admin routes group
Route::prefix('admin')->name('admin.')->group(function() {
    
    // Guest routes (not authenticated)
    Route::middleware('guest')->group(function() {
        Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('/login', [AuthController::class, 'login'])->name('login.post');
        Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
        Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    });

    // FIX: Handle typo URL - add this route
    Route::get('/dasboard', function() {
        if (auth()->check()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('admin.login')->with('info', 'Please login first to access dashboard (URL corrected)');
    });
    
    // Authenticated routes
    Route::middleware('auth')->group(function() {
        // Dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        
        // User management
        Route::resource('users', UserController::class);
        
        // Profile management
        Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
        Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
        Route::post('/change-password', [AuthController::class, 'changePassword'])->name('password.change');
        
        // Logout
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    });
});

// General logout route (fallback)
Route::post('/logout', function(Illuminate\Http\Request $request) {
    try {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // Redirect based on where they came from
        $referer = $request->headers->get('referer');
        if ($referer && str_contains($referer, '/admin')) {
            return redirect()->route('admin.login')->with('success', 'Logged out successfully!');
        }
        
        return redirect('/')->with('success', 'Logged out successfully!');
    } catch (\Exception $e) {
        \Illuminate\Support\Facades\Log::error('General logout error', [
            'error' => $e->getMessage(),
            'ip' => $request->ip()
        ]);
        
        return redirect('/')->with('warning', 'Logout completed with warnings.');
    }
})->name('logout');

// Catch-all route for admin (redirect to login if not authenticated)
Route::get('/admin', function() {
    if (auth()->check()) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('admin.login');
});

// Health check route
Route::get('/health', function() {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now()->toISOString(),
        'database' => 'connected',
        'cache' => 'active'
    ]);
})->name('health');