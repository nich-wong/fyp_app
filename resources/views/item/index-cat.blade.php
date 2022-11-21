@extends('layouts.app')

@section('browserTitle')
{{Auth::user()->name}}
@endsection

@section('title')
Edit Category
@endsection

@section('mainContent')
    
    <div class="div py-2">
        <a class="btn btn-primary btn-sm" href="item">Back</a>
    </div>

    @foreach($categories as $category)
    @if(isset(Auth::user()->id) && Auth::user()->id == $category->rest_id)
    <form method="post" action="/category/{{$category->cat_id}}">
        @csrf
        <div class="row align-items-center mx-0 bg-light">
            <!-- Rename Button -->
            <div class="col-3 btn-group px-0">
                <a class="btn btn-warning border" href="category/{{$category->cat_id}}/edit" role="button" style="border-radius: 8px 0 0 8px;">Rename</a>
            </div>

            <!-- Category -->
            <div class="col-6 btn-group px-0">
                <button role="button" class="btn btn-secondary rounded-0 border" disabled>
                    {{ $category->cat_name }}
                </button>
            </div>
            
            <!-- Delete Button -->
            {{-- <div class="col-3 btn-group px-0">
                @method('delete')
                <button id="submit" name="submit" class="btn btn-danger border" style="border-radius: 0 8px 8px 0;">Delete</button>
            </div> --}}

            <!-- Button trigger modal -->
            <div class="col-3 btn-group px-0">
                <button type="button" class="btn btn-danger border" style="border-radius: 0 8px 8px 0;" 
                data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$category->cat_id}}">
                    Delete
                </button>
            </div>
            
            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop{{$category->cat_id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Confirm to delete the following category.<br>Category: {{$category->cat_name}}
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    @method('delete')
                    <button type="submit" class="btn btn-danger">Confirm Delete</button>
                    </div>
                </div>
                </div>
            </div>

        </div>
    </form>
    @endif
    @endforeach

    <div class="row mx-0">
        <div class="col btn-group px-0 pt-3">
            <a class="btn btn-success" href="category/create" role="button">Add Category</a>
        </div>
    </div>
        
    
    

    {{-- @foreach($categories as $category)
        
        <form method="post" action="/category/{{$category->cat_id}}">
            @csrf
            {{ $category->cat_name }}
            <a class="btn btn-primary" href="category/{{$category->cat_id}}/edit" role="button">Rename</a>
            
            <!-- Delete Button -->
            @method('delete')
                <button id="submit" name="submit" class="btn btn-danger">Delete</button>
        </form>

        <br>
    @endforeach --}}



@endsection