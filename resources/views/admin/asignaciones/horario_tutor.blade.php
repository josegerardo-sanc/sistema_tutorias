<div class="row">
    <div class="col-sm-12">
        <div class="modal" tabindex="-1" role="dialog" id="modal_horario_tutor">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Horario</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <table class="table table-responsive ">
                        <thead>
                            <tr>
                                <th>Lunes <input type="checkbox" class="check_lunes"></th>
                                <th>Marte <input type="checkbox" class="check_martes"></th>
                                <th>Miercoles <input type="checkbox" class="check_miercoles"></th>
                                <th>Jueves <input type="checkbox" class="check_jueves"></th>
                                <th>Viernes <input type="checkbox" class="check_viernes"></th>
                                <th>Horas asignadas.</th>
                            </tr>
                        </thead>
                        <tbody style="width: 100%">
                            <tr>
                                <th colspan="5"><i class="fas fa-clock"></i> Horas</th>
                            </tr>
                            <tr>
                                <td><input type="text" class="form-control input_check_lunes input_keyup_horario validar_numeric_input" maxlength="1" style="border: 1px solid #ddd;  text-align: center;" disabled></td>
                                <td><input type="text" class="form-control input_check_martes input_keyup_horario validar_numeric_input" maxlength="1" style="border: 1px solid #ddd; text-align: center;" disabled></td>
                                <td><input type="text" class="form-control input_check_miercoles input_keyup_horario validar_numeric_input" maxlength="1" style="border: 1px solid #ddd; text-align: center;" disabled></td>
                                <td><input type="text" class="form-control input_check_jueves input_keyup_horario validar_numeric_input" maxlength="1"style="border: 1px solid #ddd; text-align: center;" disabled></td>
                                <td><input type="text" class="form-control input_check_viernes input_keyup_horario validar_numeric_input" maxlength="1" style="border: 1px solid #ddd; text-align: center;" disabled></td>
                                <td>
                                    <input type="text" class="form-control total_hrs_asignadas_tutor" disabled>
                                </td>
                            </tr>
                        </tbody>
                  </table>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary btn_btn_restablecer_horario">Restablecer</button>
                  <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                </div>
              </div>
            </div>
          </div>
    </div>
</div>
