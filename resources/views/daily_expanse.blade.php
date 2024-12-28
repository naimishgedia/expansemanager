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
					@if (session('success'))
						<div class="alert alert-success">{{ session('success') }}</div>
					@endif

					@if (session('error'))
						<div class="alert alert-danger">{{ session('error') }}</div>
					@endif
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
                            <form class="form form-horizontal" method="post" action="{{ route('insert.dailyexpanse') }}">
									@csrf
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
                                           <select name="category_id" id="category_id" onchange="GetSubcategory()"  class="form-control">
											<option>--Select Category--</option>
											@foreach($ExpanseCategory as $newExpanseCategory)
											<option value="{{$newExpanseCategory->id}}">{{$newExpanseCategory->category_name}}</option>
											@endforeach
                                           </select>
                                        </div>
										<div class="col-md-2">
                                            <label>Subcategory</label>
                                        </div>
										<div class="col-md-10 form-group">
                                           <select name="subcategory_id" id="subcategory_id"  class="form-control">
											<option selected value="">--Select Subcategory--</option>
											<option>Select category first</option>
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
         
      </div>
   </div>
</div>
<script>
var token = $("meta[name='_token']").attr('content');
var Get_Subcategory = "{{ route('getsubcategory') }}";
function GetSubcategory(){
	var category_id=$("#category_id").val()
	$.ajaxSetup({
					  headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					  }
				   });
		$.ajax({
				url:Get_Subcategory,
				method:"POST",
				data:{
					_token:token,
					category_id:category_id
				},
				success:function(res){
					$('#subcategory_id').empty('');
					$('#subcategory_id').append(res);
				}
		})
}  
</script>
@endsection