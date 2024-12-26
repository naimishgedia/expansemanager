<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests; 
use App\Http\Controllers\Controller;
use App\Models\UserModel;
use App\Models\UserExpanseCategory;
use Hash;
use DB;  
use Session;

class DailyExpanseController extends Controller
{
     public function index(Request $request){     
		$page_title="Daily Category";   
		return view('daily_expanse',compact('page_title')); 
	}
}
