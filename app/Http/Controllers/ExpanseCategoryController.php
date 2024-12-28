<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests; 
use App\Http\Controllers\Controller;
use App\Models\UserModel;
use App\Models\UserExpanseCategory;
use App\Models\SubExpanseCategory;
use Hash;
use DB;  
use Session;

class ExpanseCategoryController extends Controller
{
    public function index(Request $request){     
		$page_title="Expanse Category"; 
		$expanse_categories = UserExpanseCategory::where('user_id', auth()->user()->id)->get();
		return view('expanse_category',compact('page_title','expanse_categories')); 
	}
	
	public function insertnewcategoryFunction(Request $request){
		$icon_code='<i class="'.$request->category_icon.'"></i>';
		$expanseCategory = UserExpanseCategory::create([
			'user_id' => auth()->user()->id, // Assuming you have authenticated user
			'category_name' => $request->category_name,
			'category_icon' => $icon_code
		]);

		// Check if the category was inserted successfully
		if ($expanseCategory) {
			return redirect()->back()->with('successmsg', 'Expense category added successfully!');
		} else {
			return redirect()->back()->with('errormsg', 'Something went wrong. Please try again.');
		}
	}
	
	
	public function editexpcategory(Request $request){
		$input = $request->all();
		$expcategory = UserExpanseCategory::findOrFail($input['id']);
		$categoryIconHtml = $expcategory->category_icon;
		preg_match('/class="([^"]+)"/', $categoryIconHtml, $matches);
		$iconClass = $matches[1]; 
		$data='<div class="modal-dialog modal-dialog-scrollable" role="document">
                                <form class="form form-vertical" method="post" action="'.route('updateexpcataegory').'">
								<input type="hidden" name="_token" id="csrf" value="'.csrf_token().'">
								<input type="hidden" name="id" value="'.$expcategory->id .'"> 
								<div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myModalLabel1">Edit Expanse Category</h5>
                                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal"
                                            aria-label="Close">
                                            <i data-feather="x"></i>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                       
											
											<div class="card-content">
												<div class="card-body">
													
														<div class="form-body">
															<div class="row">
																<div class="col-12">
																	<div class="form-group">
																		<label for="category_name">Category Name</label>
																		<input type="text" id="category_name" class="form-control" name="category_name" placeholder="Category Name" required value="'.$expcategory->category_name.'">
																	</div>
																</div>
																<div class="col-12">
																	<div class="form-group">
																		<label for="category_icon">Category Icon</label>
																		<select required id="category_icon" name="category_icon" class="form-control" onchange="updateIconPreview()">
																			<option value="" selected>--Select Icon--</option>
																			<option value="fa fa-cutlery" '.($iconClass == "fa fa-cutlery" ? "selected" : "").'>Food & Dining</option>
																			<option value="fa fa-automobile" '.($iconClass == "fa fa-automobile" ? "selected" : "").'>Transportation</option>
																			<option value="fa fa-home" '.($iconClass == "fa fa-home" ? "selected" : "").'>Housing</option>
																			<option value="fa fa-film" '.($iconClass == "fa fa-film" ? "selected" : "").'>Entertainment</option>
																			<option value="fa fa-heart" '.($iconClass == "fa fa-heart" ? "selected" : "").'>Health & Fitness</option>
																			<option value="fa fa-asl-interpreting" '.($iconClass == "fa fa-dumbbell" ? "selected" : "").'>Gym Memberships</option>
																			<option value="fa fa-medkit" '.($iconClass == "fa fa-medkit" ? "selected" : "").'>Medical Expenses</option>
																			<option value="fa fa-shopping-cart" '.($iconClass == "fa fa-shopping-cart" ? "selected" : "").'>Shopping</option>
																			<option value="fa fa-window-maximize" '.($iconClass == "fa fa-window-maximize" ? "selected" : "").'>Bills</option>
																			<option value="fa fa-ticket" '.($iconClass == "fa fa-ticket" ? "selected" : "").'>Insurance</option>
																			<option value="fa fa-graduation-cap" '.($iconClass == "fa fa-graduation-cap" ? "selected" : "").'>Education</option>
																		</select>
																	</div>
																</div>
																<div class="col-12">
																	<div class="form-group">
																		<label for="icon_preview">Selected Icon Preview</label>
																		<div id="icon_preview" class="form-control" style="font-size: 50px; text-align: center;">
																			<i class="'.$iconClass.'"></i> <!-- Default preview icon -->
																		</div>
																	</div>
																</div>
															</div>
														</div>
													
												</div>
											</div>
										
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn" data-bs-dismiss="modal">
                                            <i class="bx bx-x d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Close</span>
                                        </button>
                                        <button type="submit" class="btn btn-primary ml-1">
                                            <i class="bx bx-check d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Update</span>
                                        </button>
                                    </div>
									</form>
                                </div>
                            </div>';
			echo $data;
	}
	
	public function updateexpcataegory(Request $request){
		$expcategory = UserExpanseCategory::findOrFail($request->input('id'));
		$expcategory->category_name = $request->input('category_name');
        $expcategory->category_icon = '<i class="' . $request->input('category_icon') . '"></i>';
		$expcategory->save();
		return redirect()->back()->with('successmsg', 'Expense category updated successfully!');
	}
	
	public function deleteexpcategory(Request $request){
		 $id = $request->input('id');
		 $expCategory = UserExpanseCategory::findOrFail($id);
		 $expCategory->delete();
		 return 1;
	}
	
	public function save_subexpansecategory(Request $request){
		$input = $request->all(); 
		$sub_expanseCategory = SubExpanseCategory::create([
			'user_id' => auth()->user()->id, 
			'exp_cat_id' => $input['exp_cat_id'],
			'subcategory_name' => $input['subcategory_name']
		]);
		if ($sub_expanseCategory) {
			$UserSubexpanseCat = SubExpanseCategory::where('user_id', auth()->user()->id)
								->where('exp_cat_id', $input['exp_cat_id'])
								->get();
			
			$table='';
			foreach($UserSubexpanseCat as $newUserSubexpanseCat){
			$table.='<div class="col-md-6" style="border: 1px solid #d3d3d3;padding: 7px;">
				'.$newUserSubexpanseCat->subcategory_name.'
			</div>
			<div class="col-md-3" style="border: 1px solid #d3d3d3;padding: 7px;">
				<a onclick="EditSubExpanseCategory('.$newUserSubexpanseCat->id.','.$input['exp_cat_id'].')"        		style="cursor: pointer;color:green;"><b>Edit</b></a>
			</div>
			<div class="col-md-3" style="border: 1px solid #d3d3d3;padding: 7px;" onclick="DeleteSubExpanseCategory('.$newUserSubexpanseCat->id.','.$input['exp_cat_id'].')" >
				<a style="cursor: pointer;color:red;"><b>Delete</b></a>
			</div>';
			}
			$table.='';
			echo $table;
		} else {
			echo 0;
		}
	}
	
	public function delete_subexpansecategory(Request $request){
		$input = $request->all();
		$id = $request->input('sub_exp_cat');
		$SubexpCategory = SubExpanseCategory::findOrFail($id);
		if ($SubexpCategory->delete()) {
			$UserSubexpanseCat = SubExpanseCategory::where('user_id', auth()->user()->id)
								->where('exp_cat_id', $input['exp_cat'])
								->get();
			  
			if(sizeof($UserSubexpanseCat)==0){
				echo "No Data Available";
			}else{
				$table='';  
				foreach($UserSubexpanseCat as $newUserSubexpanseCat){  
				$table.='<div class="col-md-6" style="border: 1px solid #d3d3d3;padding: 7px;">
					'.$newUserSubexpanseCat->subcategory_name.'
				</div>
				<div class="col-md-3" style="border: 1px solid #d3d3d3;padding: 7px;">
					<a onclick="EditSubExpanseCategory('.$newUserSubexpanseCat->id.','.$input['exp_cat'].')" style="cursor: pointer;color:green;"><b>Edit</b></a>
				</div>
				<div class="col-md-3" style="border: 1px solid #d3d3d3;padding: 7px;" onclick="DeleteSubExpanseCategory('.$newUserSubexpanseCat->id.','.$input['exp_cat'].')" >
					<a style="cursor: pointer;color:red;"><b>Delete</b></a>
				</div>';
				}
				$table.='';
				echo $table;
			}
			 
			
		}else{
			echo 0;
		}
	}
	
	public function edit_Subexpanse_category(Request $request){
		$input = $request->all();
		$expcategory = SubExpanseCategory::findOrFail($input['Subcategory_ID']);
		echo json_encode($expcategory);
	}
	
	public function update_Subcategory(Request $request){
		$input = $request->all();
		$subcategory = SubExpanseCategory::findOrFail($request->input('subcat_id'));
		$subcategory->subcategory_name = $request->input('subcategory_name');
		$subcategory->save();
		echo 1;  
       /*  if ($subcategory->save()) {
			return response()->json(['status' => '1']);
		} else {
			return response()->json(['status' => '0']);
		} */
	}
	
	
	
}
