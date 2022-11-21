{{-- @extends('item/item-layout') --}}
@extends('layouts.app')

@section('browserTitle')
{{Auth::user()->name}}
@endsection

@section('title')
Edit Menu
@endsection


@section('mainContent')
    
    {{-- <!-- Category Section-->
    <div>
        
        <div class="row justify-content-center mx-0">
            <div class="col btn-group" style="padding:0%">
                <a class="btn btn-warning rounded-0" href="category">Edit Category</a>
            </div>
        </div>

        <div class="row justify-content-start mx-0">
            @foreach($categories as $category)
            @if(isset(Auth::user()->id) && Auth::user()->id == $category->rest_id) 
                @if($loop->first)
                    <div class="col-4 btn-group" style="padding:0%">
                        <a class="btn btn-primary rounded-0 active" href="category/{{$category->cat_id}}">{{ $category->cat_name }}</a>
                    </div>
                @else
                    <div class="col-4 btn-group" style="padding:0%">
                        <a class="btn btn-primary rounded-0" href="category/{{$category->cat_id}}">{{ $category->cat_name }}</a>
                    </div>
                @endif
            @endif
            @endforeach
            
        </div>

    </div>

    
    <!-- Item section -->
    <div class="pt-1">

        <div class="row justify-content-center mx-0">
            <div class="col btn-group" style="padding:0%">
                <a class="btn btn-success rounded-0" href="item/create">Add New Item</a>
            </div>
        </div>

        <div class="row justify-content-start align-items-center mx-0">
            @foreach($items as $item)
            @if($item->cat_id == 1)
            <div class="col-6 px-0" style="border: 1px solid black">
                <div class="card text-center rounded-0 bg-light">
                    @isset($item->item_image)
                        <img src="{{ asset('images/' . $item->item_image) }}" class="card-img-top rounded-0" alt="...">
                    @endisset

                    <div class="card-body px-0 py-0">
                        <h5 class="card-title mb-0 pt-1" style="font-size:17px">{{ $item->item_name }}</h5>
                        <p class="card-text pb-1" style="font-size:15px">RM{{ number_format(($item->item_price), 2) }}</p>
                    </div>

                    <a href="item/{{$item->item_id}}/edit" class="btn btn-warning stretched-link rounded-0">Edit</a>
                
                </div>
            </div>
            @endif
            @endforeach

        </div>
    </div> --}}
    
    <!-- Edit Category Button -->
    <div class="row justify-content-center mx-0">
        <div class="col btn-group" style="padding:0%">
            <a class="btn btn-warning rounded-0" href="category">Edit Category</a>
        </div>
    </div>

    <!-- Category section -->
    <div class="row mx-0">
        <ul class="nav nav-pills nav-fill mb-3 px-0" id="pills-tab" role="tablist">
            <?php $index_cat = 0; 
                $cat_not_empty = 0;
            ?>
            @foreach($categories as $category)
            @if(isset(Auth::user()->id) && Auth::user()->id == $category->rest_id) 
                @if($index_cat == 0)
                    <div class="col-4 border">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-0 px-0 active" data-bs-toggle="pill" type="button" role="tab" 
                            data-bs-target="#c{{$category->cat_id}}" aria-controls="c{{$category->cat_id}}" aria-selected="true">
                                {{$category->cat_name}}
                            </button>
                        </li>
                    </div>

                    <?php $index_cat++; ?>
                @else
                    <div class="col-4 border">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-0 px-0" data-bs-toggle="pill" type="button" role="tab" 
                            data-bs-target="#c{{$category->cat_id}}" aria-controls="c{{$category->cat_id}}" aria-selected="false">
                                {{$category->cat_name}}
                            </button>
                        </li>
                    </div>
                    <?php $index_cat++; ?>
                @endif
                <?php $cat_not_empty = 1; ?>
            @endif
            @endforeach
        </ul>
    </div>

    <!-- Add Item Button -->
    @if($cat_not_empty == 1)
    <div class="row justify-content-center mx-0">
        <div class="col btn-group" style="padding:0%">
            <a class="btn btn-success rounded-0" href="item/create">Add New Item</a>
        </div>
    </div>
    @endif

    <!-- Item Section -->
    <div class="tab-content class-1" id="pills-tabContent">
        <?php  $index_item = 0; ?>
        @foreach($categories as $cat)
        @if(isset(Auth::user()->id) && Auth::user()->id == $cat->rest_id)

            <!-- first tab content -->
            @if($index_item == 0)
                
                <div class="tab-pane fade show active class1" id="c{{$cat->cat_id}}" role="tabpanel">
                    <!-- show item that has image first -->
                    <div class="row justify-content-start align-items-center mx-0">
                        @foreach($items as $item)
                        @isset($item->item_image)
                        @if($item->cat_id == $cat->cat_id)
                        <div class="col-6 px-0 " style="border: 1px solid black">
                            <div class="card text-center rounded-0 bg-light ">
                                
                                <img src="{{ asset('images/' . $item->item_image) }}" class="card-img-top rounded-0" alt="...">
                                
                                <div class="card-body px-0 py-0">
                                    <h5 class="card-title mb-0 pt-1" style="font-size:17px">{{ $item->item_name }}</h5>
                                    <p class="card-text pb-1" style="font-size:15px">RM{{ number_format(($item->item_price), 2) }}</p>
                                </div>
                                
                                <a href="item/{{$item->item_id}}/edit" class="btn btn-warning stretched-link rounded-0">Edit</a>

                            </div>
                        </div>
        
                        @endif
                        @endisset
                        @endforeach
        
                    </div>
                    <!-- then show item without image -->
                    <div class="row justify-content-start align-items-center mx-0">
                        @foreach($items as $item)
                        @empty($item->item_image)
                        @if($item->cat_id == $cat->cat_id)
                        <div class="col-6 px-0" style="border: 1px solid black">
                            <div class="card text-center rounded-0 bg-light">
            
                                <div class="card-body px-0 py-0">
                                    <h5 class="card-title mb-0 pt-1" style="font-size:17px">{{ $item->item_name }}</h5>
                                    <p class="card-text pb-1" style="font-size:15px">RM{{ number_format(($item->item_price), 2) }}</p>
                                </div>
        
                                <a href="item/{{$item->item_id}}/edit" class="btn btn-warning stretched-link rounded-0">Edit</a>
                
                            </div>
                        </div>
                        @endif
                        @endempty
                        @endforeach
                    </div>
        
        
                </div>
            
            <!-- following tab content -->
            @else 
                
                <div class="tab-pane fade" id="c{{$cat->cat_id}}" role="tabpanel">
                    <!-- show item that has image first -->
                    <div class="row justify-content-start align-items-center mx-0">
                        @foreach($items as $item)
                        @isset($item->item_image)
                        @if($item->cat_id == $cat->cat_id)
                        <div class="col-6 px-0" style="border: 1px solid black">
                            <div class="card text-center rounded-0 bg-light">
                                
                                <img src="{{ asset('images/' . $item->item_image) }}" class="card-img-top rounded-0" alt="...">
                                
                                <div class="card-body px-0 py-0">
                                    <h5 class="card-title mb-0 pt-1" style="font-size:17px">{{ $item->item_name }}</h5>
                                    <p class="card-text pb-1" style="font-size:15px">RM{{ number_format(($item->item_price), 2) }}</p>
                                </div>

                                <a href="item/{{$item->item_id}}/edit" class="btn btn-warning stretched-link rounded-0">Edit</a>
        
                            </div>
                        </div>
                        @endif
                        @endisset
                        @endforeach
                    </div>
                    <!-- then show item without image -->
                    <div class="row justify-content-start align-items-center mx-0">
                        @foreach($items as $item)
                        @empty($item->item_image)
                        @if($item->cat_id == $cat->cat_id)
                        <div class="col-6 px-0" style="border: 1px solid black">
                            <div class="card text-center rounded-0 bg-light">
            
                                <div class="card-body px-0 py-0">
                                    <h5 class="card-title mb-0 pt-1" style="font-size:17px">{{ $item->item_name }}</h5>
                                    <p class="card-text pb-1" style="font-size:15px">RM{{ number_format(($item->item_price), 2) }}</p>
                                </div>

                                <a href="item/{{$item->item_id}}/edit" class="btn btn-warning stretched-link rounded-0">Edit</a>
                
                            </div>
                        </div>
                        @endif
                        @endempty
                        @endforeach
                    </div>
        
                </div>
            
            @endif

            <?php  $index_item++; ?>

        @endif
        @endforeach

    </div>

    <!-- Item section -->
    {{-- <div class="tab-content" id="pills-tabContent">
        <!-- $index_item = 0; -->
        @foreach($categories as $cat)
        @if(isset(Auth::user()->id) && Auth::user()->id == $cat->rest_id)
        
            <!-- first tab content -->
            @if($index_item == 0)
                
                <div class="tab-pane fade show active" id="c{{$cat->cat_id}}" role="tabpanel">

                    <div class="p text-center">{{$cat->cat_name}} <br>
                        loop parent index:{{$loop->index}} <br>index cat: {{$index_item}}
                    </div>

                </div>
                
            
            <!-- following tab content  -->
            @else 
                
                <div class="tab-pane fade" id="c{{$cat->cat_id}}" role="tabpanel">
                    
                    <div class="p text-center">{{$cat->cat_name}} <br>
                        loop parent index:{{$loop->index}} <br>index cat: {{$index_item}}
                    </div>

                </div>

            @endif

            <!--  $index_item++; -->

        @endif
        @endforeach

    </div> --}}

@endsection