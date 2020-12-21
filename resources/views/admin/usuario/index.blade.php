
@extends('layouts.body')

@section('css')
    <!-- Page -->
    <link rel="stylesheet" href="{{asset('dashboard_assets/libs/quill/typography.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard_assets/libs/quill/editor.css')}}">

    <style>
        .label_filter{
            display:flex;
            justify-content:start;
            color:hsl(215, 76%, 52%);
            padding:10px;

        }

        .selected_tipo_user{
            display: block;
            padding:10px;
            border:1px solid #E3E3E5;
            border-radius:8px;
        }

        .pagination_a_event{
           background-color:white;
        }

    </style>
@endsection

@section('contenido_page')
    <!-- [ Layout content ] Start -->
    <div class="layout-content">
        <!-- [ content ] Start -->
        <div class="container-fluid flex-grow-1 container-p-y">
            <h4 class="display-4" style="color:#B16A26">Lista de usuarios</h4>
            @include('admin.usuario.navar')

            <div class="col-sm-12 contenedor_exception">

            </div>
            @if(session('status_confirm'))
                <div class="col-sm-12 conte_confirm_success" style="margin:15px 0px;">
                    <div class="alert alert-success">
                        {{ session('status_confirm') }} <i class="fas fa-grin-stars"></i>
                        </div>
                </div>
            @endif
            <div class="row justify-content-center">
                <!--1 liveline-section -->
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="row align-items-center m-l-0">
                                <div class="col-sm-6 text-left">
                                    <h5>Filtrar Busqueda</h5>
                                </div>
                                <div class="col-sm-12 row">
                                  <div class="col-sm-2 form-group">
                                      <label for="" class="col-form-label label_filter">Mostrar</label>
                                      <select class="form-control" name="cantidad_data_mostrar_selected" id="cantidad_data_mostrar_selected">
                                          <option value="10">10</option>
                                          <option value="20">20</option>
                                          <option value="50">50</option>
                                          <option value="80">80</option>
                                          <option value="100" selected>100</option>
                                      </select>
                                  </div>

                                    <div class="col-sm-8 form-group">
                                        <label for="" class="col-form-label label_filter">Tipo de usuario</label>
                                        <select class="form-control selected_tipo_user" name="tipo_usuario_search" id="tipo_usuario_search">
                                            <option selected disabled value="0">Seleccione  Tipo  Usuario</option>
                                            <option value="all_todos_users" selected>Todos (*)</option>
                                            <option value="tutor">Tutor</option>
                                            {{-- <option value="asesor">Asesor</option> --}}
                                            <option value="alumno">Alumno</option>
                                            <option value="director">Director Academico</option>
                                            <option value="subdirector">SubDirector Academico</option>
                                            <option value="administrador">Administrador</option>
                                          </select>
                                    </div>
                                    <div class="col-sm-2 form-group">
                                        <label for="" class="col-form-label label_filter" style="display:block;opacity:0"><i class="far fa-file-pdf"></i>Imprimir</label>
                                        <a class="btn btn-danger" href="{{url('/pdf/usuarios/all_todos_users')}}" id="generar_pdf_users" target="_blank">
                                            Generar PDF <i class="far fa-file-pdf"></i>
                                        </a>
                                    </div>


                                    @include('admin.helpers.filtro_busqueda')

                                    <div class="col-sm-12 mt-4 d-flex justify-content-end">
                                        <div>
                                        <button type="button" class="btn mr-2 BTN_SEND_SEARCH" style="background-color:#B16A26;color:white">Consultar</button>
                                        <button type="button" class="btn mr-2 BTN_LIMPIAR_FILTRO" style="background-color:#E7E6E5;color:black; margin:0px 4px;">Limpiar</button>
                                        <button type="button" class="btn mr-2 BTN_OCULTAR_FILTRO" style="background-color:#B6B4B4;color:black">Ocultar</button>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-sm-12" style="display:flex; justify-content:space-between;">
                        <div id="registros_informacion_text" style="display:flex; justify-content:center; align-items:center">
                            <!-- <p>Mostrando 1  a 10 de 57 registros</p> -->
                        </div>

                        <ul class="pagination contenedor_users_paginations">
                          <!-- <li class="page-item"><a class="page-link pagination_a " href="#"><i class="fas fa-chevron-left"></i></a></li>
                          <li class="page-item"><a class="page-link pagination_a_event " href="#">1</a></li>
                          <li class="page-item"><a class="page-link pagination_a_event" href="#">2</a></li>
                          <li class="page-item"><a class="page-link pagination_a_event" href="#">3</a></li>
                          <li class="page-item"><a class="page-link pagination_a_event" href="#">4</a></li>
                          <li class="page-item"><a class="page-link pagination_a_event" href="#">5</a></li>
                          <li class="page-item"><a class="page-link pagination_a_event" href="#"><i class="fas fa-chevron-right"></i></a></li> -->
                        </ul>
                </div>

                <div class="col-sm-12 row contenedor_card_users" style="width:!00%;">
                 @forelse  ($users as $usuario)

                    <?php
                    $cuenta_status="";
                    $cuenta_text="";

                    if($usuario->active==1){
                       $cuenta_text="Activo";
                       $cuenta_status="badge-success";
                    }else if($usuario->active==2){
                        $cuenta_text="Inactivo";
                        $cuenta_status="badge-warning";
                    }else{
                        $cuenta_text="Pendiente";
                        $cuenta_status="badge-danger";
                    }

                    ?>

                    <div class="col-lg-4 col-md-6">
                        <div class="card user-card user-card-1 mt-4">
                            <div class="card-body conte_user" data-id_user="{{$usuario->id}}" data-status_cuenta="{{ $cuenta_text}}" data-user_name="{{ $usuario->nombre }}">
                                <div class="user-about-block text-center">
                                    <div class="row align-items-start">
                                        <div class="col text-left pb-3">
                                            <span class="badge {{ $cuenta_status}} btn_cuenta_user">{{$cuenta_text}}</span>
                                        </div>
                                        <div class="col"><img class="img-radius img-fluid wid-80"
                                          src="{{asset('storage').'/'.$usuario->photo}}" style="height:80px;object-fit: cover;"
                                          alt="Foto de perfil"></div>
                                        <div class="col text-right pb-3">
                                            <div class="dropdown">
                                                <a class="drp-icon dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-horizontal"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item btn_editar_user_index" href="{{url('/Admin/user/'.$usuario->id.'/edit')}}">Edit</a>
                                                    <!-- <a class="dropdown-item" href="#">History</a>
                                                    <a class="dropdown-item" href="#">Trash</a> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <a href="#!" data-toggle="modal" data-target="#modal-report">
                                        <!-- {{strlen($usuario->nombre)}} -->
                                        <h4 class="mb-1 mt-3">
                                          {{ ucwords(strlen($usuario->nombre)>20
                                            ?substr($usuario->nombre,0,20).'..'
                                            :$usuario->nombre)
                                          }}
                                        </h4>
                                    </a>

                                    <?php
                                        $fecha_registro =date('d-m-Y',strtotime($usuario->fecha_registro));
                                    ?>
                                    <p class="mb-3 text-muted"><i class="fas fa-user-tag"></i> </i>{{$usuario->tipo_usuario}} </p>
                                    <p class="mb-1"><b>Email : </b><a href="mailto:dummy@example.com">{{$usuario->email }}</a></p>
                                    <small>Fecha de registro {{$fecha_registro }}</small>
                                    <!-- <small>ruta:{{url('/Admin/user/'.$usuario->id.'/edit')}}</small> -->
                                </div>
                            </div>
                        </div>
                    </div>

                    @empty
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body text-center">
                                <h4 class="display-4 text-muted">No se han encontrado resultados para tu búsqueda</h4>
                            </div>
                        </div>
                    </div>
                    @endforelse

                </div>
                <!-- fin del contenedor de card -->


                <div class="col-sm-12" style="display:flex; justify-content:space-between;">
                        <div id="registros_informacion_text" style="display:flex; justify-content:center; align-items:center">
                            <!-- <p>Mostrando 1  a 10 de 57 registros</p> -->
                        </div>

                        <ul class="pagination contenedor_users_paginations">
                          <!-- <li class="page-item"><a class="page-link pagination_a " href="#"><i class="fas fa-chevron-left"></i></a></li>
                          <li class="page-item"><a class="page-link pagination_a_event " href="#">1</a></li>
                          <li class="page-item"><a class="page-link pagination_a_event" href="#">2</a></li>
                          <li class="page-item"><a class="page-link pagination_a_event" href="#">3</a></li>
                          <li class="page-item"><a class="page-link pagination_a_event" href="#">4</a></li>
                          <li class="page-item"><a class="page-link pagination_a_event" href="#">5</a></li>
                          <li class="page-item"><a class="page-link pagination_a_event" href="#"><i class="fas fa-chevron-right"></i></a></li> -->
                        </ul>
                </div>

                <!-- liveline-section end -->
            </div>
        </div>
        <!-- [ content ] End -->
    </div>
    <!-- [ Layout content ] Start -->
@endsection


@section('script')

<script src="{{asset('js/helpers/ValidarMatriculaAlumno.js')}}"></script>
<script src="{{asset('js/admin/index_user.js')}}"></script>
<script src="{{asset('js/helpers/pagination.js')}}"></script>
<script src="{{asset('js/helpers/GetCarreras.js')}}"></script>


<script>


    // pdf
    $('#tipo_usuario_search').on('change',function(){
        let tipo_user=$('#tipo_usuario_search option:selected').val();
        $('#generar_pdf_users').attr('href',`/pdf/usuarios/${tipo_user}`);

    });

   /*
    $(document).on('click','.btn_editar_user_index',function(e){
        e.prevenDefault();
    })*/


    let Total_pagination_registros="<?php echo $TotalRegistros_of_users; ?>";
    let inicio_pagination_registros="<?php echo $inicio; ?>";
    let fin_pagination_registros="<?php echo $cantidad; ?>";

    InitializarPagination(Total_pagination_registros,fin_pagination_registros,inicio_pagination_registros);

    let object_form_FILTRO_BUSQUEDA={};
    let status_busqueda=false;

    let numero_pagina_index_user="";
    $(document).on('click','.pagination_a_event',function(){
        numero_pagina_index_user=$(this).data('numero_pagina');

        if(status_busqueda==false){
          object_form_FILTRO_BUSQUEDA={
            'tipo_user':"<?php echo $tipousers; ?>",
            'cantidad':"<?php echo $cantidad; ?>"
          };
        }

        object_form_FILTRO_BUSQUEDA.numeroPagina=numero_pagina_index_user;

        console.log(object_form_FILTRO_BUSQUEDA);

        GetDataUserDB(object_form_FILTRO_BUSQUEDA)


    });


    function GetDataUserDB(object_form){

        $.ajax({

           url :'/Admin/user',
           type: "GET",
           headers:{"X-CSRF-Token": csrf_token},
           data :object_form,
           beforeSend:function(){
              $('.conte_loader_MyStyle').css({display:'flex'});

           }
        }).done(function(respuesta){
            //console.log(respuesta);

            var json=JSON.parse(respuesta);
            console.log(json)

            $('.contenedor_card_users').html('');

            let cardUser=creacionCardUser(json.data);

            $('.contenedor_card_users').html(cardUser);
            $('.conte_loader_MyStyle').css({display:'none'});

            if(NumerosPaginasCrear_Pagination==0){
              InitializarPagination(json.TotalRegistros_of_users,json.cantidad,json.inicio);
            }else{
              CrearNuevaPagination(numero_pagina_index_user,json.TotalRegistros_of_users,json.cantidad,json.inicio);
            }

        }).fail(function(jqXHR,textStatus) {

            console.error(jqXHR.responseJSON);

            ajax_fails(jqXHR.status,textStatus,jqXHR.responseText,jqXHR.responseJSON.message);
            $('.conte_loader_MyStyle').css({display:'none'});
        })
    }


    $('.BTN_SEND_SEARCH').on('click',function(e){
        e.preventDefault();


        let is_selected_user=$('#tipo_usuario_search').val();
        let cantidad_data_mostrar_selected=$('#cantidad_data_mostrar_selected').val();
        if(is_selected_user==0||is_selected_user==null){
            alert("DEBES SELECIONAR UN USUARIO");
            return false;
        }

        let FormData_filtro="";
        let status_formData=false;
        console.log(is_selected_user)

        if(is_selected_user!="all_todos_users"){
            if(is_selected_user=="alumno"){
                FormData_filtro=new FormData($('#form_filtro_alumno')[0]);
                status_formData=true;

            }else if(is_selected_user!="alumno" && is_selected_user!="administrador"){
                FormData_filtro=new FormData($('#form_filtro_docente')[0]);
                status_formData=true;
            }
        }

        object_form_FILTRO_BUSQUEDA={
          'tipo_user':is_selected_user,
          'cantidad':cantidad_data_mostrar_selected
        };

        if(status_formData){
            for (let entry of FormData_filtro.entries()){
             //console.log("name="+entry[0]+"   value=: "+entry[1]);
             object_form_FILTRO_BUSQUEDA[entry[0]]=entry[1];
          }
        }

        console.log(object_form_FILTRO_BUSQUEDA)
        NumerosPaginasCrear_Pagination=0;
        status_busqueda=true;

        GetDataUserDB(object_form_FILTRO_BUSQUEDA)


    });



    function tipoUserHTML(usuario){

        var complemento_html="";
        if(usuario.tipo_usuario=="alumno"){
            console.log(usuario)
            complemento_html=`
            <p class="mb-0"><b>${usuario.semestre} ° semestre </b>${usuario.carrera} <span class="badge badge-warning"></span></p>
            <p class="mb-0"><b>Matricula : </b>${usuario.matricula} <span class="badge badge-warning"></span></p>
            <p class="mb-0"><b>Turno ${usuario.turno} </b>Grupo ${usuario.grupo} <span class="badge badge-warning"></span></p>
            `;
        }
        if(usuario.tipo_usuario!="alumno" && usuario.tipo_usuario!="administrador"){
            complemento_html=`
            <p class="mb-0"><b>Cedula : ${usuario.cedula_profesional} </b></p>
            `;
        }

        return complemento_html;

    }

    function creacionCardUser(data){

        let cardUser="";

        if(data.length>0){
            for (const usuario of data) {

                   //console.log(usuario);
                   let is_selected_user=$('#tipo_usuario_search').val();
                   let complemento_html="";
                   if(is_selected_user!="all_todos_users"){
                       complemento_html=tipoUserHTML(usuario);
                   }

                    //console.log(complemento_html)

                    let cuenta_status="";
                    let cuenta_text="";

                    if(usuario.active==1){
                        cuenta_text="Activo";
                        cuenta_status="badge-success";
                    }else if(usuario.active==2){
                        cuenta_text="Inactivo";
                        cuenta_status="badge-warning";
                    }else{
                        cuenta_text="Pendiente";
                        cuenta_status="badge-danger";
                    }

                // src="/storage/${usuario.photo}"
                cardUser+=`
                <div class="col-lg-4 col-md-6">
                            <div class="card user-card user-card-1 mt-4">
                                <div class="card-body conte_user" data-id_user="${usuario.id}" data-status_cuenta="${cuenta_text}" data-user_name="${ usuario.nombre }">
                                    <div class="user-about-block text-center">
                                        <div class="row align-items-start">
                                            <div class="col text-left pb-3">
                                                <span class="badge ${cuenta_status} btn_cuenta_user">${cuenta_text}</span>
                                            </div>
                                            <div class="col"><img class="img-radius img-fluid wid-80" src="/storage/${usuario.photo}"
                                                style="height:80px;object-fit: cover;" alt="Foto de perfil"></div>
                                            <div class="col text-right pb-3">
                                                <div class="dropdown">
                                                    <a class="drp-icon dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-horizontal"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item btn_editar_user_index" href="/Admin/user/${usuario.id}/edit">Editar</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <a href="#!" data-toggle="modal" data-target="#modal-report">
                                            <h4 class="mb-1 mt-3">${usuario.nombre.length>20?(usuario.nombre).substring(0,20)+'...':usuario.nombre}</h4>
                                        </a>
                                        <p class="mb-3 text-muted"><i class="fas fa-user-tag"></i> </i>${usuario.tipo_usuario} </p>
                                        <p class="mb-1"><b>Email : </b><a href="mailto:dummy@example.com">${usuario.email}</a></p>
                                        ${complemento_html}
                                        <small>Fecha de registro ${usuario.fecha_registro}</small>
                                    </div>
                                </div>
                            </div>
                        </div>`;
                }

        }else{
            cardUser=`
                <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body text-center">
                                <h4 class="display-4 text-muted">No se han encontrado resultados para tu búsqueda</h4>
                            </div>
                        </div>
                    </div>
            `;
        }
        return cardUser;

    }

</script>

@endsection
