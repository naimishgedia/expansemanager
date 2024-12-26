<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Models\UserModel;
use App\Models\UserExpanseCategory;
use App\Models\UserIncomeCategory;
use DB;
use Hash;
use Session;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
	
	public function registerFunction()
    {
		$page_title="Register";
		return view('auth/register',compact('page_title'));
    }
	
	public function do_registerFunction(Request $request)
	{
		$request->validate([
			'name' => 'required|string|max:255',
			'email' => 'required|email|unique:users,email',
			'password' => 'required|confirmed|min:6', 
		], [
			'name.required' => 'The name field is required.',
			'email.required' => 'The email field is required.',
			'email.unique' => 'This email is already taken.',
			'password.required' => 'The password field is required.',
			'password.confirmed' => 'Password and Confirm password do not match.',
		]);

		$existingUser = UserModel::where('email', $request->email)->first();
		if ($existingUser) {
			session()->flash('errormsg', 'You are already registered with this email.');
			return redirect()->back()->withInput(); // Keep old input data
		}
		$input = $request->except(['_token', 'password_confirmation']);
		$input['visible_password'] = $request->password; // For whatever reason you are storing this
		$input['password'] = Hash::make($request->password); // Hashing the password
		
        $user = UserModel::create($input);
		Auth::login($user);  // Log in the user after registration
		event(new Registered($user));
		if ($user) {
			// Insert default expense categories 
			 $defaultExpanseCategories = [
					['category_name' => 'Food & Dining', 'category_icon' => '<i class="fa fa-cutlery"></i>'],
					['category_name' => 'Transportation', 'category_icon' => '<i class="fa fa-automobile"></i>'],
					['category_name' => 'Housing', 'category_icon' => '<i class="fa fa-home"></i>'],
					['category_name' => 'Entertainment', 'category_icon' => '<i class="fa fa-film"></i>'],
					['category_name' => 'Health & Fitness', 'category_icon' => '<i class="fa fa-heart"></i>'],
					['category_name' => 'Gym Memberships', 'category_icon' => '<i class="fa fa-asl-interpreting"></i>'],
					['category_name' => 'Medical Expenses', 'category_icon' => '<i class="fa fa-medkit"></i>'],
					['category_name' => 'Shopping', 'category_icon' => '<i class="fa fa-shopping-cart"></i>'],
					['category_name' => 'Bills', 'category_icon' => '<i class="fa fa-window-maximize"></i>'],
					['category_name' => 'Insurance', 'category_icon' => '<i class="fa fa-ticket"></i>'],
					['category_name' => 'Education', 'category_icon' => '<i class="fa fa-graduation-cap"></i>'],
			];
			foreach ($defaultExpanseCategories as $category) {
				UserExpanseCategory::create([
					'user_id' => $user->id,
					'category_name' => $category['category_name'],
					'category_icon' => $category['category_icon'] // Adding category icon
				]);
			}

			// Insert default income categories
			     $defaultIncomeCategories = [
				['category_name' => 'Salary', 'category_icon' => '<i class="fa fa-money"></i>'],
				['category_name' => 'Freelancing', 'category_icon' => '<i class="fa fa-laptop"></i>'],
				['category_name' => 'Rental Income', 'category_icon' => '<i class="fa fa-building"></i>'],
				['category_name' => 'Other Income', 'category_icon' => '<i class="fa fa-briefcase"></i>']
			];

			foreach ($defaultIncomeCategories as $category) {
				UserIncomeCategory::create([
					'user_id' => $user->id,
					'category_name' => $category['category_name'],
					'category_icon' => $category['category_icon'], // Set icon for each category
				]);
			}

			session()->flash('successmsg', 'Welcome! Your registration is complete!');
			return redirect()->route('dashboard');   
		} else {
			session()->flash('errormsg', 'Something went wrong, try again');
			return redirect()->back();
		}
	}
	
	public function loginFunction(Request $request){
		$page_title="Login";
		return view('auth/login',compact('page_title'));
	}
	
	public function do_loginFunction(Request $request)
	{
		$request->validate([
			'email' => 'required|email', // Ensure the email is required and is a valid format
			'password' => 'required|min:6', // Ensure the password is required and has a minimum length
		]);

		if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
			$request->session()->regenerate();
			return redirect()->route('dashboard')->with('successmsg', 'Welcome back!'); 
		} else {
			session()->flash('errormsg', 'Email or password is incorrect');
			return redirect()->route('login')->withInput($request->only('email')); // Retain the email input
		}
	}
	
	public function logoutFunction()
	{
		auth()->logout();
		\Session::flush(); 
		return redirect()->route('login');
	}

	
	
	
	
}
