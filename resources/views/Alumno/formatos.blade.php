
@extends('layouts.body')
@section('css')


    <link rel="stylesheet" href="{{asset('dashboard_assets/css/pages/file-manager.css')}}">
@endsection

@section('contenido_page')
<div class="layout-content">
    <!-- [ content ] Start -->
    <div class="container-fluid flex-grow-1 container-p-y">
        <h4 class="display-4" style="color: #B16A26">Lista de Formatos</h4>
        <div class="text-muted small mt-0 mb-4 d-block breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active">Formatos</li>
            </ol>
        </div>
        <div class="row" style="padding: 10px; background-color:white">
            <div class="col-sm-12">
                <!-- Content -->
                <div class="container-fluid flex-grow-1 container-p-y">

                    <div class="bg-lightest container-m--x container-m--y mb-3">
                        <hr class="m-0">
                        <div class="col-sm-12 msg_error_conte_upload_file_DELETE">

                        </div>
                        <div class="file-manager-actions container-p-x py-2">
                                {{-- col --}}
                                <div>

                                    {{-- <button type="button" class="btn btn-secondary mr-2" disabled>
                                        <i class="ion ion-md-cloud-download"></i>
                                    </button> --}}
                                    {{-- <div class="btn-group mr-2">
                                        <button type="button" class="btn btn-default md-btn-flat dropdown-toggle px-2" data-toggle="dropdown">
                                            <i class="ion ion-ios-settings"></i>Opción
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="javascript:void(0)">Move</a>
                                            <a class="dropdown-item" href="javascript:void(0)">Copy</a>
                                            <a class="dropdown-item seleccion_multiples_archivos_delete" href="javascript:void(0)">Eliminar Archivos</a>
                                        </div>
                                    </div> --}}
                                </div>
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

                    <div class="file-manager-container file-manager-col-view" id="contenedor_listar_formatos" >
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
                              <h5 class="modal-title" id="title_modal_upload_file">Formato</h5>
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
                                  <div class="col-sm-12 form-group" style="display: none">
                                        <label for="archivo_dirigido_selected" class="col-form-label">Dirigido</label>
                                        <select name="" id="archivo_dirigido_selected" class="custom-select" disabled>
                                            <option value="0" selected disabled>seleccione una opción</option>
                                            <option value="1">Alumno</option>
                                            <option value="2" selected>Tutores</option>
                                        </select>
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
                                    <textarea name="" id="archivo_descripcion_textarea" cols="5" rows="5" class="form-control" disabled></textarea>
                                 </div>
                                 {{-- col --}}
                                 <div class="col-sm-12" style="none" id="conte_nombre_archivo_original_edit">
                                    {{-- <span class="badge badge-pill badge-success">Success</span> --}}
                                </div>
                                 {{-- col --}}

                                 {{-- <div class="col-sm-12 form-group">
                                    <label for="archivo_file_input" class="col-form-label">Archivo</label>
                                    <input type="file" id="archivo_file_input" class="form-control file_usuario_image_search">
                                    <input type="hidden" id="id_archivo" style="opacity: 0;">
                                 </div> --}}

                                 {{-- <input type="text" id="action_modal_upload" class="form-control"> --}}
                                 {{-- col --}}
                              </div>
                            </div>
                            <div class="modal-footer">
                              {{-- <button type="button" class="btn btn-primary" id="btn_upload_file_modal">
                                  <i class="ion ion-md-cloud-upload"></i>&nbsp;  Subir Archivo
                              </button> --}}
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



<script>
      var btn_close_Alert=` <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>`;

    // obtener todos los formatos
    var array_archivosDb=[];
    function getFormatosAlumnos(){
        array_archivosDb=[];
        $.ajax(
        {
          url :'/formatosAlumnos/formatos',
          type:'POST',
          headers:{"X-CSRF-Token": csrf_token},
          data :{},
          beforeSend:function(){
            $('#contenedor_listar_formatos').html(`
                 <div class="col-sm-12 d-flex justify-content-center align-items-center" style="margin-top: 50px; font-size:20px;">
                            <i class="fas fa-sync fa-spin"></i>&nbsp;&nbsp;&nbsp;Cargando.......
                </div>`).attr('disabled','disabled');
            }
        })
        .done(function(respuesta) {
            // console.log(respuesta)
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
                                                    <a class="dropdown-item btn_archivo_descargar" href="/formatosAlumnos/formatos/downloadFormato/${iterator.id_archivo}">Descargar</a>
                                                </div>
                                            </div>
                                    </div>`;

                            }

                            $('#contenedor_listar_formatos').html(`${reportes_html}`);
                }else{
                             $('#contenedor_listar_formatos').html(`
                                <div class="col-sm-12 d-flex justify-content-center align-items-center" style="margin-top: 50px; font-size:20px;">
                                            No se encontrarón registros
                                </div>`);
                }

                $('#click_views').click();

            }

            $("html,body").animate({ scrollTop: 0 }, 600);

        }).fail(function(jqXHR,textStatus) {

             console.error(jqXHR.responseJSON);
             ajax_fails(jqXHR.status,textStatus,jqXHR.responseText,jqXHR.responseJSON.message);

         })


    }

    getFormatosAlumnos();

    // section
    $(document).on('click','.btn_archivo_editar',function(){
        $('.msg_error_conte_upload_file').html('');
        let id_archivo=$(this).parents('.contenedor_file_item_').data('id');
        console.log(array_archivosDb);
        console.log(id_archivo)
        let data=BuscarRegistro(id_archivo);

        if(data.length>0){
            console.log(data);
            let datos_tipo_archivo=JSON.parse(data[0].datos_tipo_archivo);
            // $('#title_modal_upload_file').html('Actualizar Formato');
            $('#fecha_creacion').html(`<span class="badge badge-pill badge-default">${data[0].fecha_created_archivo}</span>`);
            $('#archivo_dirigido_selected').val(datos_tipo_archivo.archivo_dirigido);
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
