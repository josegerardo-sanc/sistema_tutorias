
@extends('layouts.body')
@section('css')


    <link rel="stylesheet" href="{{asset('dashboard_assets/css/pages/file-manager.css')}}">
@endsection

@section('contenido_page')
<div class="layout-content">

    <!-- [ content ] Start -->
    <div class="container-fluid flex-grow-1 container-p-y">
        <h4 class="display-4" style="color:#B16A26">Modulo de subida de reportes</h4>
        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
            <ol class="breadcrumb">
                {{-- <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active">File Manger</li> --}}
            </ol>
        </div>
        <div class="row"  style="padding: 10px; background-color:white">
            <div class="col-sm-12 msg_error_conte_upload_file_DELETE">

            </div>
            <div class="col-sm-12">
                <!-- Content -->
                <div class="container-fluid flex-grow-1 container-p-y">

                    <div class="bg-lightest container-m--x container-m--y mb-3">
                        <hr class="m-0">

                        <div class="file-manager-actions container-p-x py-2">
                                {{-- col --}}
                                <div>
                                    <button type="button" class="btn btn-primary mr-2" id="btn_open_upload_file">
                                        <i class="ion ion-md-cloud-upload"></i>&nbsp; Nuevo Reporte</button>
                                    {{-- <button type="button" class="btn btn-secondary mr-2" disabled>
                                        <i class="ion ion-md-cloud-download"></i>
                                    </button> --}}
                                    <div class="btn-group mr-2">
                                        <button type="button" class="btn btn-default md-btn-flat dropdown-toggle px-2" data-toggle="dropdown">
                                            <i class="ion ion-ios-settings"></i>Opción
                                        </button>
                                        <div class="dropdown-menu">
                                            {{-- <a class="dropdown-item" href="javascript:void(0)">Move</a>
                                            <a class="dropdown-item" href="javascript:void(0)">Copy</a> --}}
                                            <a class="dropdown-item seleccion_multiples_archivos_delete" href="javascript:void(0)">Eliminar Archivos</a>
                                        </div>
                                    </div>
                                </div>
                                {{-- col --}}
                                <div>
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-default md-btn-flat active">
                                            <input type="radio" name="file-manager-view" value="file-manager-col-view" >
                                            <span class="ion ion-md-apps"></span>
                                        </label>
                                        <label class="btn btn-default md-btn-flat">
                                            <input type="radio" name="file-manager-view" value="file-manager-row-view" id="click_views" checked >
                                            <span class="ion ion-md-menu"></span>
                                        </label>
                                    </div>
                                </div>
                              {{-- col --}}
                        </div>

                        <hr class="m-0">
                    </div>

                    <div class="file-manager-container file-manager-col-view" id="contenedor_listar_reportes">
                        {{-- <div class="file-item">
                            <div class="file-item-icon file-item-level-up fas fa-level-up-alt text-secondary"></div>
                            <a href="javascript:void(0)" class="file-item-name">
                                ..
                            </a>
                        </div> --}}

                        {{-- col --}}


                            {{-- <div class="file-item">
                                    <div class="file-item-select-bg bg-primary"></div>
                                    <label class="file-item-checkbox custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input">
                                        <span class="custom-control-label"></span>
                                    </label>
                                    <div class="file-item-icon far fa-folder text-secondary"></div>
                                    <a href="javascript:void(0)" class="file-item-name">
                                        Images
                                    </a>
                                    <div class="file-item-changed">02/13/2018</div>
                                    <div class="file-item-actions btn-group">
                                        <button type="button" class="btn btn-default btn-sm btn-round icon-btn borderless md-btn-flat hide-arrow dropdown-toggle" data-toggle="dropdown">
                                            <i class="ion ion-ios-more"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="javascript:void(0)">Rename</a>
                                            <a class="dropdown-item" href="javascript:void(0)">Move</a>
                                            <a class="dropdown-item" href="javascript:void(0)">Copy</a>
                                            <a class="dropdown-item" href="javascript:void(0)">Remove</a>
                                        </div>
                                    </div>
                            </div>
                            <div class="file-item">
                                    <div class="file-item-select-bg bg-primary"></div>
                                    <label class="file-item-checkbox custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input">
                                        <span class="custom-control-label"></span>
                                    </label>
                                    <div class="file-item-icon far fa-folder text-secondary"></div>
                                    <a href="javascript:void(0)" class="file-item-name">
                                        Images
                                    </a>
                                    <div class="file-item-changed">02/13/2018</div>
                                    <div class="file-item-actions btn-group">
                                        <button type="button" class="btn btn-default btn-sm btn-round icon-btn borderless md-btn-flat hide-arrow dropdown-toggle" data-toggle="dropdown">
                                            <i class="ion ion-ios-more"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="javascript:void(0)">Rename</a>
                                            <a class="dropdown-item" href="javascript:void(0)">Move</a>
                                            <a class="dropdown-item" href="javascript:void(0)">Copy</a>
                                            <a class="dropdown-item" href="javascript:void(0)">Remove</a>
                                        </div>
                                    </div>
                            </div>
                            <div class="file-item">
                                    <div class="file-item-select-bg bg-primary"></div>
                                    <label class="file-item-checkbox custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input">
                                        <span class="custom-control-label"></span>
                                    </label>
                                    <div class="file-item-icon far fa-folder text-secondary"></div>
                                    <a href="javascript:void(0)" class="file-item-name">
                                        Images
                                    </a>
                                    <div class="file-item-changed">02/13/2018</div>
                                    <div class="file-item-actions btn-group">
                                        <button type="button" class="btn btn-default btn-sm btn-round icon-btn borderless md-btn-flat hide-arrow dropdown-toggle" data-toggle="dropdown">
                                            <i class="ion ion-ios-more"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="javascript:void(0)">Rename</a>
                                            <a class="dropdown-item" href="javascript:void(0)">Move</a>
                                            <a class="dropdown-item" href="javascript:void(0)">Copy</a>
                                            <a class="dropdown-item" href="javascript:void(0)">Remove</a>
                                        </div>
                                    </div>
                            </div> --}}


                        {{-- col --}}
                    </div>
                </div>
                <!-- / Content -->
            </div>

             {{-- col --}}
                <div class="col-sm-12">
                    <div class="modal" tabindex="-1" role="dialog" id="modal_upload_file">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="title_modal_upload_file">Nuevo Reporte</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="row">
                                  {{-- col --}}
                                  <div class="col-sm-12 msg_error_conte_upload_file">

                                  </div>
                                  {{-- col --}}
                                  <div class="col-sm-12 form-group">
                                    <label for="titulo_archivo_input" class="col-form-label">Titulo</label>
                                    <input type="text" id="titulo_archivo_input" class="form-control">
                                 </div>
                                 {{-- col --}}
                                 <div class="col-sm-12 form-group">
                                    <label for="archivo_descripcion_textarea" class="col-form-label">Descripción</label>
                                    <textarea name="" id="archivo_descripcion_textarea" cols="5" rows="3" class="form-control"></textarea>
                                 </div>
                                  {{-- col --}}
                              </div>
                              {{-- row --}}
                              <div class="row form-group">
                                <div class="col-sm-6 form-group">
                                        <label class="form-label">Semestre</label>
                                        <select  name="semestre_escolar" id="semestre_escolar" class="form-control">
                                            <option value="0" disabled selected>Seleccione Semestre</option>
                                            <option value="1">1º Semestre</option>
                                            <option value="2">2º Semestre</option>
                                            <option value="3">3º Semestre</option>
                                            <option value="4">4º Semestre</option>
                                            <option value="5">5º Semestre</option>
                                            <option value="6">6º Semestre</option>
                                            <option value="7">8º Semestre</option>
                                            <option value="8">9º Semestre</option>
                                        </select>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label class="form-label">Carrera <strong class="carreras_select_textError"></strong></label>
                                    <select  name="carrera_escolar" id="carrera_escolar" class="form-control carreras_select">
                                        <option value="0" disabled selected>Seleccione Carrera</option>
                                    </select>
                                 </div>
                            </div>
                              {{-- col --}}
                              <div class="row form-group">
                                    <div class="col-sm-4 form-group">
                                        <label class="form-label">Periodo {{date('Y')}}</label>
                                        <select class="form-control" name="periodo_escolar" id="periodo_escolar">
                                            <option value="0" disabled selected>Seleccione Periodo</option>
                                            <option value="FEBRERO-JULIO">FEBRERO-JULIO</option>
                                            <option value="AGOSTO-DICIEMBRE">AGOSTO-DICIEMBRE</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label class="form-label">Turno</label>
                                        <select class="form-control" name="turno_escolar" id="turno_escolar">
                                            <option value="0" disabled selected>Seleccione Turno</option>
                                            <option value="Matutino">Matutino</option>
                                            <option value="Vespertino">Vespertino</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label class="form-label">Grupo</label>
                                        <select class="form-control" name="grupo_escolar" id="grupo_escolar">
                                            <option value="0" disabled selected>Seleccione Grupo</option>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-12" style="none" id="conte_nombre_archivo_original_edit">
                                        {{-- <span class="badge badge-pill badge-success">Success</span> --}}
                                    </div>
                                    <div class="col-sm-12 form-group">
                                        <label for="archivo_file_input" class="col-form-label">Archivo</label>
                                        <input type="file" id="archivo_file_input" class="form-control file_usuario_image_search">
                                        <input type="hidden" id="id_archivo" style="opacity: 0;">
                                     </div>
                                </div>
                                {{-- row --}}
                              {{-- fin conte_body_modal --}}
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-primary" id="btn_upload_file_modal">
                                  <i class="ion ion-md-cloud-upload"></i>&nbsp;  Subir Archivo
                              </button>
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                          </div>
                        </div>
                      </div>
                </div>
            {{-- col --}}

        </div>
    </div>
    <!-- [ content ] End -->
</div>
@endsection


@section('script')
<script src="{{asset('js/helpers/GetCarreras.js')}}"></script>


<script>

var btn_close_Alert=` <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>`;

    // obtener reportes

    var array_archivosDb=[];
    function getFormatos(){
        array_archivosDb=[];

        $.ajax(
        {
          url :'/reportes',
          type:'GET',
          headers:{"X-CSRF-Token": csrf_token},
          data :{},
          beforeSend:function(){
             $('#contenedor_listar_reportes').html(`
                 <div class="col-sm-12 d-flex justify-content-center align-items-center" style="margin-top: 50px; font-size:20px;">
                            <i class="fas fa-sync fa-spin"></i>&nbsp;&nbsp;&nbsp;Cargando.......
                </div>`).attr('disabled','disabled');
            }

        })
        .done(function(respuesta) {
            //console.log(respuesta)
            var json=JSON.parse(respuesta);
            console.log(json);

            if(json.status=="400"){
                $('.msg_error_conte_upload_file').html(`<div class='alert alert-danger alert-dismissible fade show'>${json.info}  ${btn_close_Alert}</div>`);
            }
            if(json.status=="200"){
                let reportes_html="";

                if(json.data.length>0){
                    for (const iterator of json.data) {
                            // console.log(JSON.parse(iterator.datos_tipo_archivo));

                            let extencion_archivo="."+iterator.ruta_archivo.split('.').pop().toLocaleLowerCase();
                            let backgrond_badge=""
                            if(extencion_archivo==".pdf"){
                                backgrond_badge="badge-danger"
                            }
                            if(extencion_archivo==".xlsx"||extencion_archivo==".xls"){
                                backgrond_badge="badge-success"
                            }

                            if(extencion_archivo==".docx"||extencion_archivo==".doc"){
                                backgrond_badge="badge-info"
                            }

                            array_archivosDb.push(iterator);

                            reportes_html+=`<div class="file-item contenedor_file_item_"
                                                data-id="${iterator.id_archivo}"
                                            >
                                            <div class="file-item-select-bg bg-primary"></div>
                                            <label class="file-item-checkbox custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input btn_archivo_selected_archivos">
                                                <span class="custom-control-label"></span>
                                            </label>
                                            <div class="file-item-icon far fa-folder text-secondary"></div>
                                            <a href="javascript:void(0)" class="file-item-name p-1">
                                                <strong>${iterator.titulo}
                                                   <span class="badge ${backgrond_badge}">${extencion_archivo}</span>
                                                </strong>
                                                <div style="width:100%">
                                                    <strong>Descrpción:</strong> ${iterator.descripcion}
                                                </div>
                                            </a>
                                            <div class="file-item-changed">${iterator.fecha_created_archivo}</div>
                                            <div class="file-item-actions btn-group">
                                                <button type="button" class="btn btn-default btn-sm btn-round icon-btn borderless md-btn-flat hide-arrow dropdown-toggle" data-toggle="dropdown">
                                                    <i class="ion ion-ios-more"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item btn_archivo_editar" href="javascript:void(0)">Editar</a>
                                                    <a class="dropdown-item btn_archivo_descargar" href="/download_archivo/${iterator.id_archivo}">Descargar</a>
                                                    <a class="dropdown-item btn_archivo_eliminar" href="javascript:void(0)">Eliminar</a>
                                                </div>
                                            </div>
                                    </div>`;

                            }

                            $('#contenedor_listar_reportes').html(`${reportes_html}`);
                }else{
                    $('#contenedor_listar_reportes').html(`
                        <div class="col-sm-12 d-flex justify-content-center align-items-center" style="margin-top: 50px; font-size:20px;">
                                    No se encontrarón registros
                        </div>`);
                }
            }
            $('#click_views').click();
            $("html,body").animate({ scrollTop: 0 }, 600);

        }).fail(function(jqXHR,textStatus) {

             console.error(jqXHR.responseJSON);
             ajax_fails(jqXHR.status,textStatus,jqXHR.responseText,jqXHR.responseJSON.message);

         })


    }

    getFormatos();

    $(document).on('click','.btn_archivo_editar',function(){
        $('.msg_error_conte_upload_file').html('');
        let id_archivo=$(this).parents('.contenedor_file_item_').data('id');
        console.log(array_archivosDb);
        console.log(id_archivo)
        let data=BuscarRegistro(id_archivo);

        if(data.length>0){
            console.log(data);

            let datos_tipo_archivo=JSON.parse(data[0].datos_tipo_archivo);
            $('#title_modal_upload_file').html('Actualizar Archivo');
            $('#semestre_escolar').val(datos_tipo_archivo.semestre)
            $('#carrera_escolar').val(datos_tipo_archivo.carrera);
            $('#periodo_escolar').val(datos_tipo_archivo.periodo);
            $('#turno_escolar').val(datos_tipo_archivo.turno);
            $('#grupo_escolar').val(datos_tipo_archivo.grupo);
            $('#conte_nombre_archivo_original_edit').html(` <span class="badge badge-pill badge-info">Archivo Actual: ${datos_tipo_archivo.nombre_archivo}</span>`).css({'display':''});

            $('#titulo_archivo_input').val(data[0].titulo);
            $('#archivo_descripcion_textarea').val(data[0].descripcion);
            $('#archivo_file_input').val('');

            $('#id_archivo').val(data[0].id_archivo);


            $('#btn_upload_file_modal').html('Actualizar Archivo');
            $('#modal_upload_file').modal('show');
        }
    });


    let listIdArchivos=[];

    $(document).on('click','.btn_archivo_selected_archivos',function(){

        let id_archivo=$(this).parents('.contenedor_file_item_').data('id');
        if($(this).is(':checked')){
                let id_search=listIdArchivos.find((list) => {
                    return list==id_archivo
                })
                if(id_search==undefined){
                    listIdArchivos.push(id_archivo);
                    // console.log(listIdArchivos);
                }

        }else{
             listIdArchivos=listIdArchivos.filter((list) => list!=id_archivo);
            // console.log(new_lista);

        }
    });

    $(document).on('click','.seleccion_multiples_archivos_delete',function(e){
        e.preventDefault();
        if(!(listIdArchivos.length>0)){
            console.log("No tienes elementos seleccionados para eliminación multiples");
            return false;

        }
        let formData_archivo={
            'id_archivo':listIdArchivos,
            'multiples':true
        };

        let this_element=$(this);
        DeleteArchivos(formData_archivo,this_element);

    });

    $(document).on('click','.btn_archivo_eliminar',function(){
        let id_archivo=$(this).parents('.contenedor_file_item_').data('id');
        let this_element=$(this);
        let formData_archivo={'id_archivo':id_archivo};

        DeleteArchivos(formData_archivo,this_element);
    });


    function DeleteArchivos(formData_archivo,this_element){
        let this_element_texto=$(this_element).html();

        $.ajax(
        {
          url :'/DeleteArchivo',
          type:'POST',
          headers:{"X-CSRF-Token": csrf_token},
          data :formData_archivo,
          beforeSend:function(){
             $(this_element).html('<i class="fas fa-sync fa-spin"></i> Cargando.......').attr('disabled','disabled');
            }
        })
        .done(function(respuesta) {
            //console.log(respuesta)
            var json=JSON.parse(respuesta);
            console.log(json);

            if(json.status=="400"){

                $('.msg_error_conte_upload_file_DELETE').html(`<div class='alert alert-danger alert-dismissible fade show'>${json.info}  ${btn_close_Alert}</div>`);
            }
            if(json.status=="200"){
                    if(json.multiples==true){
                        $(this_element).html(this_element_texto).removeAttr('disabled');
                    }
                    $('.msg_error_conte_upload_file_DELETE').html(`<div class='alert alert-success alert-dismissible fade show'>${json.info} ${btn_close_Alert}</div>`);
                    getFormatos();
            }
            $("html, #modal_upload_file").animate({ scrollTop: 0 }, 600);

        }).fail(function(jqXHR,textStatus) {
            console.error(jqXHR.responseJSON);
             ajax_fails(jqXHR.status,textStatus,jqXHR.responseText,jqXHR.responseJSON.message);
             $(this_element).html(this_element_texto).removeAttr('disabled');
         })
    }




    function BuscarRegistro(id){

        let data=[];
        for (let index = 0; index < array_archivosDb.length; index++) {
            if(id==array_archivosDb[index]['id_archivo']){
                data.push(array_archivosDb[index]);
                break;
            }
        }
        return data;
    }

    // register

    // button que abre el modal y inicializa todos los campos
    $('#btn_open_upload_file').on('click',function(){

        $('#title_modal_upload_file').html('Nuevo Reporte');
        $('#semestre_escolar').val(0);
        $('#carrera_escolar').val(0);
        $('#periodo_escolar').val(0);
        $('#turno_escolar').val(0);
        $('#grupo_escolar').val(0);
        $('#id_archivo').val('');

        $('#titulo_archivo_input').val("");
        $('#archivo_descripcion_textarea').val("");
        $('#archivo_file_input').val("");
        $('#conte_nombre_archivo_original_edit').html('').css({'display':'none'});
        $('#btn_upload_file_modal').html('Subir Archivo');

        $('.msg_error_conte_upload_file').html('');
        $('#modal_upload_file').modal('show');

    });


    // button que sube el archivo
    $('#btn_upload_file_modal').on('click',function(){

        $('.msg_error_conte_upload_file').html('');

        let semestre_escolar= $('#semestre_escolar option:selected').val();
        let carrera_escolar= $('#carrera_escolar option:selected').val();
        let periodo_escolar= $('#periodo_escolar option:selected').val();
        let turno_escolar= $('#turno_escolar option:selected').val();
        let grupo_escolar= $('#grupo_escolar option:selected').val();
        let id_archivo=$('#id_archivo').val();


        let titulo_archivo_input= $('#titulo_archivo_input').val();
        let archivo_descripcion_textarea= $('#archivo_descripcion_textarea').val();
        let archivo_file_input= $('#archivo_file_input').val();

        let msg="";

        if(titulo_archivo_input.length<10){
            msg+=`<li><strong>EL TITULO DEBE TENER COMO MINIMO 10 CARACTERES.</strong></li>`;
        }
        if(archivo_descripcion_textarea.length<10){
            msg+=`<li><strong>LA DESCRIPCIÓN DEBE TENER COMO MINIMO 10 CARACTERES.</strong></li>`;
        }

        if(semestre_escolar==0||semestre_escolar==null)
            msg+=`<li>DEBES SELECIONAR SEMESTRE</li>`;

        if(carrera_escolar==0||carrera_escolar==null)
            msg+=`<li>DEBES SELECIONAR CARRERA</li>`;
        if(periodo_escolar==0||periodo_escolar==null)
            msg+=`<li>DEBES SELECIONAR EL PERIODO ESCOLAR</li>`;
        if(turno_escolar==0||turno_escolar==null)
            msg+=`<li>DEBES SELECIONAR EL TURNO</li>`;
        if(grupo_escolar==0||grupo_escolar==null)
            msg+=`<li>DEBES SELECIONAR EL GRUPO</li>`;

        if(titulo_archivo_input=="")
            msg+=`<li>DEBES INGRESAR EL TITULO DEL ARCHIVO.</li>`;
        if(archivo_descripcion_textarea=="")
            msg+=`<li>DEBES INGRESAR LA DESCRIPCIÓN DEL ARCHIVO.</li>`;


        if(id_archivo==""){
            if(archivo_file_input==""){
                msg+=`<li>NO HAS SELECCIONADO EL ARCHIVO.</li>`;
            }
        }

        if(msg!=""){
            $('.msg_error_conte_upload_file').html(`
                <div class="alert alert-warning alert-dismissible fade show mt-4" role="alert">
                ${msg}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            `);
         return false;
        }


        let formData_archivo=new FormData();

        formData_archivo.append('semestre',semestre_escolar);
        formData_archivo.append('carrera_escolar',carrera_escolar);
        formData_archivo.append('periodo_escolar',periodo_escolar);
        formData_archivo.append('turno_escolar',turno_escolar);
        formData_archivo.append('grupo_escolar',grupo_escolar);

        formData_archivo.append('titulo',titulo_archivo_input);
        formData_archivo.append('descripcion',archivo_descripcion_textarea);
        formData_archivo.append('archivo_file_input',$('#archivo_file_input')[0].files[0]);
        formData_archivo.append('id_archivo',id_archivo);

        let this_element=$(this);

        uploadFile(formData_archivo,this_element);


    });


    function uploadFile(formData_archivo,this_element){


        let this_element_texto=$(this_element).html();
        $.ajax(
        {
          url :'/subirReporte',
          type:'POST',
          headers:{"X-CSRF-Token": csrf_token},
          data :formData_archivo,
          processData: false,
          contentType: false,
          beforeSend:function(){
             $(this_element).html('<i class="fas fa-sync fa-spin"></i> Cargando.......').attr('disabled','disabled');
            }

        })
        .done(function(respuesta) {
            //console.log(respuesta)
            var json=JSON.parse(respuesta);
            console.log(json);

            if(json.status=="400"){

                $('.msg_error_conte_upload_file').html(`<div class='alert alert-danger alert-dismissible fade show'>${json.info}  ${btn_close_Alert}</div>`);
            }
            if(json.status=="200"){
                    $('.msg_error_conte_upload_file').html(`<div class='alert alert-success alert-dismissible fade show'>${json.info} ${btn_close_Alert}</div>`);

                    if(json.storage_archivo){
                        $('#semestre_escolar').val(0);
                        $('#carrera_escolar').val(0);
                        $('#periodo_escolar').val(0);
                        $('#turno_escolar').val(0);
                        $('#grupo_escolar').val(0);
                        $('#titulo_archivo_input').val("");
                        $('#archivo_descripcion_textarea').val("");
                        $('#archivo_file_input').val("");
                    }if(json.update_archivo){
                        $('#conte_nombre_archivo_original_edit').html(` <span class="badge badge-pill badge-info">Archivo Actual: ${json.name_file}</span>`).css({'display':''});
                    }
                    getFormatos();
            }
            $(this_element).html(this_element_texto).removeAttr('disabled');
            $("html, #modal_upload_file").animate({ scrollTop: 0 }, 600);

        }).fail(function(jqXHR,textStatus) {
            console.error(jqXHR.responseJSON);
             ajax_fails(jqXHR.status,textStatus,jqXHR.responseText,jqXHR.responseJSON.message);
             $(this_element).html(this_element_texto).removeAttr('disabled');
         })
    }



    $('.file_usuario_image_search').on('change', function() {
        $('.msg_error_conte_upload_file').html('');
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
        var ext = ['xlsx','xls','pdf','docx','doc'];
        var name = file_input.name.split('.').pop().toLocaleLowerCase();
        var archivo_permitidos="";
        //1 kilobyte multiplica el valor de tamaño de datos por 1000

        // peso permitido 2 MEGABYTE
        var list_errors="";

        var MEGABYTE_permitidos=10*1024;

        if(siezekiloByte>MEGABYTE_permitidos){
            var megaByte=(siezekiloByte/1024).toFixed();

            list_errors+=`<li>El archivo supera el limite <trong>(${megaByte}) MB</trong> permitido <strong>${MEGABYTE_permitidos/1024}  MB</strong></li>`;
        }

        if (ext.indexOf(name) == -1) {
            archivo_permitidos = ext.toString().toUpperCase();
            list_errors+=`<li>Archivos permitidos ${archivo_permitidos}</li>`;
        }

        if(list_errors!=""){
            $('.msg_error_conte_upload_file').html(`
                    <div class="alert alert-warning alert-dismissible fade show mt-4" role="alert">
                    ${list_errors}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            `);

            $('.file_usuario_image_search').val("");
            return false;
        }

    });
    // section

    $(function() {

        // Checkboxes
        $('.file-manager-container').on('change', '.file-item-checkbox input', function() {
            $(this).parents('.file-item')[this.checked ? 'addClass' : 'removeClass']('selected');
        });

        // Focus

        $('.file-manager-container').on('focusin', '.file-item', function() {
            $(this).addClass('focused');
        });

        $('.file-manager-container').on('focusout', '.file-item', function() {
            if ($('.file-item-actions.show').length) return;
            $(this).removeClass('focused');
        });

        $('.file-manager-container').on('hide.bs.dropdown', '.file-item-actions', function() {
            if ($(this).parents('.file-item').find(':focus').length) return;
            $(this).parents('.file-item').removeClass('focused');
        });

        // Change view

        $('[name="file-manager-view"]').on('change', function() {
            $('.file-manager-container')
                .removeClass('file-manager-col-view file-manager-row-view')
                .addClass(this.value);
        });

        // RTL
        if ($('html').attr('dir') === 'rtl') {
            $('.file-manager-actions .dropdown-menu').addClass('dropdown-menu-right');
            $('.file-item-actions .dropdown-menu').removeClass('dropdown-menu-right');
        }

    });
</script>
@endsection
