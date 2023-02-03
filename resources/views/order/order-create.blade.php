@extends('item/item-layout')
{{-- @extends('layouts.app') --}}

<?php
    $url_reverse = strrev(url()->current());
    $rest_id = $url_reverse[7];
    $bTitle = "Not Selected";
    foreach($users as $user){
        if($user->id == $rest_id){
            $bTitle = $user->name;
        }
    }
?>

@section('browserTitle')
{{$bTitle}}
@endsection

@section('title')
Menu
@endsection


@section('mainContent')

    {{-- category tab --}}
    <div class="row mx-0">
        <ul class="nav nav-pills nav-fill mb-3 px-0" id="pills-tab" role="tablist">
            <?php $index_cat = 0; ?>
            @foreach($categories as $category)
            {{-- @if(isset(Auth::user()->id) && Auth::user()->id == $category->rest_id)  --}}
            @if($category->rest_id == $rest_id)
                @if($index_cat == 0)
                <div class="col-4 border">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-0 px-0 active" data-bs-toggle="pill" type="button" role="tab" 
                        data-bs-target="#c{{$category->cat_id}}" aria-controls="c{{$category->cat_id}}" aria-selected="true">
                            {{$category->cat_name}}
                        </button>
                    </li>
                </div>
                @else
                <div class="col-4 border">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-0 px-0" data-bs-toggle="pill" type="button" role="tab" 
                        data-bs-target="#c{{$category->cat_id}}" aria-controls="c{{$category->cat_id}}" aria-selected="false">
                            {{$category->cat_name}}
                        </button>
                    </li>
                </div>
                
                @endif

                <?php $index_cat++; ?>
            @endif
            @endforeach
        </ul>
    </div>
    
    <form method="post" action="/order">
        @csrf

        {{-- Add to order button --}}
        <div class="form-group">
            <div class="row justify-content-center fixed-bottom mb-3">
                <div class="col-8 btn-group">
                    <button class="btn btn-success btn-lg">Add to Order</button>
                </div>
            </div>
        </div>

        <!-- tab contents -->
        <div class="tab-content class-1" id="pills-tabContent">
            <?php $index_item = 0; ?>
            @foreach($categories as $cat)
            {{-- @if(isset(Auth::user()->id) && Auth::user()->id == $cat->rest_id) --}}
            @if($cat->rest_id == $rest_id)
                <!-- first tab content -->
                @if($index_item == 0)
                    
                    <div class="tab-pane fade show active class1" id="c{{$cat->cat_id}}" role="tabpanel">
                        <!-- show item that has image first -->
                        <div class="row justify-content-start align-items-center mx-0">
                            @foreach($items as $item)
                            @isset($item->item_image)
                            @if($item->cat_id == $cat->cat_id && $item->avail != "false")
                            <div class="col-6 px-0 " style="border: 1px solid black">
                                <div class="card text-center rounded-0 bg-light ">
                                    
                                    <img src="{{ asset('images/' . $item->item_image) }}" class="card-img-top rounded-0" alt="...">
                                    
                                    <div class="card-body px-0 py-0">
                                        <h5 class="card-title mb-0 pt-1" style="font-size:17px">{{ $item->item_name }}</h5>
                                        <p class="card-text pb-1" style="font-size:15px">RM{{ number_format(($item->item_price), 2) }}</p>
                                    </div>
                                    
                                    <div class="form-group">
                                        <livewire:order-create :item="$item" />
                                    </div>

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
                            @if($item->cat_id == $cat->cat_id  && $item->avail != "false")
                            <div class="col-6 px-0" style="border: 1px solid black">
                                <div class="card text-center rounded-0 bg-light">
                
                                    <div class="card-body px-0 py-0">
                                        <h5 class="card-title mb-0 pt-1" style="font-size:17px">{{ $item->item_name }}</h5>
                                        <p class="card-text pb-1" style="font-size:15px">RM{{ number_format(($item->item_price), 2) }}</p>
                                    </div>
            
                                    <div class="form-group">
                                        <livewire:order-create :item="$item" />
                                    </div>
                    
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
                            @if($item->cat_id == $cat->cat_id  && $item->avail != "false")
                            <div class="col-6 px-0" style="border: 1px solid black">
                                <div class="card text-center rounded-0 bg-light">
                                    
                                    <img src="{{ asset('images/' . $item->item_image) }}" class="card-img-top rounded-0" alt="...">
                                    
                                    <div class="card-body px-0 py-0">
                                        <h5 class="card-title mb-0 pt-1" style="font-size:17px">{{ $item->item_name }}</h5>
                                        <p class="card-text pb-1" style="font-size:15px">RM{{ number_format(($item->item_price), 2) }}</p>
                                    </div>

                                    <div class="form-group">
                                        <livewire:order-create :item="$item" />
                                    </div>
            
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
                            @if($item->cat_id == $cat->cat_id  && $item->avail != "false")
                            <div class="col-6 px-0" style="border: 1px solid black">
                                <div class="card text-center rounded-0 bg-light">
                
                                    <div class="card-body px-0 py-0">
                                        <h5 class="card-title mb-0 pt-1" style="font-size:17px">{{ $item->item_name }}</h5>
                                        <p class="card-text pb-1" style="font-size:15px">RM{{ number_format(($item->item_price), 2) }}</p>
                                    </div>

                                    <div class="form-group">
                                        <livewire:order-create :item="$item" />
                                    </div>
                    
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

    </form>

    <footer>
        <div class="container py-4"></div>
    </footer>

    <?php $item_count_total = 0; ?>
    <livewire:alert-count :item_count_total="$item_count_total"/>
    
    
    {{-- <form method="post" action="/order">
        @csrf

        <div class="form-group">
                <div class="col-12 mt-3 btn-group">
                    <button class="btn btn-success">Add to Order</button>
                </div>
        </div>

        <div class="row justify-content-start align-items-center mx-0 ">
        
            @foreach($items as $item)
            <div class="col-6 px-0 " style="border: 1px solid black">
                <div class="card text-center rounded-0 bg-light">

                    <div class="card-body px-0 py-0">
                        <h5 class="card-title mb-0 pt-1" style="font-size:17px">{{ $item->item_name }}</h5>
                        <p class="card-text pb-1" style="font-size:15px">RM{{ number_format(($item->item_price), 2) }}</p>
                    </div>

                    <div class="form-group">
                        <livewire:order-create :item="$item" />
                    </div>
                    
                </div>
            </div>
            @endforeach

        </div>

    </form> --}}

@endsection