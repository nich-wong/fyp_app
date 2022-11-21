@extends('item/item-layout')

@section('title')
Edit Menu
@endsection

@section('mainContent')
    
    {{-- Category section --}}
    <div class="">
        
        <div class="row justify-content-center mx-0">
            <div class="col btn-group" style="padding:0%">
                <a class="btn btn-warning rounded-0" href="/category">Edit Category</a>
            </div>
        </div>

        <div class="row justify-content-start mx-0">
            @foreach($categories as $cat)
                @if($category->cat_id == $cat->cat_id)
                    <div class="col-4 btn-group" style="padding:0%">
                        <a class="btn btn-primary rounded-0 active" href="/category/{{$cat->cat_id}}">{{ $cat->cat_name }}</a>
                    </div>
                @else
                    <div class="col-4 btn-group" style="padding:0%">
                        <a class="btn btn-primary rounded-0" href="/category/{{$cat->cat_id}}">{{ $cat->cat_name }}</a>
                    </div>
                @endif

            @endforeach
            
        </div>
    </div>


    {{-- Item section --}}
    <div class="pt-1">

        <div class="row justify-content-center mx-0">
            <div class="col btn-group" style="padding:0%">
                <a class="btn btn-success rounded-0" href="/item/create">Add New Item</a>
            </div>
        </div>

        {{-- If there is item with image, show it first --}}
        <div class="row justify-content-start align-items-center mx-0">
            @foreach($items as $item)
            @isset($item->item_image)
            @if(($category->cat_id) === ($item->cat_id)) 
            <div class="col-6 px-0" style="border: 1px solid black">
                <div class="card text-center rounded-0 bg-light">
                    
                    <img src="{{ asset('images/' . $item->item_image) }}" class="card-img-top rounded-0" alt="...">
                    
                    <div class="card-body px-0 py-0">
                        <h5 class="card-title mb-0 pt-1" style="font-size:17px">{{ $item->item_name }}</h5>
                        <p class="card-text pb-1" style="font-size:15px">RM{{ number_format(($item->item_price), 2) }}</p>
                    </div>

                    <a href="/item/{{$item->item_id}}/edit" class="btn btn-warning stretched-link rounded-0">Edit</a>
                
                </div>
            </div>
            @endif
            @endisset
            @endforeach
        </div>

        {{-- if not then show the other items without images --}}
        <div class="row justify-content-start align-items-center mx-0">
            @foreach($items as $item)
            @empty($item->item_image)
            @if(($category->cat_id) === ($item->cat_id)) 
            <div class="col-6 px-0" style="border: 1px solid black">
                <div class="card text-center rounded-0 bg-light">

                    <div class="card-body px-0 py-0">
                        <h5 class="card-title mb-0 pt-1" style="font-size:17px">{{ $item->item_name }}</h5>
                        <p class="card-text pb-1" style="font-size:15px">RM{{ number_format(($item->item_price), 2) }}</p>
                    </div>

                    <a href="/item/{{$item->item_id}}/edit" class="btn btn-warning stretched-link rounded-0">Edit</a>
    
                </div>
            </div>
            @endif
            @endempty
            @endforeach
        </div>
    </div>


    {{-- <a href="/category">Edit Category</a><br>

    @foreach($categories as $cat)
        <a href="/category/{{$cat->cat_id}}">{{ $cat->cat_name }}</a>
        <br>
    @endforeach

    <h3>{{$category->cat_name}}</h3>
    <a href="/item/create">Add New Items</a><br>
    @foreach($items as $item)
        @if(($category->cat_id) === ($item->cat_id)) 
            <a href="/item/{{$item->item_id}}/edit">Edit</a>
            {{ $item->item_name }}
            RM{{ number_format(($item->item_price), 2) }} <br>
        @endif
    @endforeach  --}}


@endsection