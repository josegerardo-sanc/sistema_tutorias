<div class="modal" tabindex="-1" role="dialog" id="modal_preregistroUsuario">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">PreRegistro</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row form-group">
                <div class="col-sm-4 form-group">
                    <label class="form-label">Nombre Completo</label>
                    <input name="pre_nombre_completo" id="pre_nombre_completo" type="text" class="form-control mb-1" value="jose gerardo" maxlength="20">
                </div>
                <div class="col-sm-4 form-group">
                    <label class="form-label">Apellido Paterno</label>
                    <input name="pre_ap_paterno" id="pre_ap_paterno" type="text" class="form-control" value="sanchez" maxlength="15">
                </div>
                <div class="col-sm-4 form-group">
                    <label class="form-label">Apellido Materno</label>
                    <input name="pre_ap_materno" id="pre_ap_materno" type="text" class="form-control mb-1" value="alvarado" maxlength="15">
                </div>
                <div class="col-sm-12 form-group">
                    <label for="" class="col-form-label">Correo</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                        </div>
                        <input name="pre_correo_usuario" id="pre_correo_usuario" type="text" class="form-control"  aria-describedby="basic-addon1">
                    </div>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-sm-12 form-group">
                    <label for="" class="col-form-label">Matricula  ||  CedulaProfesional</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text" id="basic-addon1"><i class="fa fa-key" aria-hidden="true"></i></span>
                        </div>
                        <input name="pre_clave_usuario" id="pre_clave_usuario" type="text" class="form-control"  aria-describedby="basic-addon1">
                    </div>
                </div>
            </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary">Enviar</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

          <div class="mt-4">
              <div class="alert alert-danger" role="alert">
                UNA VEZ EL USUARIO HAYGA COMPLETADO EL REGISTRO, SUS DATOS SERAN EVALUADOS
                POR LA PERSONA A CARGO....
              </div>
          </div>
        </div>
      </div>
    </div>
  </div>
