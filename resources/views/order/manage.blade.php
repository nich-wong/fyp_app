@extends('layouts.app')

@section('browserTitle')
Current Orders
@endsection

@section('title')
Manage Current Orders
@endsection


@section('mainContent')

    {{-- <div class="row text-center justify-content-center py-2">
        <div class="col-9 h2 my-0">Current Orders</div>
    </div>
    <div class="border-bottom border-danger"></div> --}}

    <!-- if user logins -->
    @if(Auth::user()) 
        
        <livewire:refresh-orders />

    @endif

@endsection