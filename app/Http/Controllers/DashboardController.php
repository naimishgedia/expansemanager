<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests; 
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\UserModel;
use Hash;
use DB;  
use Session;

class DashboardController extends Controller
{
    public function index(Request $request){
		$page_title="Dashboard";
		return view('dashboard',compact('page_title')); 
	}
	
	public function changepasswordFunction(Request $request){
		$page_title="Change Password";
		return view('changepassword',compact('page_title')); 
	}
	
	public function changePassword(Request $request)
    {
        $request->validate([
            'current_pass' => 'required',
            'password' => 'required|min:6|confirmed',
        ], [
            'current_pass.required' => 'Please enter your current password.',
            'password.required' => 'Please enter your new password.',
            'password.min' => 'The new password must be at least 6 characters.',
            'password.confirmed' => 'New password and confirmation does not match',
        ]);

        // Check if the current password matches the one in the database
        if (!Hash::check($request->current_pass, Auth::user()->password)) {
            return back()->withErrors(['current_pass' => 'Current password is incorrect']);
        }

        // Update the password
        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->visible_password = $request->password; // If you're storing the visible password
        $user->save();
		session()->flash('successmsg', 'Password changed successfully!');
		return redirect()->back();
    }
}
