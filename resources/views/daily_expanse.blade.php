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
						@if (session('success'))
							<div class="alert alert-success"><b>{{ session('success') }}</b></div>
						@endif

						@if (session('error'))
							<div class="alert alert-danger"><b>{{ session('error') }}</b></div>
						@endif
						
						@foreach($monthlyExpanse as $date => $records)
							@php 
								$DatewiseTotal = 0; // Initialize total for the date
								$categoryWiseData = [];
							@endphp

							<ul class="list-group">
								@foreach($records as $record)
									@php
										$DatewiseTotal += $record->amount; // Sum up amounts for the date
										$categoryName = $record->category->category_name ?? 'Unknown';
										$subcategoryName = $record->subcategory->subcategory_name ?? 'Unknown';

										if (!isset($categoryWiseData[$categoryName])) {
											$categoryWiseData[$categoryName] = [
												'total' => 0,
												'subcategories' => []
											];
										}

										$categoryWiseData[$categoryName]['total'] += $record->amount;
										$categoryWiseData[$categoryName]['subcategories'][] = [
											'subcategory' => $subcategoryName,
											'amount' => $record->amount
										];
									@endphp
								@endforeach

								<li class="list-group-item active">
									<h4 style="color:white;">{{ $date }} - Total: {{ $DatewiseTotal }}</h4>
								</li>

								@foreach($categoryWiseData as $categoryName => $categoryData)
									<li class="list-group-item d-flex justify-content-between align-items-center bg-light">
										<strong>{{ $categoryName }}</strong>
										<span class="badge bg-primary badge-pill badge-round ml-1">Total: {{ $categoryData['total'] }}</span>
									</li>
									
									@foreach($categoryData['subcategories'] as $subcategory)
										<li class="list-group-item d-flex justify-content-between align-items-center">
											<span>{{ $subcategory['subcategory'] }}</span>
											<span class="badge bg-warning badge-pill badge-round ml-1">{{ $subcategory['amount'] }}</span>
										</li>
									@endforeach
								@endforeach
							</ul>
							<br> 
						@endforeach    
 
  
                        
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
                            <form id="dailyExpanseForm" class="form form-horizontal" action="{{ route('insert.dailyexpanse') }}" method="POST">
								@csrf
								<div class="form-body">
									<div class="row">
										<div class="col-md-2">
											<label>Date</label>
										</div>
										<div class="col-md-10 form-group">
											<input type="date" id="expanse_date" class="form-control" name="expanse_date">
											<span id="error_expanse_date" class="text-danger"></span>
										</div>
										<div class="col-md-2">
											<label>Amount</label>
										</div>
										<div class="col-md-10 form-group">
											<input type="text" id="amount" class="form-control" name="amount" placeholder="Amount">
											<span id="error_amount" class="text-danger"></span>
										</div>
										<div class="col-md-2">
											<label>Category</label>
										</div>
										<div class="col-md-10 form-group">
											<select onchange="GetSubcategory()" name="category_id" id="category_id" class="form-control">
												<option value="">--Select Category--</option>
												@foreach($ExpanseCategory as $newExpanseCategory)
												<option value="{{$newExpanseCategory->id}}">{{$newExpanseCategory->category_name}}</option>
												@endforeach
											</select>
											<span id="error_category_id" class="text-danger"></span>
										</div>
										<div class="col-md-2">
											<label>Subcategory</label>
										</div>
										<div class="col-md-10 form-group">
											<select name="subcategory_id" id="subcategory_id" class="form-control">
												<option value="">--Select Subcategory--</option>
											</select>
											<span id="error_subcategory_id" class="text-danger"></span>
										</div>
										<div class="col-md-2">
											<label>Note</label>
										</div>
										<div class="col-md-10 form-group">
											<textarea name="note" id="note" class="form-control"></textarea>
											<span id="error_note" class="text-danger"></span>
										</div>
										<div class="col-md-2">
											<label>Description</label>
										</div>
										<div class="col-md-10 form-group">
											<textarea name="description" id="description" class="form-control"></textarea>
											<span id="error_description" class="text-danger"></span>
										</div>
										<div class="col-sm-12 d-flex justify-content-end">
											<button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>
											<button type="reset" class="btn btn-light-secondary me-1 mb-1">Cancle</button>
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

document.getElementById("dailyExpanseForm").addEventListener("submit", function (event) {
    // Prevent form submission
    event.preventDefault();

    // Clear previous error messages
    document.querySelectorAll(".text-danger").forEach((error) => (error.textContent = ""));

    // Get form fields
    const expanseDate = document.getElementById("expanse_date").value.trim();
    const amount = document.getElementById("amount").value.trim();
    const category = document.getElementById("category_id").value;
    const subcategory = document.getElementById("subcategory_id").value;
    
    // Error flag
    let isValid = true;

    // Validate fields and show errors
    if (!expanseDate) {
        document.getElementById("error_expanse_date").textContent = "Please select a date.";
        isValid = false;
    }
    if (!amount || isNaN(amount) || amount <= 0) {
        document.getElementById("error_amount").textContent = "Please enter a valid amount.";
        isValid = false;
    }
    if (!category) {
        document.getElementById("error_category_id").textContent = "Please select a category.";
        isValid = false;
    }
    if (!subcategory) {
        document.getElementById("error_subcategory_id").textContent = "Please select a subcategory.";
        isValid = false;
    }
   
	// Submit the form if valid
    if (isValid) {
        this.submit();
    }
});


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