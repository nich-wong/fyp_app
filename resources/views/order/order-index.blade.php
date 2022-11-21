<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Restaurant Self Ordering System')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>
<body>

    <div class="container-fluid">

        <div class="row pt-5">
            
            <div class="col text-center" >
                <h2 class="my-0 lead">Welcome To</h2>
                <img src="{{ asset('images/lumiere-logo.jpg') }}" class="img-fluid" alt="" >
            </div>
        </div>

        <div class="row justify-content-center pt-3">
            <h2 class="my-0 lead text-center">Order Here:</h2>
            <div class="col-6 mt-3 btn-group ">
                <a class="btn btn-success btn-lg" href="order/create">+<br>NEW ORDER<br>+</a>
            </div>
        </div>

    </div>

    
    <div class="row text-center pt-3 justify-content-center screen-sm" >
        <p class="small ">Lot G-3/1, Ground Floor, Wisma Manikar, Off Mile 2 1/2 Jalan Tuaran, Likas, 88400<br>Kota Kinabalu, Malaysia</p>
        <p class="small ">Sunday-Friday : 10:00 - 18:00</p>
    </div>


    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
</body>
</html>

    

