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
            data-bs-target="#large" title="Add Expanse">+</button>
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
               <div class="card">
			   
                  <div class="card-content">
                     <div class="card-body">
                        <ul class="list-group">
                           <li class="list-group-item active">Cras justo odio</li>
                           <li class="list-group-item d-flex justify-content-between align-items-center">
                              <span> Biscuit jelly beans macaroon danish pudding.</span>
                              <span class="badge bg-warning badge-pill badge-round ml-1">8</span>
                           </li>
                        </ul>
                     </div>
                  </div>
				  
               </div>
            </div>
         </div>
      </section>
   </div>
</div>
<div class="modal fade text-left" id="large" tabindex="-1" role="dialog"
   aria-labelledby="myModalLabel17" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
      role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel17">Add Daily Expanse Here</h4>
            <button type="button" class="close" data-bs-dismiss="modal"
               aria-label="Close">
            <i data-feather="x"></i>
            </button>
         </div>
         <div class="modal-body">
            
                     <div class="card-content">
                        <div class="card-body">
                            <form class="form form-horizontal">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label>Date</label>
                                        </div>
                                        <div class="col-md-10 form-group">
                                            <input type="date" id="expanse_date" class="form-control" name="expanse_date">
                                        </div>
                                        <div class="col-md-2">
                                            <label>Amount</label>
                                        </div>
                                        <div class="col-md-10 form-group">
                                            <input type="text" id="amount" class="form-control" name="amount" placeholder="Amount">
                                        </div>
                                        <div class="col-md-2">
                                            <label>Category</label>
                                        </div>
                                        <div class="col-md-10 form-group">
                                           <select name="category" id="category"  class="form-control">
											<option>--Select Category--</option>
                                           </select>
                                        </div>
										<div class="col-md-2">
                                            <label>Subcategory</label>
                                        </div>
										<div class="col-md-10 form-group">
                                           <select name="subcategory" id="subcategory"  class="form-control">
											<option>--Select Subcategory--</option>
                                           </select>
                                        </div>
										<div class="col-md-2">
                                            <label>Note</label>
                                        </div>
										<div class="col-md-10 form-group">
                                            <textarea name="note" id="note" class="form-control"></textarea>
                                        </div>
										<div class="col-md-2">
                                            <label>Description</label>
                                        </div>
										<div class="col-md-10 form-group">
                                            <textarea name="description" id="description" class="form-control"></textarea>
                                        </div>
                                         
                                          
                                        <div class="col-sm-12 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
                                            <button type="reset" class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-light-secondary"
               data-bs-dismiss="modal">
            <i class="bx bx-x d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Close</span>
            </button>
            <button type="button" class="btn btn-primary ml-1"
               data-bs-dismiss="modal">
            <i class="bx bx-check d-block d-sm-none"></i>
            <span class="d-none d-sm-block">Accept</span>
            </button>
         </div>
      </div>
   </div>
</div>
@endsection