@extends('layouts.app')

@section('browserTitle')
View Orders
@endsection

@section('title')
View Current Orders
@endsection


@section('mainContent')

    {{-- <div class="row text-center justify-content-center py-2">
        <div class="col-9 h2 my-0">Current Orders</div>
    </div>
    <div class="border-bottom border-danger"></div> --}}

    <!-- if user logins -->
    @if(Auth::user()) 

        <div class="row mx-0 py-2 px-0 fw-semibold border-bottom border-3">
            <div class="col-2 h5   text-center">No</div>
            <div class="col-5 h5  text-start">Status</div>
            <div class="col-5 h5   text-start">Payment</div>
        </div>
        
        <livewire:kitchen-refresh />

    @endif

@endsection