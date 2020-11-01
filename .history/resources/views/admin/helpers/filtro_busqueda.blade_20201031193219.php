<div class="col-sm-12 form-group contenedor_filtro_alumno" style="display:none">
    <form action="#" id="form_filtro_alumno">
        {{ csrf_field() }}
        <div class="row form-group">
            <div class="col-sm-6 form-group">
                    <label class="form-label label_filter">Semestre</label>
                    <select  name="filtro_semestre_escolar" id="filtro_semestre_escolar" class="form-control">
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
                <label class="form-label label_filter">Carrera</label>
                <select  name="filtro_carrera_escolar" id="filtro_carrera_escolar" class="form-control">
                    <option value="0" disabled selected>Seleccione Carrera</option>
                    <option value="informatica">Ing.informática</option>
                    <option value="administracion">Ing.administración</option>
                    <option value="renovable">Ing.renovable</option>
                    <option value="bioquimica">Ing.bioquimíca</option>
                    <option value="electromecanica">Ing.electromecánica </option>
                </select>
             </div>
        </div>

        <div class="row form-group">
            <!-- <div class="col-sm-3 form-group">
                <label class="form-label label_filter">Periodo</label>
                <select class="form-control" name="filtro_periodo_escolar" id="filtro_periodo_escolar">
                    <option value="0" disabled selected>Seleccione Periodo</option>
                    <option value="FEBRERO-JULIO">FEBRERO-JULIO</option>
                    <option value="AGOSTO-DICIEMBRE">AGOSTO-DICIEMBRE</option>
                </select>
            </div> -->
            <div class="col-sm-3 form-group">
                <label class="form-label label_filter">Turno</label>
                <select class="form-control" name="filtro_turno_escolar" id="filtro_turno_escolar">
                    <option value="0" disabled selected>Seleccione Turno</option>
                    <option value="1">Vespertino</option>
                    <option value="2">Matutino</option>
                </select>
            </div>
            <!-- <div class="col-sm-3 form-group">
                <label class="form-label label_filter">Grupo</label>
                <select class="form-control" name="filtro_grupo_escolar" id="filtro_grupo_escolar">
                    <option value="0" disabled selected>Seleccione Grupo</option>
                    <option value="1">A</option>
                    <option value="2">B</option>
                </select>
            </div> -->
            <div class="col-sm-3 form-group conte_referencs_matricula">
                <label class="form-label label_filter">Matricula</label>
                <input type="text" class="form-control matricula_escolar_validar"  placeholder="Matricula" name="filtro_matricula_escolar" id="filtro_matricula_escolar">
                <div class=" contenedor_input_matricula_alumno_index"></div>
            </div>
        </div>
    </form>
</div>


<div class="col-sm-12 form-group contenedor_filtro_docente" style="display:none;">
    <form action="#" id="form_filtro_docente">
        {{ csrf_field() }}
        <div class="row form-group">
            <div class="col-sm-3 form-group">
                <label class="form-label label_filter">Cedula Profesional</label>
                <input type="text" class="form-control" name="filtro_cedulaProfesional" id="filtro_cedulaProfesional">
            </div>
        </div>
    </form>
</div>

<div clas="col-sm-12" style="color:rgb(2, 15, 129)">
    <i class="fab fa-angellist"></i>
    <small>Si usted requiere un consulta mas precisa, vaya completando los campos</small>
</div>



