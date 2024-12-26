<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests; 
use App\Http\Controllers\Controller;
use App\Models\UserModel;
use App\Models\UserIncomeCategory;
use Hash;
use DB;  
use Session;

class IncomeCategoryController extends Controller
{
     public function index(Request $request){     
		$page_title="Income Category"; 
		$income_categories = UserIncomeCategory::where('user_id', auth()->user()->id)->get();
		return view('income_category',compact('page_title','income_categories')); 
	}
	
	public function insertnew_incomecategoryFunction(Request $request){
		$icon_code='<i class="'.$request->category_icon.'"></i>';
		$incomeCategory = UserIncomeCategory::create([
			'user_id' => auth()->user()->id, // Assuming you have authenticated user
			'category_name' => $request->category_name,
			'category_icon' => $icon_code
		]);

		// Check if the category was inserted successfully
		if ($incomeCategory) {
			return redirect()->back()->with('successmsg', 'Income category added successfully!');
		} else {
			return redirect()->back()->with('errormsg', 'Something went wrong. Please try again.');
		}
	}
	
	public function editincomecategoryFunction(Request $request){
		$input = $request->all();
		$incomecategory = UserIncomeCategory::findOrFail($input['id']);
		$categoryIconHtml = $incomecategory->category_icon;
		preg_match('/class="([^"]+)"/', $categoryIconHtml, $matches);
		$iconClass = $matches[1]; 
		$data='<div class="modal-dialog modal-dialog-scrollable" role="document">
                                <form class="form form-vertical" method="post" action="'.route('updateincomecataegory').'">
								<input type="hidden" name="_token" id="csrf" value="'.csrf_token().'">
								<input type="hidden" name="id" value="'.$incomecategory->id .'"> 
								<div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myModalLabel1">Edit Income Category</h5>
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
																		<input type="text" id="category_name" class="form-control" name="category_name" placeholder="Category Name" required value="'.$incomecategory->category_name.'">
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
	
	public function updateincomecataegoryfunction(Request $request){
		$incomecategory = UserIncomeCategory::findOrFail($request->input('id'));
		$incomecategory->category_name = $request->input('category_name');
        $incomecategory->category_icon = '<i class="' . $request->input('category_icon') . '"></i>';
		$incomecategory->save();
		return redirect()->back()->with('successmsg', 'Income category updated successfully!');
	} 
	
	public function deleteincomecategoryFunction(Request $request){
		 $id = $request->input('id');
		 $incCategory = UserIncomeCategory::findOrFail($id);
		 $incCategory->delete();
		 return 1;
	}
	
	
	
	
}
