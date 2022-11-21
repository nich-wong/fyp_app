@extends('layouts.app')

@section('browserTitle')
{{Auth::user()->name}}
@endsection

@section('title')
Edit Item
@endsection


@section('mainContent')
	<div class="div py-2">
		<a class="btn btn-primary btn-sm" href="{{url()->previous()}}">Back</a>
	</div>

	<form class="form-horizontal" method="post" action="/item/{{$item->item_id}}" enctype="multipart/form-data">
		@csrf
        @method('put')
			<fieldset>

			<!-- Text input-->
			<div class="form-group">
				<label class="col-md-4 control-label py-2" for="name">Item Name</label>  
				<div class="col-md-4 ">
					<input id="name" name="name" type="text" placeholder="Enter Name" class="form-control input-md" value="{{$item->item_name}}" required="required">
				</div>
			</div>

			<!-- Text input-->
			<div class="form-group">
				<label class="col-md-4 control-label py-2" for="price">Item price</label>  
				<div class="col-md-4">
					<input id="price" name="price" type="text" class="form-control input-md" value="{{number_format(($item->item_price), 2)}}" required="required">
				</div>
			</div>

			<!-- Choose category-->
			<div class="form-group">
				<label class="col-md-4 control-label py-2" for="category">Item category</label>  
				<div class="col-md-4">
					<select class="form-select" id="category" name="category">

						<option value="{{$item->cat_id}}">{{$item->categories->cat_name}}</option>

						@foreach($categories as $category)
							@if(($item->cat_id) != ($category->cat_id))
								@if(isset(Auth::user()->id) && Auth::user()->id == $category->rest_id) 
						  			<option value="{{$category->cat_id}}">{{$category->cat_name}}</option>
								@endif
							@endif
						@endforeach

					  </select>
				</div>
			</div>

			<!-- Item Image-->
			@if (($item->item_image) != null)
				<!-- Show Image-->
				<div class="form-group">
					<label class="col-md-4 control-label py-2">Item Image</label>  
					<div class="col-md-4 text-center">
						<img src="{{ asset('images/' . $item->item_image) }}" class="rounded" style="max-height: 50%; max-width: 50%" alt="">
					</div>
				</div>

				<!-- Replace Image-->
				<div class="form-group">
					<label class="col-md-4 control-label py-2" for="image">Replace New Image</label>  
					<div class="col-md-4">
						<input type="file" class="form-control" id="image" name="image">
					</div>
				</div>
				
				<!-- Remove Image-->
				<div class="form-group">
					<label class="col-md-4 control-label py-2">Allow Images</label>
					<div class="col-md-4">
						<input type="radio" class="btn-check" name="delete" id="success-outlined" autocomplete="off" value="0" checked>
						<label class="btn btn-outline-success" for="success-outlined">Yes</label>

						<input type="radio" class="btn-check" name="delete" id="danger-outlined" autocomplete="off" value="1">
						<label class="btn btn-outline-danger" for="danger-outlined">No</label>
					</div>
				</div>	

			@else
				<!-- Upload Image-->
				<div class="form-group">
					<label class="col-md-4 control-label py-2" for="image">Upload Image (Optional)</label>  
					<div class="col-md-4">
						<input type="file" class="form-control" id="image" name="image">
					</div>
				</div>

			@endif
			

			<!-- Update Button -->
				
			<div class="form-group">
				<div class="col-12 mt-3 btn-group">
				  <button class="btn btn-primary">Update Item</button>
				</div>
			</div>
			<div class="row mb-2"></div>
			</fieldset>
		</form>

        <!-- Delete Button -->
        {{-- <form class="form-horizontal" method="post" action="/item/{{$item->item_id}}">
            @csrf
            @method('delete')
            <div class="form-group">
                <div class="col-12 mt-1 mb-4 btn-group">
                  	<button id="submit" name="submit" class="btn btn-danger">Delete Item</button>
                </div>
            </div>
        </form> --}}

		<form method="post" action="/item/{{$item->item_id}}">
			@csrf
			<!-- Button trigger modal -->
			<div class="col-12 mt-1 mb-4 btn-group">
				<button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
					Delete Item
				</button>
			</div>
			
			<!-- Modal -->
			<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">
					<div class="modal-header">
					<h5 class="modal-title" id="staticBackdropLabel">Confirmation</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						Confirm to delete the following item.<br>Item: {{$item->item_name}}
					</div>
					<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

					@method('delete')
					<button id="submit" name="submit" class="btn btn-danger">Confirm Delete</button>
					</div>
				</div>
				</div>
			</div>
			
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