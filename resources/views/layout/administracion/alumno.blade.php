@extends('layout.main')
@section('content')

<div id="content">
	<div class="outer">
		<div class="inner bg-light lter">
			<div class="row" data-bind="visible: model.alumnoController.gridMode()">
				 <div class="col-lg-12">
			        <div class="box">
			            <header>
			                <div class="icons"><i class="fa fa-table"></i></div>
			                <h4 class="title">&nbsp; alumnos <button class="text-right btn btn-success btn-sm" data-bind="click: model.alumnoController.nuevo"> <i class="fa fa-plus-square-o"></i> Nuevo</button></h4>
			            </header>
			            <div id="collapse4" class="body">
			                <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
			                    <thead>
			                    <tr>
			                    	<th>Codigo</th>
			                    	<th>Foto</th>
			                        <th>Nombres</th>
			                        <th>telefono</th>
			                        <th>Dirección</th>
			                        <th>Aciones</th>
			                    </tr>
			                    </thead>
			                    <tbody data-bind="dataTablesForEach : {
                                                    data: model.alumnoController.alumnos,
                                                    options: dataTableOptions
                                                  }">
                                    <tr>
                                    	<td data-bind="text: id"></td>
                                    	<td><img class="bgimage img-responsive" style=" height:90px;" data-bind="attr:{src: (foto !== null && foto !== '' ? '/img/'+foto : emptyLogo)}" /></td>
                                        <td data-bind="text: primer_nombre"></td>
                                        <td data-bind="text: telefono"></td>
                                     
                                        <td data-bind="text: direccion+' '+municipio.nombre+', '+municipio.departamento.nombre"></td>
                                        <td width="10%">
                                            <a href="#" class="btn btn-warning btn-xs" data-bind="click: model.alumnoController.editar" data-toggle="tooltip" title="editar"><i class="fa fa-pencil-square-o"></i></a>

                                            <a href="#" class="btn btn-danger btn-xs" data-bind="click: model.alumnoController.destroy" data-toggle="tooltip" title="eliminar"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                </tbody>              
			                 </table>
			            </div>
			        </div>
			    </div>
			</div>
			<div class="row" data-bind="visible: model.alumnoController.insertMode()">
				<div class="col-lg-12 col-md-12 col-sm-12">
				    <div class="box dark">
				        <header>
				            <div class="icons"><i data-bind="visible:!model.alumnoController.editMode()" class="fa fa-plus"></i>
				            	<i data-bind="visible:model.alumnoController.editMode()" class="fa fa-edit"></i></div>
				            <h5 data-bind="visible:!model.alumnoController.editMode()"> Nuevo Registro</h5> 
				            <h5 data-bind="visible:model.alumnoController.editMode()"> Editar Registro</h5>          <!-- /.toolbar -->
				        </header>
				        <div class="body">


				        	<form id="formulario" class="form-horizontal" data-bind="with: model.alumnoController.alumno">
				            	<div class="col-lg-12">
				            		
					            	<div class="form-group row">
						            	<div class="col-lg-4 col-md-4">
							            	<label for="foto">Foto</label>
							            	<input type="file" id="foto" name="foto" placeholder="seleccione foto" class="form-control" data-bind="event:{ change: model.alumnoController.PreviewAvatar}"><br />
							            	<div class="fileinput-preview thumbnail" alt="arches">
							            		<img class="img-responsive" data-bind="attr:{src: (foto() !== null ? ( foto() !== '' ? '/img/'+foto() : emptyLogo ) : emptyLogo)}" id="previewFoto" src="#" alt="fotografia" style="height: 200px; width: 80%"/>
							            	</div>
						            	</div>

						                    <div class="col-lg-4">
						                    <label for="text2">Primer Nombre</label>
						                        <input type="text" id="primer_nombre" name="primer_nombre" placeholder="ingrese primer nombre" class="form-control"data-bind="value: primer_nombre"
							                           data-error=".primer_nombre"
							                           minlength="3" maxlength="25" required>
							                    <span class="primer_nombre text-danger help-inline"></span>
						                    </div>

						                    <div class="col-lg-4">
						                    <label for="text2">Segundo Nombre</label>
						                        <input type="text" id="segundo_nombre" name="segundo_nombre" placeholder="ingrese segundo nombre" class="form-control"data-bind="value: segundo_nombre"
							                           data-error=".segundo_nombre"
							                           minlength="3" maxlength="25">
							                    <span class="segundo_nombre text-danger help-inline"></span>
						                    </div>

							                    <div class="col-lg-4">
							                    <label for="text2">Primer Apellido</label>
							                        <input type="text" id="primer_apellido" name="primer_nombre" placeholder="ingrese primer apellido" class="form-control"data-bind="value: primer_apellido"
								                           data-error=".primer_apellido"
								                           minlength="3" maxlength="25" required>
								                    <span class="primer_apellido text-danger help-inline"></span>
							                    </div>

							                    <div class="col-lg-4">
							                    <label for="text2">Segundo Apellido</label>
							                        <input type="text" id="segundo_apellido" name="segundo_apellido" placeholder="ingrese segundo nombre" class="form-control"data-bind="value: segundo_apellido"
								                           data-error=".segundo_apellido"
								                           minlength="3" maxlength="25">
								                    <span class="segundo_apellido text-danger help-inline"></span>
							                    </div>

								                <div class="">

								                	<div class="col-lg-4 col-md-6 col-sm-12">
								                    <label for="text2">Fecha nacimiento</label>
								                        <input type="date" id="fecha_nac" name="fecha_nac" placeholder="ingrese fecha nac" class="form-control"data-bind="value: fecha_nac"
									                           data-error=".fecha_nac" required>
									                    <span class="fecha_nac text-danger help-inline"></span>
								                    </div>

								                    <div class="col-lg-4 col-md-4 col-sm-12">
								                    <label for="text2">Encargado</label>
								                       <select class="form-control" id="encargado_id" data-bind="options: model.alumnoController.encargados, optionsText: function(e) {return e.cui+' / '+e.primer_nombre+' '+e.primer_apellido}, optionsValue: 'id',
									                       optionsCaption: '--seleccione encargado--',
									                       value: encargado_id" 
									                       data-error=".errorRep"
										                    required></select>
									                    <span class="errorRep text-danger help-inline"></span>
								                    </div>
								                    <div class="col-lg-4 col-md-4 col-sm-12">
								                    <label for="text2">Tipo de encargado</label>
								                       <select class="form-control" id="tipo" data-bind="options: model.alumnoController.tipos, 
								                       optionsText: 'text', optionsValue: 'value',
								                       optionsCaption: '--seleccione--',
								                       value: tipo_encargado"></select>
								                    </div>
								                </div>

								                <div class="">
								                    <div class="col-lg-4 col-md-4 col-sm-12">
								                    <label for="text2">Departamento</label>
								                       <select class="form-control" id="departamento" data-bind="options: model.alumnoController.departamentos, 
								                       optionsText: 'nombre', optionsValue: 'municipios',
								                       optionsCaption: '--seleccione--',
								                       value: model.alumnoController.municipios"></select>
								                    </div>

								                    <div class="col-lg-4 col-md-4 col-sm-12">
								                    <label for="text2">Municipio</label>
								                       <select class="form-control" id="municipio" data-bind="options: model.alumnoController.municipios, 
								                       optionsText: 'nombre', optionsValue: 'id',
								                       optionsCaption: '--seleccione--',
								                       value: municipio_id" 
								                       data-error=".erroMun"
									                    required></select>
									                    <span class="erroMun text-danger help-inline"></span>
								                    </div>
								                    <div class="col-lg-4">
								                    <label for="text2">Telefono</label>
								                        <input type="number" id="telefono" name="telefono" placeholder="ingrese telefono" class="form-control"data-bind="value: telefono"
									                           data-error=".errorT"
									                           minlength="6" maxlength="25">
									                    <span class="errorT text-danger help-inline"></span>
								                    </div>
								                </div>

					            	</div>


								                 <div class="form-group">
								                 	
								                    <div class="col-lg-8">
								                    <label for="text2">Dirección especifica</label>
								                        <input type="text" id="direccion" name="direccion" placeholder="ingrese dirección especifica" class="form-control"data-bind="value: direccion"
									                           data-error=".erorDir"
									                           minlength="3" maxlength="255" required>
									                    <span class="erorDir text-danger help-inline"></span>
								                    </div>
								                </div>

				            	</div>

				            	
				                <div class="form-group">
				                	<div class="col-md-12 text-right">					           
				                		<a class="btn btn-primary btn-sm" data-bind="click:  model.alumnoController.createOrEdit"><i class="fa fa-save"></i> Guardar</a>
					                	<a class="btn btn-danger btn-sm" data-bind="click: model.alumnoController.cancelar"><i class="fa fa-undo"></i> Cancelar</a>
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
            model.alumnoController.initialize();
        });
</script>
@endsection
