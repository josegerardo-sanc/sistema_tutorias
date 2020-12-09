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
        @role('Administrador')
        <li class="sidenav-divider mb-1"></li>
        <li class="sidenav-header small font-weight-semibold">Administrador</li>
        <li class="sidenav-item">
            <a href="javascript:" class="sidenav-link sidenav-toggle">
                <i class="sidenav-icon fas fa-user-check"></i>
                <div>Usuario</div>
                {{-- <div class="pl-1 ml-auto">
                    <div class="badge badge-danger">Hot</div>
                </div> --}}
            </a>
            <ul class="sidenav-menu">
                <li class="sidenav-item">
                    <a href="{{url('/Admin/user')}}" class="sidenav-link">
                        <i class="sidenav-icon fas fa-users"></i>
                        <div>Ver Usuarios</div>
                    </a>
                </li>
                <li class="sidenav-item">
                    <a href="{{url('/Admin/user/create')}}" class="sidenav-link">
                        <i class="sidenav-icon fas fa-user-plus"></i>
                        <div>Nuevo Usuario</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="sidenav-item">
            <a href="javascript:" class="sidenav-link sidenav-toggle">
                <i class="sidenav-icon fas fa-tags"></i>
                <div>Asignaciones</div>
                {{-- <div class="pl-1 ml-auto">
                    <div class="badge badge-danger">Hot</div>
                </div> --}}
            </a>
            <ul class="sidenav-menu">
                <li class="sidenav-item">
                    <a href="{{url('/Admin/Asignacion/create')}}" class="sidenav-link">
                         <i class="sidenav-icon fas fa-hands-helping"></i>
                        <div>Asignación grupal</div>
                    </a>
                </li>
                <li class="sidenav-item">
                    <a href="{{url('/Admin/AsignacionIndividual/create')}}" class="sidenav-link">
                        <i class="sidenav-icon fas fa-male"></i>
                        <div>Asignación Individual</div>
                    </a>
                </li>
            </ul>
        </li>
        <li class="sidenav-item">
            <a href="{{url('/Admin/carreras/create')}}" class="sidenav-link">
                <i class="sidenav-icon fas fa-list-ol"></i>
                <div>Carreras</div>
            </a>
        </li>
        @endrole
        {{-- otro modulo --}}

        @hasanyrole('Administrador||Tutor')
            @role('Tutor')
            <li class="sidenav-item">
                <a href="{{url('/tutor')}}" class="sidenav-link">
                    <i class="sidenav-icon fas fa-list-ol"></i>
                    <div>Mis Alumnos</div>
                </a>
            </li>
            @endrole

            <li class="sidenav-item">
            <a href="javascript:" class="sidenav-link sidenav-toggle">
                <i class="sidenav-icon fas fa-file-upload"></i>
                <div>Archivos</div>
                {{-- <div class="pl-1 ml-auto">
                    <div class="badge badge-danger">Hot</div>
                </div> --}}
            </a>
            <ul class="sidenav-menu">
                @role('Tutor')
                    <li class="sidenav-item">
                        <a href="{{url('/reportes')}}" class="sidenav-link">
                            <i class="sidenav-icon fas fa-file"></i>
                            <div>Reportes</div>
                        </a>
                    </li>
                @endrole
                @role('Administrador')
                    <li class="sidenav-item">
                        <a href="{{url('/formatos')}}" class="sidenav-link">
                            <i class="sidenav-icon fas fa-file"></i>
                            <div>Formatos</div>
                        </a>
                    </li>
                @endrole
            </ul>
        </li>
        @endhasanyrole
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
    </ul>
</div>
