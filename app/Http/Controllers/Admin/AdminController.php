<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    /**
     * Admin dashboard - uses your existing view
     */
    public function dashboard()
    {

        if (!auth()->check()) {
            return redirect()->route('admin.login')->with('error', 'Please login first to access dashboard.');
        }

        // आपका existing dashboard view return करते हैं
        return view('admin.dashboard');
    }
}