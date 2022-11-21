@extends('layouts.app')

@section('browserTitle')
{{Auth::user()->name}}
@endsection

@section('title')
Add New Items
@endsection

@section('mainContent')
	<div class="div py-2">
		<a class="btn btn-primary btn-sm" href="{{url()->previous()}}">Back</a>
	</div>

	<form class="form-horizontal" method="post" action="/item" enctype="multipart/form-data">
		@csrf
			<fieldset>

			<!-- Text input-->
			<div class="form-group">
			  <label class="col-md-4 control-label py-2" for="name">Item Name</label>  
			  <div class="col-md-4">
			  <input id="name" name="name" type="text" placeholder="Enter Name" class="form-control input-md" required="required">
			  </div>
			</div>

			<!-- Text input-->
			<div class="form-group">
			  <label class="col-md-4 control-label py-2" for="price">Item price</label>  
			  <div class="col-md-4">
			  <input id="price" name="price" type="text" placeholder="0.00" class="form-control input-md" required="required">
			    
			  </div>
			</div>

			
			<!-- Upload Image-->
			<div class="form-group">
				<label class="col-md-4 control-label py-2" for="image">Upload Image (Optional)</label>  
				<div class="col-md-4">
					<input type="file" class="form-control" id="image" name="image">
				</div>
			</div>


			<!-- Choose category-->
			<div class="form-group">
				<label class="col-md-4 control-label py-2" for="category">Set Category</label>  
				<div class="col-md-4">
					<select class="form-select" id="category" name="category">
						{{-- <option value="">-</option> --}}

						@foreach($categories as $category)
						@if(isset(Auth::user()->id) && Auth::user()->id == $category->rest_id) 
						  <option value="{{$category->cat_id}}">{{$category->cat_name}}</option>
						@endif
						@endforeach

					  </select>
				</div>
			</div>


			<!-- Save Button -->
			<div class="form-group">
				<div class="col-12 mt-3 btn-group">
					<button class="btn btn-success">Save</button>
				</div>
			</div>

			</fieldset>
		</form>

		@if ($errors->any())
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif


@endsection