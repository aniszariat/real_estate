<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function AdminDashboard()
    {
        // return view('admin.admin_dashboard');
        return view('admin.index');
    }   // end method


    public function AdminLogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }

    public function AdminLogin()
    {
        return view('admin.admin_login');
    }   // end method

    public function AdminProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        // return view('admin.admin_profile_view');
        return view('admin.admin_profile_view', compact('profileData'));
    }
}
