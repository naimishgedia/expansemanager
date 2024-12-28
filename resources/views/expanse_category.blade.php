@extends('layouts.mainlayout')
@section('content')  

	
<div id="main">
            <header class="mb-3">
               <a href="#" class="burger-btn d-block d-xl-none">
               <i class="bi bi-justify fs-3"></i>
               </a>
            </header>
			
            <div class="page-heading row">
				<div class="col-md-10">
					 <h3>{{$page_title}}</h3>
				</div>
				<div class="col-md-2" style="text-align: end;">
					<button href="#" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#default" title="Add New Expanse Category">+</button>
				</div>
              
			   
            </div>
			@if (Session::has('successmsg'))
					   <div class="alert alert-success z-depth-1" role="alert" id="alertmsg">
							<strong>{!! Session::get('successmsg') !!}</strong>
					   </div>
			@endif 
			@if (Session::has('errormsg'))
						<div class="alert alert-danger z-depth-1" role="alert" id="alertmsg">
							<strong>{!! Session::get('errormsg') !!}</strong>
					</div>
			@endif
            <div class="page-content">
               <section class="row">
                  <div class="col-12 col-lg-12">
                     <div class="row">
						@php
							use App\Models\SubExpanseCategory;
						@endphp
						
						@foreach($expanse_categories as $newexpanse_categories)
						
						
						@php
							$subcategories = SubExpanseCategory::where('user_id', auth()->user()->id)
								->where('exp_cat_id', $newexpanse_categories->id)
								->get(); 
						@endphp
                        <div class="col-6 col-lg-6 col-md-6">
                           <div class="card">
                              <div class="card-body px-3 py-4-5">
                                 <div class="row">
                                    <div class="col-md-2">
                                       <div style="float: left;" class="stats-icon purple">
									   {!!$newexpanse_categories->category_icon!!}
                                       </div>
                                    </div>
                                    <div class="col-md-10"> 
                                       <h4 class="text-muted font-semibold"> {{$newexpanse_categories->category_name}}</h4>
                                       <p><a style="cursor: pointer;color:green;" onclick="EditExpanseCategory({{$newexpanse_categories->id}})"><b>Edit</b></a>&nbsp;&nbsp;&nbsp;&nbsp;<a onclick="DeleteExpansecategory({{$newexpanse_categories->id}})" style="cursor: pointer;color:red;"><b>Delete</b></a></p><br>
									   
                                       <div class="row col-md-12">
										<div class="col-md-8">
											<input type="text" placeholder="Add Subcategory" name="subcategory_name" id="subcategory_name{{$newexpanse_categories->id}}" class="form-control">
										</div>
										<div class="col-md-4">
											<button class="btn btn-primary" onclick="SaveSubexpanseCat({{$newexpanse_categories->id}})"><span id="loader_btn{{$newexpanse_categories->id}}" style="display:none;" class="spinner-border spinner-border-sm"></span>&nbsp;Save</button>
										</div>
                                       </div><br>
									   <div id="dynamic_div{{$newexpanse_categories->id}}" class="row col-md-12">
										@foreach($subcategories as $newsubcategories)
											<div class="col-md-6" style="border: 1px solid #d3d3d3;padding: 7px;">
											{{$newsubcategories->subcategory_name}}
											</div>
											<div class="col-md-3" style="border: 1px solid #d3d3d3;padding: 7px;">
												<a onclick="EditSubExpanseCategory({{$newsubcategories->id}},{{$newexpanse_categories->id}})" style="cursor: pointer;color:green;" ><b>Edit</b></a>
											</div>
											<div class="col-md-3" style="border: 1px solid #d3d3d3;    padding: 7px;">
												<a onclick="DeleteSubExpanseCategory({{$newsubcategories->id}},{{$newexpanse_categories->id}})" style="cursor: pointer;color:red;"><b>Delete</b></a>
											</div>
										@endforeach
									   </div>
									
									</div>
                                 </div>
                              </div>
                           </div>
                        </div>
						@endforeach
						
                        
                        
                        
                     </div>
                  </div>
               </section>
            </div>
         </div>
		 
		 
		 <div class="modal fade text-left" id="default" tabindex="-1" role="dialog"
                            aria-labelledby="myModalLabel1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                <form class="form form-vertical" method="post" action="{{ route('insertnewcategory') }}">
								@csrf
								<div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myModalLabel1">Add New Expanse Category</h5>
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
																		<input type="text" id="category_name" class="form-control" name="category_name" placeholder="Category Name" required>
																	</div>
																</div>
																<div class="col-12">
																	<div class="form-group">
																		<label for="category_icon">Category Icon</label>
																		<select required id="category_icon" name="category_icon" class="form-control" onchange="updateIconPreview()">
																			<option value="" selected>--Select Icon--</option>
																			<option value="fa fa-cutlery">Food & Dining</option>
																			<option value="fa fa-automobile"> Transportation</option>
																			<option value="fa fa-home">Housing</option>
																			<option value="fa fa-music"> Entertainment</option>
																			<option value="fa fa-heart">Health & Fitness</option>
																			<option value="fa fa-dumbbell">Gym Memberships</option>
																			<option value="fa fa-medkit">Medical Expenses</option>
																			<option value="fa fa-shopping-cart">Shopping</option>
																			<option value="fa fa-window-maximize"> Bills</option>
																			<option value="fa fa-ticket">Insurance</option>
																			<option value="fa fa-graduation-cap">Education</option>
																		</select>
																	</div>
																</div>
																<div class="col-12">
																	<div class="form-group">
																		<label for="icon_preview">Selected Icon Preview</label>
																		<div id="icon_preview" class="form-control" style="font-size: 50px; text-align: center;">
																			<i class="fa fa-question"></i> <!-- Default preview icon -->
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
                                            <span class="d-none d-sm-block">Save</span>
                                        </button>
                                    </div>
									</form>
                                </div>
                            </div>
                        </div>
						
						<div class="modal fade text-left" id="subexpanse_categorymodel" tabindex="-1" role="dialog"
                                    aria-labelledby="myModalLabel19" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-sm"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myModalLabel19">Edit Sub Expanse Category</h4>
                                               
                                            </div>
                                            <div class="modal-body">
												<div class="col-12">
													<div class="form-group">
														<input type="text" id="subcategory_name" class="form-control" name="subcategory_name" placeholder="Subcategory Name" required>
													</div>
												</div>
                                            </div>
											<input type="hidden" id="subcat_id">
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-secondary btn-sm"
                                                    data-bs-dismiss="modal">
                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                    <span class="d-sm-block d-none">Close</span>
                                                </button>
                                                <button type="button" onclick="UpdateSubcategory()" class="btn btn-primary ml-1 btn-sm"
                                                    data-bs-dismiss="modal">
                                                    <i class="bx bx-check d-block d-sm-none"></i>
                                                    <span class="d-sm-block d-none">Update</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
						
<script>
	var token = $("meta[name='_token']").attr('content');
	var EditExpcategory = "{{ route('editexpcategory') }}";
	var DeleteExpcategory = "{{ route('deleteexpcategory') }}";
	
	
    function updateIconPreview() {
        const selectedIcon = document.getElementById("category_icon").value;
        document.getElementById("icon_preview").innerHTML = '<i class="' + selectedIcon + '"></i>';
    }
	
	function EditExpanseCategory(id){
		$.ajaxSetup({
					  headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					  }
				   });
		$.ajax({
				url:EditExpcategory,
				method:"POST",
				data:{
					_token:token,
					id:id
				},
				success:function(res){
					$("#default").empty();
					$("#default").append(res);
					$('#default').modal('toggle'); 	
				}
		})
	}
	
	function DeleteExpansecategory(id){
		Swal.fire({
			  title: 'Are you sure?',
			  text: "",
			  icon: 'warning',
			  showCancelButton: true,
			  confirmButtonColor: '#3085d6', 
			  cancelButtonColor: '#d33',
			  confirmButtonText: 'Yes,Delete It'
		}).then((result) => {
				if (result.isConfirmed) {
							$.ajaxSetup({
							  headers: {
								'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
							  }
						   });
				$.ajax({
						url:DeleteExpcategory,
						method:"POST",
						data:{
							_token:token,
							id:id
						},
						success:function(res){
							Swal.fire( 
								'Expanse category Deleted', 
								'', 
								'success'
							).then((value) => { 
									location.reload(); 
							});
 	
						}
				})
				}
		});
	}
	
	
	var Save_subexpansecategory = "{{ route('save_subexpansecategory') }}";
	function SaveSubexpanseCat(id){
		var subcategory_name=$("#subcategory_name"+id+"").val();
		if(subcategory_name==""){
			alert("Please enter subcategory name");
			return false;
		}
		$("#loader_btn"+id+"").show();
		$.ajaxSetup({
					  headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					  }
				   });
		$.ajax({
				url:Save_subexpansecategory,
				method:"POST",
				data:{
					_token:token,
					exp_cat_id:id,
					subcategory_name:subcategory_name
				},
				success:function(res){
					if(res==0){
						alert("Something Went Wrong");
					}else{
						$("#loader_btn"+id+"").hide();
						$("#subcategory_name"+id+"").val("");
						$("#dynamic_div"+id+"").empty(); 	
						$("#dynamic_div"+id+"").append(res); 
					}
						
				}
		})
	}
	
	var Delete_SubExpanseCategory = "{{ route('delete_subexpansecategory') }}";
	function DeleteSubExpanseCategory(SubExpansecat_ID,ExpanseCat_ID){
		$.ajaxSetup({
					  headers: { 
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					  }
				   });
		$.ajax({
				url:Delete_SubExpanseCategory,
				method:"POST",
				data:{
					_token:token,
					sub_exp_cat:SubExpansecat_ID,
					exp_cat:ExpanseCat_ID
				},
				success:function(res){
					if(res==0){
						alert("Something Went Wrong");
					}else{
						$("#dynamic_div"+ExpanseCat_ID+"").empty(); 	
						$("#dynamic_div"+ExpanseCat_ID+"").append(res); 
					}
						
				}
		})
	}
	
	var edit_Subexpanse_category = "{{ route('edit_Subexpanse_category') }}";
	function EditSubExpanseCategory(Subcategory_ID,Category_ID){
		$.ajaxSetup({
					  headers: { 
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					  }
				   });
		$.ajax({
				url:edit_Subexpanse_category,
				method:"POST",
				data:{
					_token:token,
					Subcategory_ID:Subcategory_ID,
					Category_ID:Category_ID
				},
				success:function(res){
					var json = JSON.parse(res);
					var subcategory_name=json.subcategory_name;
					var id=json.id;
					$("#subcat_id").val(id);
					$("#subcategory_name").val(subcategory_name);
					$('#subexpanse_categorymodel').modal('toggle'); 
				}
		})
	}
	
	
	var update_Subcategory = "{{ route('update_Subcategory') }}";
	function UpdateSubcategory(){
		var subcat_id=$("#subcat_id").val();
		var subcategory_name=$("#subcategory_name").val();
		$.ajaxSetup({
					  headers: { 
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					  }
				   });
		$.ajax({
				url:update_Subcategory,
				method:"POST",
				data:{
					_token:token,
					subcat_id:subcat_id,
					subcategory_name:subcategory_name
				},
				success:function(res){
					
					var json = JSON.parse(res);
					var status= json.status;
					
					Swal.fire( 
						'Data Updated', 
						'', 
						'success'
					).then((value) => { 
							location.reload();
					});

					/* $("#subcat_id").val("");
					$("#subcategory_name").val("");
					$('#subexpanse_categorymodel').modal('toggle');  */
				}
		})
	}
</script>
@endsection
