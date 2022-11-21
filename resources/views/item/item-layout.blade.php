<!DOCTYPE html>
<html>
<head>
    <title>@yield('browserTitle', 'Self-Ordering System')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    @livewireStyles
</head>
<body>
    {{-- <div class="container-fluid border">
        <h2 class="text-center" style="margin-top: 5px;">Lumiere Coffee Space</h2>
        <h4 class="text-center" style="margin-top: 5px;">@yield('title')</h4>
    </div> --}}

    <div class="container-fluid border bg-white shadow-sm">
        <div class="row mx-0 py-2 ">
            <div class="col-8 fs-5 px-0 ">
                @yield('browserTitle')
            </div>
            <div class="col-4 lead text-end px-0">
                @yield('title')
            </div>
        </div>
    </div>

    <div class="container-fluid">
        @yield('mainContent')
    </div>

    <footer>
        <div class="container py-3"></div>
    </footer>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    @livewireScripts
    
    {{-- <script src="{{ asset('js/custom.js') }}"></script> --}}
</body>
</html>