
@extends('layouts.body')

@section('css')
    <!-- Page -->
    <link rel="stylesheet" href="{{asset('dashboard_assets/quill/typography.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard_assets/quill/editor.css')}}">

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


    </style>
@endsection

@section('contenido_page')
    <!-- [ Layout content ] Start -->
    <div class="layout-content">
        <!-- [ content ] Start -->
        <div class="container-fluid flex-grow-1 container-p-y">
            <h4 class="font-weight-bold py-3 mb-0">User Management</h4>
            @include('admin.usuario.navar')


            <div class="col-sm-12 contenedor_exception">

            </div>
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
                                    <div class="col-sm-12 form-group">
                                        <label for="" class="col-form-label label_filter">Tipo de usuario</label>
                                        <select class="form-control selected_tipo_user" name="tipo_usuario_search" id="tipo_usuario_search">
                                            <option selected disabled value="0">Seleccione  Tipo  Usuario</option>
                                            <option value="tutor">Tutor</option>
                                            <option value="asesor">Asesor</option>
                                            <option value="alumno">Alumno</option>
                                            <option value="director">Director Academico</option>
                                            <option value="subdirector">SubDirector Academico</option>
                                            <option value="administrador">Administrador</option>
                                        </select>
                                    </div>

                                    @include('admin.helpers.filtro_busqueda')

                                    <div class="col-sm-12 mt-4">
                                        <button type="button" class="btn float-right BTN_CANCELAR_SEARCH" style="background-color:#be1616;color:white; margin:0px 4px;">Cancelar</button>
                                        <button type="button" class="btn float-right BTN_SEND_SEARCH" style="background-color:#1050B9;color:white">Consultar</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
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
                                        <div class="col"><img class="img-radius img-fluid wid-80" src="{{asset('storage').'/'.$usuario->photo}}" alt="Foto de perfil"></div>
                                        <div class="col text-right pb-3">
                                            <div class="dropdown">
                                                <a class="drp-icon dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-horizontal"></i></a>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="#">Edit</a>
                                                    <a class="dropdown-item" href="#">History</a>
                                                    <a class="dropdown-item" href="#">Trash</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <a href="#!" data-toggle="modal" data-target="#modal-report">
                                        <h4 class="mb-1 mt-3">{{ ucwords($usuario->nombre)}}</h4>
                                    </a>

                                    <?php
                                        $fecha_registro =date('d-m-Y',strtotime($usuario->created_at));
                                    ?>
                                    <p class="mb-3 text-muted"><i class="feather icon-calendar"> </i>{{$usuario->fecha_nacimiento}}</p>
                                    <p class="mb-1"><b>Email : </b><a href="mailto:dummy@example.com">{{$usuario->email }}</a></p>
                                    <p class="mb-0"><b>Usuario : </b>{{$usuario->tipo_usuario}} <span class="badge badge-warning"></span></p>

                                    <small>Fecha de ingreso {{$fecha_registro }}</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    @empty
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body text-center">
                                <h4>no se han encontrado resultados para tu búsqueda</h4>
                            </div>
                        </div>
                    </div>
                    @endforelse

                </div>



                <!-- liveline-section end -->
            </div>
        </div>
        <!-- [ content ] End -->
    </div>
    <!-- [ Layout content ] Start -->
@endsection


@section('script')

<script src="{{asset('js/admin/usuario.js')}}"></script>
<script src="{{asset('js/helpers/ValidarMatriculaAlumno.js')}}"></script>
<script>






let TIPO_USER_SEARCH="";
let REALIZAR_BUSQUEDA_FILTRO=true;
  $('#tipo_usuario_search').on('change',function(){

    console.log("cancelar")
        TIPO_USER_SEARCH=$(this).val();
        $('.conte_filtro_clave').css({'display':'none'});

        var text_filtro_clave="";

        $('.contenedor_filtro_alumno').hide();
        $('.contenedor_filtro_docente').hide();

        if(TIPO_USER_SEARCH=="alumno"){
            $('.contenedor_filtro_alumno').show();
            REALIZAR_BUSQUEDA_FILTRO=true;

        }else if(TIPO_USER_SEARCH!="alumno"&&TIPO_USER_SEARCH!="administrador"){
            $('.contenedor_filtro_docente').show();
            REALIZAR_BUSQUEDA_FILTRO=true;
        }

    });

    $('.BTN_CANCELAR_SEARCH').on('click',function(){

        $('.contenedor_filtro_alumno').hide();
        $('.contenedor_filtro_docente').hide();

        REALIZAR_BUSQUEDA_FILTRO=false;
        $('#tipo_usuario_search').val(0);

    });

    $('.BTN_SEND_SEARCH').on('click',function(e){
        e.preventDefault();

        let is_selected_user=$('#tipo_usuario_search').val();

        console.log(is_selected_user)

        if(is_selected_user==0||is_selected_user==null){
            alert("DEBES SELECIONAR UN USUARIO");
            return false;
        }

        let FormData_filtro="";
        let status_formData=false;

        if(is_selected_user=="alumno"){
            console.log("alumno")
            FormData_filtro=new FormData($('#form_filtro_alumno')[0]);
            status_formData=true;

        }else if(is_selected_user!="alumno" && is_selected_user!="administrador"){
            console.log("docente")
            FormData_filtro=new FormData($('#form_filtro_docente')[0]);
            status_formData=true;
        }


        let object_form={
            tipo_user:is_selected_user
        };

        if(status_formData){
            for (let entry of FormData_filtro.entries()){
             console.log("name="+entry[0]+"   value=: "+entry[1]);
             object_form[entry[0]]=entry[1];
          }
        }


        $.ajax({

           url :'/Admin/user',
           type: "GET",
           headers:{"X-CSRF-Token": csrf_token},
           data :object_form,
           beforeSend:function(){
              $('.conte_loader_MyStyle').css({display:'flex'});

           }
        }).done(function(respuesta){
            console.log(respuesta);

            var json=JSON.parse(respuesta);
            console.log(json)

            $('.contenedor_card_users').html('holis');

            let cardUser=creacionCardUser(json.data);

            $('.contenedor_card_users').html(cardUser);
            $('.conte_loader_MyStyle').css({display:'none'});

        }).fail(function(jqXHR,textStatus,errorThrown) {

            console.error(jqXHR.responseJSON);

            ajax_fails(jqXHR.status,textStatus,jqXHR.responseText,jqXHR.responseJSON.message);
            $('.conte_loader_MyStyle').css({display:'none'});
        })


    });

    function creacionCardUser(data){

        let cardUser="";

        if(data.length>0){
            for (const usuario of data) {

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

                cardUser+=`
                <div class="col-lg-4 col-md-6">
                            <div class="card user-card user-card-1 mt-4">
                                <div class="card-body conte_user" data-id_user="${usuario.id}" data-status_cuenta="${cuenta_text}" data-user_name="${ usuario.nombre }">
                                    <div class="user-about-block text-center">
                                        <div class="row align-items-start">
                                            <div class="col text-left pb-3">
                                                <span class="badge ${cuenta_status} btn_cuenta_user">${cuenta_text}</span>
                                            </div>
                                            <div class="col"><img class="img-radius img-fluid wid-80" src="/storage/${usuario.photo}" alt="Foto de perfil"></div>
                                            <div class="col text-right pb-3">
                                                <div class="dropdown">
                                                    <a class="drp-icon dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-more-horizontal"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <a class="dropdown-item" href="#">Edit</a>
                                                        <a class="dropdown-item" href="#">History</a>
                                                        <a class="dropdown-item" href="#">Trash</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <a href="#!" data-toggle="modal" data-target="#modal-report">
                                            <h4 class="mb-1 mt-3">${usuario.nombre}</h4>
                                        </a>
                                        <p class="mb-3 text-muted"><i class="feather icon-calendar"> </i>${usuario.fecha_nacimiento}</p>
                                        <p class="mb-1"><b>Email : </b><a href="mailto:dummy@example.com">${usuario.email}</a></p>
                                        <p class="mb-0"><b>Usuario : </b>${usuario.tipo_usuario} <span class="badge badge-warning"></span></p>
                                        <small>Fecha de ingreso ${usuario.created_at}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                `;
                }

        }else{
            cardUser=`
                <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body text-center">
                                <h4>no se han encontrado resultados para tu búsqueda</h4>
                            </div>
                        </div>
                    </div>
            `;
        }
        return cardUser;

    }

</script>

@endsection
