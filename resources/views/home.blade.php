@extends('layouts.app2')

@section('browserTitle')
{{Auth::user()->name}}
@endsection

@section('mainContent')
{{-- <div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div> --}}

    <div class="container py-4">
        
        <div class="row justify-content-center">
                        
            <div class="col-10 border border-primary text-center">
                <div class="col-12 px-0 py-2 btn-group ">
                    <a class="btn btn-primary" href="/item">Edit Menu Items</a>
                </div>
                <p>Add new items and categories, or remove and make changes to existing ones.</p>
                
            </div>

            <div class="col-10 border border-primary text-center mt-4">
                <div class="col-12 px-0 py-2 btn-group ">
                    <a class="btn btn-primary" href="/manage">Manage Orders</a>
                </div>
                <p>Allow staff members to manage the list of current orders.</p>
                
            </div>

            <div class="col-10 border border-primary text-center mt-4">
                <div class="col-12 px-0 py-2 btn-group ">
                    <a class="btn btn-primary" href="/manage/create">Kitchen View</a>
                </div>
                <p>Allow staff members in the kitchen to view the list of current orders and their status.</p>
                
            </div>

            {{-- <div class="col-10 border border-primary text-center mt-4">
                <div class="col-12 px-0 py-2 btn-group ">
                    <a class="btn btn-primary" href="/order/create">Show QR Code</a>
                </div>
                <p>Shows the QR Code for customers to view the menu and place orders.</p>
            </div> --}}

            <div class="col-10 border border-primary text-center mt-4">
                <!-- Button trigger modal -->
                <div class="col-12 px-0 py-2 btn-group ">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Show QR Code
                    </button>
                </div>

                {{-- <h3 class="mt-2">Menu QR Code</h3> --}}
                <p>Show the QR Code to customers to view the menu and place orders.</p>

                <?php 
                    
                    $rest_id = (Auth::user()->id);
                    $url_start = url("/order"); 
                    $url_full = $url_start . "/" . $rest_id . "/create";
                ?>
                
                {{--                 
                    <a href="/order/{{$rest_id}}/create">
                    <img src="https://quickchart.io/qr?text={{$url_full}}&size=200" class="" alt="QR Code">
                    </a>

                    <div class="mb-2"></div> --}}
                
                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">QR Code Menu</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            {{-- <a href="/order/{{$rest_id}}/create"> --}}
                                <img src="https://quickchart.io/qr?text={{$url_full}}&size=200" class="" alt="QR Code">
                            {{-- </a> --}}
                        </div>
                        <div class="modal-footer justify-content-center">
                            <a class="btn btn-primary" href="/order/{{$rest_id}}/create">Preview Menu</a>
                        </div>
                        
                    </div>
                    </div>
                    
                </div>

            </div>

            <div class="col-10 border border-primary text-center mt-4">
                <div class="col-12 px-0 py-2 btn-group ">
                    <a class="btn btn-primary" href="/sales">Sales Report</a>
                </div>
                <p>Show the report of the total sales made.</p>
                
            </div>

        </div>

    </div>


@endsection
