@extends('layouts.app')

@section('browserTitle')
{{Auth::user()->name}}
@endsection

@section('title')
Rename Category
@endsection

@section('mainContent')
	<div class="div py-2">
		<a class="btn btn-primary btn-sm" href="/category">Back</a>
	</div>

	<form class="form-horizontal" method="post" action="/category/{{$category->cat_id}}">
		@csrf
        @method('put')
			<fieldset>
			
			<!-- Text input-->
			<div class="form-group">
                <label class="col-md-4 control-label py-2" for="cat_name">Category Name</label>  
                <div class="col-md-4">
                	<input id="cat_name" name="cat_name" type="text" value="{{$category->cat_name}}" class="form-control input-md" required="required">
                </div>
            </div>
		
			<!-- Update Button -->
			<div class="form-group mt-3">
			  <div class="col-4 btn-group">
			    <button id="submit" name="submit" class="btn btn-primary">Update</button>
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