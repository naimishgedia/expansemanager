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
						

@endsection
