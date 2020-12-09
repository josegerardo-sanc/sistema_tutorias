
@extends('layouts.body')

@section('css')
    <!-- Page -->
    <link rel="stylesheet" href="{{asset('dashboard_assets/libs/quill/typography.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard_assets/libs/quill/editor.css')}}">

     <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
     <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">


     <link rel="stylesheet" href="{{asset('dashboard_assets/libs/select2/select2.css')}}">
     <link rel="stylesheet" href="{{asset('dashboard_assets/libs/bootstrap-select/bootstrap-select.css')}}">
     <link rel="stylesheet" href="{{asset('dashboard_assets/css/pages/users.css')}}">

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
            {{-- <h4 class="font-weight-bold py-3 mb-0">Modals</h4> --}}
            <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
                    <li class="breadcrumb-item" >Mis alumnos</li>
                    <li class="breadcrumb-item active open_modal_new_alumno" >Registrar alumno</li>
                </ol>
            </div>

            <div clas="row form-group" style="padding:20px 10px;">
                <div class="col-sm-12">
                    @if (!count($asignaciones)>0)
                        <div class="card" style="border:1px solid red;">
                            <div class="card-body">
                                <h4 class="card-title">No cuentas con asignación</h4>
                                <p class="card-text">Porfavo acercate con el área de control escolar para mayor información o con el administrador de la plataforma.</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="row bg-white" style="padding:20px 10px;">
                <div clas="col-sm-12 form-group" style="margin-bottom:20px;">
                    <h3 class="display-4" style="color: #DF480F">
                        Lista de alumnos
                        <button class="mr-2 open_modal_new_alumno btn btn-primary" type="button">Registrar Alumno</button>
                    </h3>
                </div>
                <div class="col-sm-12 form-group">
                    @if (count($asignaciones)>0)
                        <ul style="display: flex;flex-wrap:wrap; justify-content:space-around;list-style:none;">
                            <li>
                                <strong style="color:#FF5733">Carrera</strong>
                                <strong>{{$asignaciones[0]->name_carrera}}</strong>
                           </li>
                           <li>

                                <strong>{{$asignaciones[0]->semestre}} °</strong>
                                <strong style="color:#FF5733">Semestre</strong>

                           </li>
                           <li>
                                <strong style="color:#FF5733">Grupo</strong>
                                <strong>{{$asignaciones[0]->grupo}}</strong>
                            </li>
                            <li>
                                <strong style="color:#FF5733">Turno</strong>
                                <strong>{{$asignaciones[0]->turno}}</strong>
                            </li>
                          </ul>
                    @endif
                </div>
                <div class="col-sm-12">
                    <table id="table_asignacion_individuales" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%; background-color:white;">
                        <thead>
                            <tr>
                                <th>Matricula</th>
                                <th>Nombre</th>
                                <th>Genero</th>
                                <th>Curp</th>
                                <th>Telefono</th>
                                <th>Correo</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="table_asignacion_individuales_body">
                            @foreach ($alumnos as $alumno)
                                <tr>
                                    <td>{{$alumno->matricula}}</td>
                                    <td>{{ucwords($alumno->nombre)}}</td>
                                    <td>{{ucwords($alumno->genero)}}</td>
                                    <td>{{$alumno->curp}}</td>
                                    <td>{{$alumno->telefono}}</td>
                                    <td>{{$alumno->email}}</td>
                                    <td>
                                        <div>
                                            <button
                                               data-id_alumno="{{$alumno->id_user_principal}}"
                                               type="button"
                                               class="btn btn-info btn_ver_data_alumno">Ver más datos</button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{-- row --}}
                <div class="row">
                    <div class="col-sm-12">
                        <div class="modal fade" id="modal_alumno" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title">Datos del alumno</h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                    <form action="#" id="formData_Datos_alumno">
                                        {{ csrf_field() }}
                                        <div class="card-body">
                                            <div class="media align-items-center">
                                                <img src="{{asset('storage').'/Recursos_sistema/upload_image.png'}}" alt="upload_image"
                                                class="d-block ui-w-80 image_perfil"
                                                style="max-width: 80px;"
                                                >
                                                    <div class="media-body ml-3">
                                                        <label class="form-label d-block mb-2">Foto Perfil</label>
                                                        <label class="btn btn-outline-primary btn-sm">
                                                            Buscar
                                                            <input type="file" class="user-edit-fileinput file_usuario_image_search"  name="file_perfil_img" accept="image/x-png, image/gif, image/jpeg">
                                                        </label>&nbsp;
                                                    </div>
                                            </div>
                                            <div class="Mensaje_Subida_Image"></div>
                                        </div>
                                        <div class="card-body pb-2">
                                            <div class="row">
                                                <div class="col-sm-6 form-group conte_referencs_matricula">
                                                    <label class="form-label">Matricula</label>
                                                    <input name="matricula" id="matricula_escolar" type="text"  class="form-control matricula_escolar_validar">
                                                    <div class="contenedor_input_matricula_alumno"></div>
                                                </div>
                                                <div class="col-sm-4 form-group">
                                                    <label class="form-label">Periodo {{date('Y')}}</label>
                                                    <select class="form-control" name="periodo_escolar" id="periodo_escolar">
                                                        <option value="0" disabled selected>Seleccione Periodo</option>
                                                        <option value="1">FEBRERO-JULIO</option>
                                                        <option value="2">AGOSTO-DICIEMBRE</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row form-group contenedor_referencia_btn_this">
                                                <div class="col-sm-5 form-group">
                                                    <label class="form-label">Curp</label>
                                                    <input name="curp" id="curp" type="text" class="form-control input_curp_validar "  mamaxlength="18">
                                                    <div class="content_error_curp"></div>
                                                </div>
                                                <div class="col-sm-2 form-group">
                                                    <label class="form-label" style="display: flex; justify-content:space-between">
                                                        <strong>RFC</strong>
                                                        <small class="text-muted">ópcional</small>
                                                    </label>
                                                    <input name="rfc" id="rfc" type="text" class="form-control" maxlength="4">
                                                </div>

                                                <div class="col-sm-4 form-group" id="conte_validar_curp" style="display:none">
                                                    <label class="form-label" style="opacity: 0">opción</label>
                                                    <button  class="btn btn-block btn_validar_curp_api" style="background-color:#336BFF;color:white;">Validar Curp</button>
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col-sm-4 form-group">
                                                    <label class="form-label">Nombre Completo</label>
                                                    <input name="nombre" id="nombre" type="text" class="form-control mb-1" maxlength="20">
                                                </div>
                                                <div class="col-sm-4 form-group">
                                                    <label class="form-label">Apellido Paterno</label>
                                                    <input name="ap_paterno" id="ap_paterno" type="text" class="form-control" maxlength="15">
                                                </div>
                                                <div class="col-sm-4 form-group">
                                                    <label class="form-label">Apellido Materno</label>
                                                    <input name="ap_materno" id="ap_materno" type="text" class="form-control mb-1"  maxlength="15">
                                                </div>
                                            </div>
                                            <div class="row form-group mb-3">
                                                <label for="" class="col-sm-12 form-label form-group">Genero</label>
                                                <div class="col-sm-3 form-group">
                                                    <label class="custom-control custom-checkbox m-0">
                                                        <input name="genero" id="masculino" value="masculino" type="radio"  class="custom-control-input">
                                                        <span class="custom-control-label">Masculino</span>
                                                    </label>
                                                </div>
                                                <div class="col-sm-3 form-group">
                                                    <label class="custom-control custom-checkbox m-0">
                                                        <input name="genero" id="femenino" value="femenino" type="radio" class="custom-control-input">
                                                        <span class="custom-control-label">Femenino</span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="row form-group">
                                                <div class="col-sm-4 form-group">
                                                    <label class="form-label">Fecha Nacimiento</label>
                                                    <input name="fecha_nacimiento" id="fecha_nacimiento" type="date" class="form-control">
                                                </div>
                                                <div class="col-sm-4 form-group contenedor_principal_validar">
                                                    <label class="form-label">Telefono</label>
                                                    <input name="telefono" id="telefono" type="text" class="form-control validate_telefono_lada validar_numeric_input"  maxlength="10">
                                                    <div class="content_error_validar_lada"></div>
                                                </div>
                                                <div class="col-sm-4 form-group conte_email_validar">
                                                    <label class="form-label">Correo</label>
                                                    <input name="email" id="email" type="email" class="form-control valid_email_express_regular"  maxlength="50">
                                                    <div class="content_error_validate_email"></div>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- DOMICILIO --}}
                                        <div class="card-body ContenedorcodigoPostal_father">
                                            <h5>Datos del domicilio</h5>
                                            <div class="row form-group">
                                                <div class="col-sm-3 form-group">
                                                    <label class="form-label">Código Postal</label>
                                                    <div class="display:flex">
                                                        <input name="codigo_postal" id="codigo_postal" type="text" class="form-control mb-1 inputBuscarCodigoPostal"  maxlength="5">
                                                        <div class="alert alert-success conte_spiner_codePostal" style="display:none">Espere <i class="fas fa-spinner fa-spin"></i> ......</div>
                                                        <div class="alert alert-danger conte_spiner_codePostal_error" style="display:none"><i class="fas fa-exclamation-triangle"></i> Verifique CodigoPostal ,No encontramos resultados  </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 form-group" style="display: inline-block;">
                                                    <label class="form-label">Estado</label>
                                                    <select class="form-control estado_complete" name="estado" disabled>
                                                        <option selected disabled value="0">Estado</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-3 form-group">
                                                    <label class="form-label">Municipio</label>
                                                    <select class="form-control municipio_complete" name="municipio"  disabled>
                                                        <option selected disabled value="0">Seleccione Municipio</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-3 form-group">
                                                    <label class="col-form-label display:flex ">Localidad
                                                        <span class="badge badge-pill badge-secondary tipoAsentamiento">info</span>
                                                    </label>
                                                    <select class="form-control localidad_complete" name="localidad" id="localidad">
                                                        <option selected disabled value="0">Seleccione Localidad</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <input type="text" id="id_user_alumno_db">
                                  <button type="button" class="btn btn-primary" id="btn_register_alumno_tutor">Actualizar</button>
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                </div>
                              </div>
                            </div>
                          </div>
                    </div>
                </div>
            {{-- row --}}
        </div>
        <!-- [ content ] End -->
    </div>
    <!-- [ Layout content ] Start -->
@endsection


@section('script')

{{-- <script src="{{asset('js/helpers/ValidarMatriculaAlumno.js')}}"></script>
<script src="{{asset('js/admin/index_user.js')}}"></script>
<script src="{{asset('js/helpers/pagination.js')}}"></script>
<script src="{{asset('js/helpers/GetCarreras.js')}}"></script> --}}

<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>

<link rel="stylesheet" href="{{asset('dashboard_assets/libs/bootstrap-select/bootstrap-select.css')}}">
<script src="{{asset('dashboard_assets/libs/select2/select2.js')}}"></script>
<script src="{{asset('js/helpers/idiomaEspañolDataTable.js')}}"></script>


<script src="{{asset('js/helpers/verificarLada.js')}}"></script>
<script src="{{asset('js/helpers/helpersCurpAPI.js')}}"></script>
<script src="{{asset('js/helpers/codepostal.js')}}"></script>
<script src="{{asset('js/helpers/ValidarEMAIL_TELEFONO.js')}}"></script>
<script src="{{asset('js/helpers/ValidarMatriculaAlumno.js')}}"></script>
<script src="{{asset('js/helpers/Ajax_fail.js')}}"></script>

<script>

// $('#modal_alumno').modal('show');
// console.log(<?php echo json_encode($alumnos);?>);

var data_alumno_arreglo=<?php echo json_encode($alumnos);?>;

var data_codigoPostal_array=<?php echo json_encode($data_codigoPostal);?>;

console.log(data_alumno_arreglo);
console.log(data_codigoPostal_array);

$('#btn_register_alumno_tutor').on('click',function(e){
    e.preventDefault();
    $('.list_error').html('');
    //  var foto_perfil=$('.file_usuario_image_search')[0].files[0];


     let formData_Datos_alumno=new FormData($('#formData_Datos_alumno')[0]);
     for (let entry of formData_Datos_alumno.entries()){
         formData_Datos_alumno.append(entry[0],entry[1]);
     }
     formData_Datos_alumno.append('img_perfil',$('.file_usuario_image_search')[0].files[0]);
      //ver datos que serane nviados al backen

    for (let entry of formData_DatosPersonales.entries()){
        console.log("clave: "+entry[0]+"   valor: "+entry[1]);
    }

    let this_element=$(this);
    let this_element_texto=$(this).html();

    var ruta_ajax="/tutor/registerAlumno";

    let id_user_alumno=$('#id_user_alumno_db').val();
    if(id_user_alumno!=undefined&&id_user_alumno!=0){

        ruta_ajax=`/tutor/actualizarAlumno/${id_user}`;
    }

    return false;

    $.ajax(
        {
          url :ruta_ajax,
          type:'POST',
          headers:{"X-CSRF-Token": csrf_token},
          data :formData_Datos_alumno,
          processData: false,
          contentType: false,
          beforeSend:function(){
             $(this_element).html('<i class="fas fa-sync fa-spin"></i> Cargando.......').attr('disabled','disabled');
            }

        })
        .done(function(respuesta) {
            $('.conte_loader_MyStyle').css({display:'none'});
            //console.log(respuesta)
            $(this_element).html(this_element_texto).removeAttr('disabled');
            var data=JSON.parse(respuesta);
            console.log(data);

            var btn_close_Alert=` <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>`;

            if(data.withErrrors){
                var errors="";
                var status=false;
                for (const item in data.withErrrors){
                    //console.log(`${item}: ${data.withErrrors[item]}`);
                    errors+=`<li>${data.withErrrors[item]}</li>`;
                    status=true;
                }
               if(status){
                /*La propiedad scrollTop:0 nos desplaza hacia el comienzo de la página web, en la posición 0px, y 600*/
                 $('.list_error').html(`<div class='alert alert-danger alert-dismissible fade show'><ul>${errors}</ul>${btn_close_Alert}</div>`);
                 $("html, body").animate({ scrollTop: 0 }, 600);
                }
                return false;
            }

            if(data.status=="400"){
                var errors_list="";

                if(data.file_error){

                        for (const item in data.info) {

                            errors_list+=`<li><strong style="color:#FF334C">${item.toUpperCase()} : </strong> ${data.info[item]}</li>`;
                        }
                }else{
                    errors_list=`<li>${data.info}</li>`;
                }
                $('.list_error').html(`<div class='alert alert-warning alert-dismissible fade show'>${errors_list}  ${btn_close_Alert}</div>`);
            }
            if(data.status=="200"){
                $('.list_error').html(`<div class='alert alert-success alert-dismissible fade show'>${data.info} ${btn_close_Alert}</div>`);

                // if($('.file_usuario_image_search').val()!=""){
                //     var img=URL.createObjectURL(foto_perfil);
                //     $('.imagen_perfil_navar').attr('src',img);
                // }
            }

        }).fail(function(jqXHR,textStatus) {

            console.error(jqXHR.responseJSON);
             ajax_fails(jqXHR.status,textStatus,jqXHR.responseText,jqXHR.responseJSON.message);
             $('.conte_loader_MyStyle').css({display:'none'});
             $(this_element).html(this_element_texto).removeAttr('disabled');

         })
});

var img_perfil=$('.image_perfil').attr("src");


function limpiarFormulario(){

        $('.image_perfil').attr('src',`/storage//Recursos_sistema/upload_image.png`)
        $('#id_user_alumno_db').val('');
        $('#matricula_escolar').val('');
        $('#curp').val('');
        $('#rfc').val('');
        $('#nombre').val('');
        $('#ap_paterno').val('');
        $('#ap_materno').val('');

        $('#femenino').attr('checked', false);
        $('#masculino').attr('checked', false);

        $('#fecha_nacimiento').val('');
        $('#telefono').val('');

        $('#email').val('');
        $('#codigo_postal').val('');
        $('.estado_complete').html(`<option value="0" selected disabled>Seleccione un estado</option>`);
        $('.municipio_complete').html(`<option value="0" selected disabled>Seleccione un municipio</option>`);


        $('.localidad_complete').html('<option value="0" selected disabled>Seleccione una localidad</option>');


}

$(document).on('click','.open_modal_new_alumno',function(){
    limpiarFormulario();
    $('#btn_register_alumno_tutor').html('Registrar Alumno')
    $('#modal_alumno').modal('show');

});

$(document).on('click','.btn_ver_data_alumno',function(){

    $('#btn_register_alumno_tutor').html('Actualizar Alumno')

    let id_alumno=$(this).data('id_alumno');
    let data=buscarAlumno(id_alumno);

    console.log(data);
    if(data.length>0){
        console.log(data[0].code_postal);

        if(data[0].photo!=""){
            $('.image_perfil').attr('src',`/storage/${data[0].photo}`)
        }
        $('#id_user_alumno_db').val(data[0].id_user_principal);
        $('#matricula_escolar').val(data[0].matricula);
        $('#curp').val(data[0].curp);
        $('#rfc').val(data[0].rfc);

        $('#nombre').val(data[0].nombre);
        $('#ap_paterno').val(data[0].ap_paterno);
        $('#ap_materno').val(data[0].ap_materno);


        if(data[0].genero=="femenino"){
            $('#femenino').attr('checked', true);
        }else{
            $('#masculino').attr('checked', true);
        }

        $('#fecha_nacimiento').val(data[0].fecha_nacimiento);
        $('#telefono').val(data[0].telefono);

        $('#email').val(data[0].email);
        // <img class="img-radius img-fluid wid-80" src="/storage/${usuario.photo}"
        //                                         style="height:80px;object-fit: cover;" alt="Foto de perfil"></div>
        let localidad_selected = data[0].localidad;
        $('#codigo_postal').val(data[0].code_postal);
         // $('.inputBuscarCodigoPostal').keyup();
        $('.estado_complete').html(`<option>${data_codigoPostal_array[0].estado}</option>`);
        $('.municipio_complete').html(`<option>${data_codigoPostal_array[0].municipio}</option>`);

        let localidad_selected_options="";

        for (let index = 0; index < data_codigoPostal_array.length; index++) {
            let selected="";
            if(localidad_selected==data_codigoPostal_array[index].id){
                selected="selected";
            }
            localidad_selected_options+=`<option value="${data_codigoPostal_array[index].id}" ${selected}>${data_codigoPostal_array[index].asentamiento}</option>`;

            console.log(data_codigoPostal_array[index].id);
        }
        $('.localidad_complete').html(localidad_selected_options);

        $('#modal_alumno').modal('show');

    }
});

function buscarAlumno(id){

    let datos=[];

    for (let index = 0; index < data_alumno_arreglo.length; index++) {
        if(data_alumno_arreglo[index].id_user_principal==id){
            datos.push(data_alumno_arreglo[index])
            return datos;
        }
    }

    return datos;
}



$('#table_asignacion_individuales').DataTable({
    "order": [
        [0, 'desc'],
        [1, 'desc']
    ],
    "language":language
});



$('.image_perfil').on('click',function(){
    $('.file_usuario_image_search').click();
});

$('.file_usuario_image_search').on('change', function() {
    $('.Mensaje_Subida_Image').html('');

    var picture=this;
    //console.log(picture.files[0]);

    var sizeByte = picture.files[0].size;

    // 640 x 480 = 307200
    // 307200 x 3 = 921600 bytes 921600 / 1024 = 900 KB
    // 1kb ==1024 bytes


    // ejemplo si pesa 3mg es igual a 3kb

    var siezekiloByte = parseInt(sizeByte/1024);
    //2. tipo_archivo
    var file_input = picture.files[0];
    var ext = ['jpeg', 'jpg', 'png'];
    var name = file_input.name.split('.').pop().toLocaleLowerCase();
    var archivo_permitidos="";
    //1 kilobyte multiplica el valor de tamaño de datos por 1000

    // peso permitido 2 MEGABYTE
    var list_errors="";

    if(siezekiloByte>2048){
        var megaByte=(siezekiloByte/1024).toFixed();
        list_errors+=`<li>El archivo supera el limite (${megaByte})MB permitido 2MB</li>`;
    }

    if (ext.indexOf(name) == -1) {
        archivo_permitidos = ext.toString().toUpperCase();
        list_errors+=`<li>Archivos permitidos ${archivo_permitidos}</li>`;
    }

    if(list_errors!=""){
        $('.Mensaje_Subida_Image').html(`
                <div class="alert alert-warning alert-dismissible fade show mt-4" role="alert">
                ${list_errors}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        `);

        $('.image_perfil').attr("src",img_perfil);
        $('.file_usuario_image_search').val("");

        return false;
    }


    var img=URL.createObjectURL(picture.files[0]);
        //console.log(file_input.parentElement);
     $('.image_perfil').attr('src',img);
});



</script>

@endsection
