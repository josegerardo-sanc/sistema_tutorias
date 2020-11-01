<div id="layout-sidenav" class="layout-sidenav sidenav sidenav-vertical bg-white logo-dark">
    <!-- Brand demo (see assets/css/demo/demo.css) -->
    <div class="app-brand demo" style="background-color:white;">
        <span class="app-brand-logo demo">
            <img src="{{asset('storage').'/Recursos_sistema/icono_tutoria.png'}}" alt="icon-tutoria" class="img-fluid"
            style="heigth:80px; width:150px">
        </span>
        {{-- <a href="/panelControl" class="app-brand-text demo sidenav-text font-weight-normal ml-2">Tutoría</a> --}}
        <a href="javascript:" class="layout-sidenav-toggle sidenav-link text-large ml-auto" style="color:#1B1B1B">
            <i class="ion ion-md-menu align-middle"></i>
        </a>
    </div>
    <div class="sidenav-divider mt-0"></div>

    <!-- Links -->
    <ul class="sidenav-inner py-1">

        <!-- crud usuario -->
        <li class="sidenav-divider mb-1"></li>
        <li class="sidenav-header small font-weight-semibold">Administrador</li>
        <li class="sidenav-item">
            <a href="{{url('Admin/Usuario')}}" class="sidenav-link">
                <i class="sidenav-icon fas fa-user-cog"></i>
                <div>Usuario</div>
            </a>
        </li>
        <li class="sidenav-item">
            <a href="{{url('Admin/Usuario')}}" class="sidenav-link">
                <i class="sidenav-icon fas fa-user-cog"></i>
                <div>Asignaciónn</div>
            </a>
        </li>

        <!-- Dashboards -->
        {{--
        <li class="sidenav-item open active">
            <a href="javascript:" class="sidenav-link sidenav-toggle">
                <i class="sidenav-icon feather icon-users"></i>
                <div>?????</div>
                <div class="pl-1 ml-auto">
                    <div class="badge badge-danger">Hot</div>
                </div>
            </a>
            <ul class="sidenav-menu">
                <li class="sidenav-item active">
                    <a href="index.html" class="sidenav-link">
                        <i class="sidenav-icon feather icon-user"></i>
                        <div>???</div>
                    </a>
                </li>
            </ul>
        </li>
        --}}

        <li class="sidenav-divider mb-1"></li>
        <li class="sidenav-header small font-weight-semibold">TITULO DEL MODULO</li>
    </ul>
</div>
