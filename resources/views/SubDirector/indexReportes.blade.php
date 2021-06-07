
@extends('layouts.body')
@section('css')


    <link rel="stylesheet" href="{{asset('dashboard_assets/css/pages/file-manager.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard_assets/libs/select2/select2.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard_assets/libs/bootstrap-select/bootstrap-select.css')}}">
@endsection

@section('contenido_page')
<div class="layout-content">

    <!-- [ content ] Start -->
    <div class="container-fluid flex-grow-1 container-p-y">
        <h4 cclass="display-4" style="color:#B16A26">Lista de reportes</h4>
        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
            <ol class="breadcrumb">
                {{-- <li class="breadcrumb-item"><a href="#"><i class="feather icon-home"></i></a></li>
                <li class="breadcrumb-item"><a href="#">Pages</a></li>
                <li class="breadcrumb-item active">File Manger</li> --}}
                <li class="breadcrumb-item active">Reportes</li>
            </ol>
        </div>
        @if(session('status_confirm'))
                <div class="col-sm-12 conte_confirm_success" style="margin:15px 0px;">
                    <div class="alert alert-success">
                        {{ session('status_confirm') }} <i class="fas fa-grin-stars"></i>
                        </div>
                </div>
        @endif
        <div class="row" style="padding: 10px; background-color:white">
            <div class="col-sm-12 msg_error_conte_upload_file_DELETE">

            </div>
            {{-- col --}}
            <div class="col-sm-12 row">
                <div class="col-sm-12">
                    <h4 class="display-4">Filtros</h4>
                </div>
                <div class="col-sm-6 form-group">
                    <label class="col-form-label label_filter">Carrera <strong class="carreras_select_textError"></strong></label>
                    <select  name="filtro_carrera_escolar" id="filtro_carrera_escolar" class="form-control carreras_select init_selecte_carreras">
                        <option value="0" disabled selected>Seleccione Carrera</option>
                    </select>
                    <small class="text-muted">Seleccione un carrera para obtener los tutores asignados</small>
                 </div>
                <div class="col-sm-6 form-group">
                    <label class="col-form-label label_filter">Lista de tutores   <strong id="conte_init_selecte_tutores" class="text-muted"></strong></label>
                    <select class="form-control init_selecte_tutores" name="" id="init_selecte_tutores" style="width: 100%" data-allow-clear="true">
                        @forelse ($users_tutores as $user)
                        <option value="{{$user->id}}">{{ucwords($user->nombre." ".$user->ap_paterno)}}</option>
                        @empty
                            <option selected disabled ="no_found_selected">No se encontrarón registros</option>
                        @endforelse
                    </select>
                    <div class="error_select_tutor"></div>
                </div>
            </div>
            {{-- col --}}
            <div class="col-sm-12">
                <!-- Content -->
                <div class="container-fluid flex-grow-1 container-p-y">

                    <div class="bg-lightest container-m--x container-m--y mb-3">
                        <hr class="m-0">

                        <div class="file-manager-actions container-p-x py-2">
                                {{-- col --}}
                                {{-- <div>
                                    <button type="button" class="btn btn-primary mr-2" id="btn_open_upload_file">
                                        <i class="ion ion-md-cloud-upload"></i>&nbsp; Nuevo Reporte</button>
                                    <button type="button" class="btn btn-secondary mr-2" disabled>
                                        <i class="ion ion-md-cloud-download"></i>
                                    </button>
                                    <div class="btn-group mr-2">
                                        <button type="button" class="btn btn-default md-btn-flat dropdown-toggle px-2" data-toggle="dropdown">
                                            <i class="ion ion-ios-settings"></i>Opción
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="javascript:void(0)">Move</a>
                                            <a class="dropdown-item" href="javascript:void(0)">Copy</a>
                                            <a class="dropdown-item seleccion_multiples_archivos_delete" href="javascript:void(0)">Eliminar Archivos</a>
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- col --}}
                                <div>
                                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                        <label class="btn btn-default md-btn-flat active">
                                            <input type="radio" name="file-manager-view" value="file-manager-col-view">
                                            <span class="ion ion-md-apps"></span>
                                        </label>
                                        <label class="btn btn-default md-btn-flat">
                                            <input type="radio" name="file-manager-view" value="file-manager-row-view" id="click_views" checked>
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
                              <h5 class="modal-title" id="title_modal_upload_file">Reporte</h5>
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
                                    <label class="col-form-label">Fecha de creación <strong id="fecha_creacion"></strong></label>
                                  </div>
                                 <div class="col-sm-12 form-group">
                                    <label for="titulo_archivo_input" class="col-form-label">Titulo</label>
                                    <input type="text" id="titulo_archivo_input" class="form-control" disabled>
                                 </div>
                                 {{-- col --}}
                                 <div class="col-sm-12 form-group">
                                    <label for="archivo_descripcion_textarea" class="col-form-label">Descripción</label>
                                    <textarea name="" id="archivo_descripcion_textarea" cols="5" rows="3" class="form-control" disabled></textarea>
                                 </div>
                                  {{-- col --}}
                              </div>
                              {{-- row --}}
                              <div class="row form-group">
                                <div class="col-sm-6 form-group">
                                        <label class="form-label">Semestre</label>
                                        <select  name="semestre_escolar" id="semestre_escolar" class="form-control" disabled>
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
                                    <select  name="carrera_escolar" id="carrera_escolar" class="form-control carreras_select" disabled>
                                        <option value="0" disabled selected>Seleccione Carrera</option>
                                    </select>
                                 </div>
                            </div>
                              {{-- col --}}
                              <div class="row form-group">
                                    <div class="col-sm-4 form-group">
                                        <label class="form-label">Periodo {{date('Y')}}</label>
                                        <select class="form-control" name="periodo_escolar" id="periodo_escolar" disabled>
                                            <option value="0" disabled selected>Seleccione Periodo</option>
                                            <option value="FEBRERO-JULIO">FEBRERO-JULIO</option>
                                            <option value="AGOSTO-DICIEMBRE">AGOSTO-DICIEMBRE</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label class="form-label">Turno</label>
                                        <select class="form-control" name="turno_escolar" id="turno_escolar" disabled>
                                            <option value="0" disabled selected>Seleccione Turno</option>
                                            <option value="Matutino">Matutino</option>
                                            <option value="Vespertino">Vespertino</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4 form-group">
                                        <label class="form-label">Grupo</label>
                                        <select class="form-control" name="grupo_escolar" id="grupo_escolar" disabled>
                                            <option value="0" disabled selected>Seleccione Grupo</option>
                                            <option value="A">A</option>
                                            <option value="B">B</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-12" style="none" id="conte_nombre_archivo_original_edit">
                                        {{-- <span class="badge badge-pill badge-success">Success</span> --}}
                                    </div>
                                    {{-- <div class="col-sm-12 form-group">
                                        <label for="archivo_file_input" class="col-form-label">Archivo</label>
                                        <input type="file" id="archivo_file_input" class="form-control file_usuario_image_search">
                                        <input type="hidden" id="id_archivo" style="opacity: 0;">
                                     </div> --}}
                                </div>
                                {{-- row --}}
                              {{-- fin conte_body_modal --}}
                            </div>
                            <div class="modal-footer">
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
<link rel="stylesheet" href="{{asset('dashboard_assets/libs/bootstrap-select/bootstrap-select.css')}}">
<script src="{{asset('dashboard_assets/libs/select2/select2.js')}}"></script>

<script>

var btn_close_Alert=` <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>`;

$('#filtro_carrera_escolar').on('change',function(){

    let id_carrera=$('#filtro_carrera_escolar option:selected').val();
    console.log(id_carrera);

    $.ajax(
        {
          url :`/carrera/tutoresAsignados/${id_carrera}`,
          type:'POST',
          headers:{"X-CSRF-Token": csrf_token},
          data :{},
          beforeSend:function(){

             $('#init_selecte_tutores').attr('disabled','disabled')
             $('#conte_init_selecte_tutores').html('<i class="fas fa-sync fa-spin"></i> Cargando.......');
           }
        })
        .done(function(respuesta) {

            $('#init_selecte_tutores').removeAttr('disabled')
             $('#conte_init_selecte_tutores').html('');

            var json=JSON.parse(respuesta);
            console.log(json);

            if(json.status=="400"){
               $('.msg_error_conte_upload_file_DELETE').html(`<div class='alert alert-danger alert-dismissible fade show'>${json.info} ${btn_close_Alert}</div>`);
            }
            if(json.status=="200"){
                let tutoresOptions="";
                // console.log(json.data.length);

                if(json.data.length>0){
                    tutoresOptions="<option value='0' disabled selected>Seleccione un tutor</option>";
                    for (const iterator of json.data) {
                        tutoresOptions+=`<option value='${iterator.id}'>${iterator.nombre} ${iterator.ap_paterno}</option>`;
                    }
                    $('#init_selecte_tutores').html(tutoresOptions).removeAttr('disabled');
                }else{
                    tutoresOptions="<option value='0' disabled selected style='color:red;'>NO SE ENCONTRARÓN REGISTROS</option>"
                    $('#init_selecte_tutores').html(tutoresOptions).attr('disabled','disabled');
                }
            }
            $("html, body").animate({ scrollTop: 0 }, 600);


        }).fail(function(jqXHR,textStatus) {
            console.error(jqXHR.responseJSON);
             $('#init_selecte_tutores').removeAttr('disabled')
             $('#conte_init_selecte_tutores').html('');

         })

});


$('#init_selecte_tutores').on('change',function(){

    let id_tutor=$('#init_selecte_tutores option:selected').val();
    let formData={
        'action':'obtener_reportes_tutor_seleccionado',
        'id_tutor':id_tutor
    }

    getReportes_Tutores(formData);

})


$('.init_selecte_carreras').each(function() {
    $(this)
    .wrap('<div class="position-relative"></div>')
    .select2({
    placeholder: 'Select value',
    dropdownParent: $(this).parent()
    });
})

$('.init_selecte_tutores').each(function() {
    $(this)
    .wrap('<div class="position-relative"></div>')
    .select2({
    placeholder: 'Select value',
    dropdownParent: $(this).parent()
    });
})





    // obtener reportes

    var array_archivosDb=[];

    function getReportes_Tutores(formData){

        array_archivosDb=[];

        $.ajax(
        {
          url :'/subdirector/reportes_enviados/list',
          type:'POST',
          headers:{"X-CSRF-Token": csrf_token},
          data :formData,
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
                                            <div class="file-item-icon far fa-folder text-secondary"></div>
                                            <a href="javascript:void(0)" class="file-item-name">
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
                                                    <a class="dropdown-item btn_archivo_descargar" href="/downloadFormato/${iterator.id_archivo}">Descargar</a>
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

    getReportes_Tutores({'action':'todos_reportes'});

    $(document).on('click','.btn_archivo_editar',function(){
        $('.msg_error_conte_upload_file').html('');
        let id_archivo=$(this).parents('.contenedor_file_item_').data('id');
        console.log(array_archivosDb);
        console.log(id_archivo)
        let data=BuscarRegistro(id_archivo);

        if(data.length>0){
            console.log(data);

            let datos_tipo_archivo=JSON.parse(data[0].datos_tipo_archivo);
            $('#fecha_creacion').html(`<span class="badge badge-pill badge-default">${data[0].fecha_created_archivo}</span>`);

            $('#semestre_escolar').val(datos_tipo_archivo.semestre)
            $('#carrera_escolar').val(datos_tipo_archivo.carrera).attr('disabled','disabled');
            $('#periodo_escolar').val(datos_tipo_archivo.periodo);
            $('#turno_escolar').val(datos_tipo_archivo.turno);
            $('#grupo_escolar').val(datos_tipo_archivo.grupo);
            $('#conte_nombre_archivo_original_edit').html(` <span class="badge badge-pill badge-info">Archivo Actual: ${datos_tipo_archivo.nombre_archivo}</span>`).css({'display':''});

            $('#titulo_archivo_input').val(data[0].titulo);
            $('#archivo_descripcion_textarea').val(data[0].descripcion);
            $('#archivo_file_input').val('');

            $('#id_archivo').val(data[0].id_archivo);
            $('#modal_upload_file').modal('show');
        }
    });

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
