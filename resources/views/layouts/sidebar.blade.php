<style>

    li.sidenav-item>a{
        color:#9A5614 !important;
    }
    li.sidenav-item>a:hover{
        color:#D19356 !important;
    }

</style>



<div id="layout-sidenav" class="layout-sidenav sidenav sidenav-vertical bg-white logo-dark">
    <!-- Brand demo (see assets/css/demo/demo.css) -->
    <div class="app-brand demo" style="background-color: #9A5614;color:white !important;">
        <span class="app-brand-logo demo" style="color:#ffff;font-size:20px;">
            {{-- <img src="assets/img/logo.png" alt="Logo" class="img-fluid"> --}}
            <i class="fab fa-tumblr"></i>
        </span>
        <a href="index.html" class="app-brand-text demo sidenav-text font-weight-normal ml-2">Tutoría</a>
        <a href="javascript:" class="layout-sidenav-toggle sidenav-link text-large ml-auto">
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
        <li class="sidenav-item active open">
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
                        <div>Asignaciónes</div>
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
        <li class="sidenav-item">
            <a href="{{url('/evaluacion')}}" class="sidenav-link">
                <i class="sidenav-icon fas fa-chart-bar"></i>
                <div>Grafica de evaluación tutor</div>
            </a>
        </li>
        <li class="sidenav-item">
            <a href="{{url('/seguimientoActividad/tutorial/')}}" class="sidenav-link">
                <i class="sidenav-icon fas fa-tasks"></i>
                <div>Seguimiento actividad tutorial</div>
            </a>
        </li>

        @endrole


        {{-- otro modulo --}}

        @hasanyrole('Administrador||Tutor')
            @role('Tutor')
            <li class="sidenav-divider mb-1"></li>
            <li class="sidenav-header small font-weight-semibold">Tutor</li>
            <li class="sidenav-item">
                <a href="{{url('/tutor')}}" class="sidenav-link">
                    <i class="sidenav-icon fas fa-list-ol"></i>
                    <div>Mis Alumnos</div>
                </a>
            </li>
            @endrole

            <li class="sidenav-item open">
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
                @role('Tutor')
                    <li class="sidenav-item">
                        <a href="{{url('/formatosTutores')}}" class="sidenav-link">
                            <i class="sidenav-icon fas fa-file"></i>
                            <div>Formatos Tutores</div>
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
                    <li class="sidenav-item">
                        <a href="{{url('reportes/reportes_enviados')}}" class="sidenav-link">
                            <i class="sidenav-icon fas fa-file"></i>
                            <div>Reporte de tutores</div>
                        </a>
                    </li>
                @endrole
            </ul>
        </li>
        @endhasanyrole

        @role('Alumno')
            <li class="sidenav-divider mb-1"></li>
            <li class="sidenav-header small font-weight-semibold">Alumno</li>
            <li class="sidenav-item">
                <a href="{{url('/alumno/miTutor')}}" class="sidenav-link">
                    <i class="sidenav-icon fas fa-list-ol"></i>
                    <div>Mi Tutor</div>
                </a>
            </li>
            {{-- <li class="sidenav-item">
                <a href="{{url('/alumno')}}" class="sidenav-link">
                    <i class="sidenav-icon fas fa-list-ol"></i>
                    <div>Mis compañeros</div>
                </a>
            </li> --}}
            <li class="sidenav-item">
                <a href="{{url('/formatosAlumnos')}}" class="sidenav-link">
                    <i class="sidenav-icon fas fa-file"></i>
                    <div>Formatos</div>
                </a>
            </li>
            <li class="sidenav-item open">
                <a href="javascript:" class="sidenav-link sidenav-toggle">
                    <i class="sidenav-icon fas fa-user-edit"></i>
                    <div>Cuestionario</div>
                    {{-- <div class="pl-1 ml-auto">
                        <div class="badge badge-danger">Hot</div>
                    </div> --}}
                </a>
                <ul class="sidenav-menu">
                    <li class="sidenav-item">
                        <a href="{{url('/alumnoCuestionario/grupal')}}" class="sidenav-link">
                             <i class="sidenav-icon fas fa-list-ol"></i>
                            <div>Calificar Tutor Grupal</div>
                        </a>
                    </li>
                    <li class="sidenav-item">
                        <a href="{{url('/alumnoCuestionario/individual')}}" class="sidenav-link">
                            <i class="sidenav-icon fas fa-list-ol"></i>
                            <div>Evaluar tutor</div>
                        </a>
                    </li>
                </ul>
            </li>
        @endrole
        @role('Director')
            <li class="sidenav-divider mb-1"></li>
            <li class="sidenav-header small font-weight-semibold">Director</li>
            <li class="sidenav-item">
                <a href="{{url('/director/formatos')}}" class="sidenav-link">
                    <i class="sidenav-icon fas fa-file"></i>
                    <div>Formatos</div>
                </a>
            </li>
            <li class="sidenav-item">
                <a href="{{url('/director')}}" class="sidenav-link">
                    <i class="sidenav-icon fas fa-file"></i>
                    <div>Reportes</div>
                </a>
            </li>
        @endrole
        @role('Subdirector')
            <li class="sidenav-divider mb-1"></li>
            <li class="sidenav-header small font-weight-semibold">SubDirector</li>
            <li class="sidenav-item">
                <a href="{{url('/subdirector/formatos')}}" class="sidenav-link">
                    <i class="sidenav-icon fas fa-file"></i>
                    <div>Formatos</div>
                </a>
            </li>
            <li class="sidenav-item">
                <a href="{{url('/subdirector')}}" class="sidenav-link">
                    <i class="sidenav-icon fas fa-file"></i>
                    <div>Reportes</div>
                </a>
            </li>
            <li class="sidenav-item">
                <a href="{{url('/seguimientoActividad/tutorial/')}}" class="sidenav-link">
                    <i class="sidenav-icon fas fa-tasks"></i>
                    <div>Seguimiento actividad tutorial</div>
                </a>
            </li>
        @endrole


        @role('Administrador')
         {{-- <li class="sidenav-item">
            <a href="#" class="sidenav-link" id="btn_module_canalizacion">
                <i class="sidenav-icon fas fa-file"></i>
                <div>Canalización</div>
            </a>
        </li> --}}
        <li class="sidenav-item">
            <a href="{{asset('/manual_usuario_sistema.pdf')}}" class="sidenav-link" id="btn_manual_usuario" target="_blank">
                <i class="sidenav-icon fas fa-file-pdf"></i>
                <div>Manual de usuario</div>
            </a>
        </li>
        @endrole
        <!-- Dashboards -->
        {{--
        < class="sidenav-item open active">
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
        </>
        --}}

        @hasanyrole('Subdirector||Tutor||Alumno')
        <li class="sidenav-item">
            <a href="#" class="sidenav-link" id="btn_module_canalizacion">
                <i class="sidenav-icon fas fa-file"></i>
                <div>Canalización</div>
            </a>
        </li>
        @endhasanyrole

    </ul>
</div>

<script>

   document.getElementById('btn_module_canalizacion').addEventListener('click',function(e){
        e.preventDefault();
        alert("Por el momento este módulo no está disponible.");
   });

</script>
