<div id="sidebar-nav" class="sidebar">
    <div class="sidebar-scroll">

        <nav>
            <ul class="nav">
                <li><a href="{{ route('painel.home') }}" class="active"><i class="fas fa-cog"></i><span>Início</span> </a></li>
        
                @if ( auth()->user()->tipo == 'admin')
                    @include('painel/blocos/navbar/navbar-admin')
                @endif  

                <li><a href="#subPages0" data-toggle="collapse" class="collapsed"><i class="fas fa-cog"></i><span>Informações</span> <i class="icon-submenu fas fa-chevron-right"></i></a>
                    <div id="subPages0" class="submenu collapse ">
                        <ul class="nav">
                            <li><a href="{{route('painel.perfil')}}" class="">Perfil</a></li>
                        </ul>
                    </div>
                </li>
                
            </ul>
        </nav>
    </div>
</div>