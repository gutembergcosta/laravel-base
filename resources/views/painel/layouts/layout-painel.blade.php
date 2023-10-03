<!doctype html>
<html lang="pt-br">

<head>
    @include('painel.blocos.header') 
</head>

<body>

    <div id="wrapper">
        
        @php
            $tela = (isMobile())? 'mobile' : 'desktop';
        @endphp
        @include("painel.blocos.topo-$tela") 

        @include('painel/blocos/sidebar')
        
       
        <div class="main">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <div class="container-fluid">
                    @yield('pagina')
                </div>
            </div>
            <!-- END MAIN CONTENT -->
        </div>
        @include('painel/blocos/footer')
        <div class="clearfix"></div>

        <script src="{{ asset('assets/vendor/chartist/js/chartist.js') }}"></script>
        <script src="{{ asset('assets/scripts/data-chartist.js') }}"></script>
        <script src="{{ asset('assets/scripts/base.js') }}"></script>

        @include('painel.blocos.scripts') 

        
        
    </div>
</body>





</html>