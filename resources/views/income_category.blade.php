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
                            data-bs-target="#default" title="Add New Income Category">+</button>
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
						
						@foreach($income_categories as $newincome_categories)
                        <div class="col-6 col-lg-6 col-md-6">
                           <div class="card">
                              <div class="card-body px-3 py-4-5">
                                 <div class="row">
                                    <div class="col-md-4">
                                       <div class="stats-icon purple">
									   {!!$newincome_categories->category_icon!!}
                                       </div>
                                    </div>
                                    <div class="col-md-8">
                                       <h4 class="text-muted font-semibold">{{$newincome_categories->category_name}}</h4>
                                       <p><a style="cursor: pointer;color:green;" onclick="EditIncomeCategory({{$newincome_categories->id}})"><b>Edit</b></a>&nbsp;&nbsp;&nbsp;&nbsp;<a onclick="DeleteIncomecategory({{$newincome_categories->id}})" style="cursor: pointer;color:red;"><b>Delete</b></a></p>
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
                                <form class="form form-vertical" method="post" action="{{ route('insertnew_incomecategory') }}">
								@csrf
								<div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="myModalLabel1">Add New Income Category</h5>
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
						
<script>
	var token = $("meta[name='_token']").attr('content');
	var EditIncomecategory = "{{ route('editincomecategory') }}";
	var DeleteInccategory = "{{ route('deleteincomecategory') }}";
	
	
    function updateIconPreview() {
        const selectedIcon = document.getElementById("category_icon").value;
        document.getElementById("icon_preview").innerHTML = '<i class="' + selectedIcon + '"></i>';
    }
	
	function EditIncomeCategory(id){
		$.ajaxSetup({
					  headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					  }
				   });
		$.ajax({
				url:EditIncomecategory,
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
	
	function DeleteIncomecategory(id){
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
						url:DeleteInccategory,
						method:"POST",
						data:{
							_token:token,
							id:id
						},
						success:function(res){
							Swal.fire( 
								'income category Deleted', 
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
</script>
@endsection
