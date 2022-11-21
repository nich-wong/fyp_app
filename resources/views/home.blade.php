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
                <p>Allow admins to add new items and categories, or remove and make changes to existing ones.</p>
                
            </div>

            <div class="col-10 border border-primary text-center mt-4">
                <div class="col-12 px-0 py-2 btn-group ">
                    <a class="btn btn-primary" href="/manage">Current Orders</a>
                </div>
                <p>Allow staff members to view and manage the list of current orders.</p>
                
            </div>

            {{-- <div class="col-10 border border-primary text-center mt-4">
                <div class="col-12 px-0 py-2 btn-group ">
                    <a class="btn btn-primary" href="/order/create">Show QR Code</a>
                </div>
                <p>Shows the QR Code for customers to view the menu and place orders.</p>
            </div> --}}

            <div class="col-10 border border-primary text-center mt-4">
                <h3 class="mt-2">Menu QR Code</h3>
                <p class="mb-0">The QR Code for customers to view the menu and place orders.</p>

                <?php 
                    
                    $rest_id = (Auth::user()->id);
                    $url_start = url("/order"); 
                    $url_full = $url_start . "/" . $rest_id . "/create";
                ?>
                
                <a href="/order/{{$rest_id}}/create">
                <img src="https://quickchart.io/qr?text={{$url_full}}&size=200" class="" alt="QR Code">
                </a>

                <div class="mb-2"><div>
            </div>

        </div>

    </div>


@endsection
