<style>
    #wrapper .main{
        padding: 0;
        margin-top: 60px;
    }
    .main-content{
        padding: 20px 10px;
    }
    .navbar-mobile{
        height: 60px;
    }

    .navbar-mobile .brand{
        display: block;
        padding: 10px;
    }

    .navbar-btn{
        margin-left: 15px;
    }
    
    .navbar-btn, .navbar-nav > li > a {
        padding: 0;
    }

    .area-link{
        position: absolute;
        right: 15px;
    }

    .sidebar{
        padding-top: 0!important;
        margin-top: 60px;
    }
</style>

<nav class="navbar navbar-default navbar-fixed-top navbar-mobile d-flex align-items-center ">

    <div>
        <div class="navbar-btn">
            <button type="button" class="btn-toggle-fullwidth">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        <div class="brand" style="">
            <a href="{{route('painel.home')}}"><img src="{{ asset('assets/img/logo-dark.png') }}" width="100"
                    alt="Klorofil Logo" class="img-responsive logo"></a>
        </div>
    </div>

    <style>
        .dropdow-user-mobile{
            position: absolute;
            left: -94px;
        }

    </style>
    

    <div class="area-link">
        <ul class="nav navbar-nav navbar-right ">
            <li class="dropdown dropdow-user-mobile">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img
                        src="{{ asset('assets/img/user.png') }}" class="img-circle" alt="Avatar">
                    <span> Administrador </span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('painel.perfil')}}"><i class="lnr lnr-user"></i>
                            <span>Meu perfil</span></a></li>
                    <li><a href="{{ route('sair')}}" onclick="return confirm('Deseja sair do sistema?')"><i class="lnr lnr-exit"></i>
                            <span>Sair</span></a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>