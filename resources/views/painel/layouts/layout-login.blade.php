<!doctype html>
<html lang="pt-br">

<head>
    @include('painel.blocos.header') 
</head>

<body>
    <div class="preloader-wrapper">
        <div class="preloader">
            <img src="{{ asset('assets/preloader/preloader.svg') }}">
        </div>
    </div>
    @yield('pagina')
</body>




    <script src="{{ asset('assets/scripts/base.js') }}"></script>



    @include('painel.blocos.scripts') 

</html>