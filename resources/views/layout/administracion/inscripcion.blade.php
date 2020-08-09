@extends('layout.main')
@section('content')

<div id="content">
	<div class="outer">
		<div class="inner bg-light lter">
			<div class="row" data-bind="visible: model.inscripcionController.gridMode()">
				 <div class="col-lg-12">
			        <div class="box">
			            <header>
			                <div class="icons"><i class="fa fa-table"></i></div>
			                <h4 class="title">&nbsp; Inscripciones <button class="text-right btn btn-success btn-sm" data-bind="click: model.inscripcionController.nuevo"> <i class="fa fa-plus-square-o"></i> Nuevo</button></h4>
			            </header>
			            <div id="collapse4" class="body">
			                <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
			                    <thead>
			                    <tr>
			                        <th>alumno</th>
			                        <th>ciclo escolar</th>
			                        <th>Aciones</th>
			                    </tr>
			                    </thead>
			                    <tbody data-bind="dataTablesForEach : {
                                                    data: model.inscripcionController.inscripcions,
                                                    options: dataTableOptions
                                                  }">
                                    <tr>
                                        <td data-bind="text: alumno.primer_nombre+' '+alumno.primer_apellido"></td>
                                        <td data-bind="text: ciclo.ciclo"></td>
                                        <td width="10%">
                                            <a href="#" class="btn btn-warning btn-xs" data-bind="click: model.inscripcionController.editar" data-toggle="tooltip" title="editar"><i class="fa fa-pencil-square-o"></i></a>

                                            <a href="#" class="btn btn-danger btn-xs" data-bind="click: model.inscripcionController.destroy" data-toggle="tooltip" title="eliminar"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                </tbody>              
			                 </table>
			            </div>
			        </div>
			    </div>
			</div>
			<div class="row" data-bind="visible: model.inscripcionController.insertMode()">
				<div class="col-lg-12 col-md-12 col-sm-12">
				    <div class="box dark">
				        <header>
				            <div class="icons"><i data-bind="visible:!model.inscripcionController.editMode()" class="fa fa-plus"></i>
				            	<i data-bind="visible:model.inscripcionController.editMode()" class="fa fa-edit"></i></div>
				            <h5 data-bind="visible:!model.inscripcionController.editMode()"> Nuevo Registro</h5> 
				            <h5 data-bind="visible:model.inscripcionController.editMode()"> Editar Registro</h5>          <!-- /.toolbar -->
				        </header>
				        <div class="body">
				            <form id="formulario" class="form-horizontal" data-bind="with: model.inscripcionController.inscripcion">
				                <div class="form-group">
				                    <div class="col-lg-6 col-md-6 col-sm-12">
				                   		<label for="text2">Alumno</label>
				                      	<select class="form-control" id="alumno_id" data-bind="options: model.inscripcionController.alumnos, optionsText: function(a) {return a.id+' / '+a.primer_nombre+' '+a.primer_apellido}, optionsValue: 'id',
					                       optionsCaption: '--seleccione alumno--',
					                       value: alumno_id" 
					                       data-error=".errorA"
						                    required></select>
					                    <span class="errorA text-danger help-inline"></span>
				                    </div>
				                    <div class="col-lg-6 col-md-6 col-sm-12">
				                   		<label for="text2">Ciclo escolar</label>
				                      	<select class="form-control" id="ciclo_id" data-bind="options: model.inscripcionController.ciclos, optionsText: 'ciclo', optionsValue: 'id',
					                       optionsCaption: '--seleccione ciclo escolar--',
					                       value: ciclo_id" 
					                       data-error=".errorC"
						                    required></select>
					                    <span class="errorC text-danger help-inline"></span>
				                    </div>
				                </div>
				                <div class="form-group">
				                	
				                    <div class="col-lg-8 col-md-8 col-sm-12">
				                   		<label for="inst">Institución Educativa</label>
				                      	<select class="form-control" id="instituciones_educativa_id" data-bind="options: model.inscripcionController.instituciones, optionsText: 'nombre', optionsValue: 'id',
					                       optionsCaption: '--seleccione institucion educativa--',
					                       value: instituciones_educativa_id" 
					                       data-error=".errorI"
						                    required></select>
					                    <span class="errorI text-danger help-inline"></span>
				                    </div>
				                    <div class="col-lg-4">
				                    <label for="text2">Fecha inscripción</label>
				                        <input type="date" id="fecha" name="fecja" placeholder="ingrese fecha" class="form-control"data-bind="value: fecha"
					                           data-error=".fecha" required>
					                    <span class="fecha text-danger help-inline"></span>
				                    </div>
				                </div>
				                <div class="form-group">
				                	<label for="text2">Asignar cursos</label>
				                    <div class="col-lg-12 col-md-12 col-sm-12">
				                   		

				                   		<!-- ko foreach: {data: model.inscripcionController.cursos, as: 'c'} -->
		                                  <div class="col-sm-4 col-md-4">
		                                      <div class="checkbox">
		                                          <label>
		                                              <input type="checkbox" value="" data-bind="value: c.id, checked: model.inscripcionController.inscripcion.cursos()"><span data-bind="text: c.nombre"></span>
		                                          </label>
		                                      </div>
		                                  </div>
		                                  <!-- /ko -->
				                    </div>
				                </div>
				                <div class="form-group">
				                	<div class="col-md-12 text-right">					           
				                		<a class="btn btn-primary btn-sm" data-bind="click:  model.inscripcionController.createOrEdit"><i class="fa fa-save"></i> Guardar</a>
					                	<a class="btn btn-danger btn-sm" data-bind="click: model.inscripcionController.cancelar"><i class="fa fa-undo"></i> Cancelar</a>
				                	</div>
				                </div>
				            </form>
				        </div>
				    </div>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
        $(document).ready(function () {
            model.inscripcionController.initialize();
        });
</script>
@endsection
