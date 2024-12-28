<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests; 
use App\Http\Controllers\Controller;
use App\Models\UserModel;
use App\Models\UserExpanseCategory;
use App\Models\SubExpanseCategory;
use App\Models\MonthlyExpanse;
use Hash;
use DB;  
use Session;

class DailyExpanseController extends Controller
{
     public function index(Request $request){     
		$page_title="Daily Category";   
		$ExpanseCategory=UserExpanseCategory::where('user_id', auth()->user()->id)->get();
		return view('daily_expanse',compact('page_title','ExpanseCategory')); 
	}
	
	public function getsubcategory(Request $request){
		$input = $request->all(); 
		$ExpanseCategory=SubExpanseCategory::where('user_id', auth()->user()->id)->where('exp_cat_id', $input['category_id'])->get();
		$data='<option selected value="">--Select Subcategory--</option>';
		foreach($ExpanseCategory as $newExpanseCategory){
			$data.='<option value="'.$newExpanseCategory->id.'">'.$newExpanseCategory->subcategory_name.'</option>';
		}
		$data.='';
		echo $data;
	}
	
	public function InsertDailyExpanse(Request $request){
		 $request->validate([
			'expanse_date' => 'required|date',
			'amount' => 'required|numeric',
			'category_id' => 'required|integer|exists:user_expanse_category,id',
			'subcategory_id' => 'required|integer|exists:sub_expanse_category,id',
			'note' => 'nullable|string',
			'description' => 'nullable|string',
		]);

		$input = $request->all();
		$monthlyExpanse = new MonthlyExpanse();
		$monthlyExpanse->expanse_date = $input['expanse_date'];
		$monthlyExpanse->amount = $input['amount'];
		$monthlyExpanse->category_id = $input['category_id'];
		$monthlyExpanse->subcategory_id = $input['subcategory_id'];
		$monthlyExpanse->note = $input['note'];
		$monthlyExpanse->description = $input['description'];
		if ($monthlyExpanse->save()) {
			return redirect()->back()->with('success', 'Expanse added successfully!');
		} else {
			return redirect()->back()->with('error', 'Failed to add expanse. Please try again.');
		}
	}
	
	
}
