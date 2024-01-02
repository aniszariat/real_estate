<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
    public function AdminProfileStore(Request $request)
    {
        echo 'in';
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->username = $request->username;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->phone = $request->phone;
        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/' . $data->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $data['photo'] = $filename;
        }
        $data->save();
        $notification = array(
            'message' => 'Admin profile updated successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    public function AdminChangePassword()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_change_password', compact('profileData'));
    }
    public function AdminUpdatePassword(Request $request)
    {
        // validation 
        $request->validate([
            "old_password" => 'required',
            "new_password" => 'required|confirmed'
        ]);
        // match the old password
        if (!Hash::check($request->old_password, auth::user()->password)) {
            $notification = array(
                'message' => 'Old password does not match!',
                'alert-type' => 'error'
            );
            return back()->with($notification);
        }
        // update the new password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        $notification = array(
            'message' => 'Admin password successfully changed!',
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
}
