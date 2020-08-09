@extends('layout.main')
@section('content')

<div id="content">
	<div class="outer">
		<div class="inner bg-light lter">
			<div class="row" data-bind="visible: model.encargadoController.gridMode()">
				 <div class="col-lg-12">
			        <div class="box">
			            <header>
			                <div class="icons"><i class="fa fa-table"></i></div>
			                <h4 class="title">&nbsp; encargados <button class="text-right btn btn-success btn-sm" data-bind="click: model.encargadoController.nuevo"> <i class="fa fa-plus-square-o"></i> Nuevo</button></h4>
			            </header>
			            <div id="collapse4" class="body">
			                <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
			                    <thead>
			                    <tr>
			                    	<th>Cui</th>
			                        <th>Nombres</th>
			                        <th>telefono</th>
			                        <th>Dirección</th>
			                        <th>Aciones</th>
			                    </tr>
			                    </thead>
			                    <tbody data-bind="dataTablesForEach : {
                                                    data: model.encargadoController.encargados,
                                                    options: dataTableOptions
                                                  }">
                                    <tr>
                                    	<td data-bind="text: cui"></td>
                                        <td data-bind="text: primer_nombre"></td>
                                        <td data-bind="text: telefono"></td>
                                     
                                        <td data-bind="text: direccion+' '+municipio.nombre+', '+municipio.departamento.nombre"></td>
                                        <td width="10%">
                                            <a href="#" class="btn btn-warning btn-xs" data-bind="click: model.encargadoController.editar" data-toggle="tooltip" title="editar"><i class="fa fa-pencil-square-o"></i></a>

                                            <a href="#" class="btn btn-danger btn-xs" data-bind="click: model.encargadoController.destroy" data-toggle="tooltip" title="eliminar"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                </tbody>              
			                 </table>
			            </div>
			        </div>
			    </div>
			</div>
			<div class="row" data-bind="visible: model.encargadoController.insertMode()">
				<div class="col-lg-12 col-md-12 col-sm-12">
				    <div class="box dark">
				        <header>
				            <div class="icons"><i data-bind="visible:!model.encargadoController.editMode()" class="fa fa-plus"></i>
				            	<i data-bind="visible:model.encargadoController.editMode()" class="fa fa-edit"></i></div>
				            <h5 data-bind="visible:!model.encargadoController.editMode()"> Nuevo Registro</h5> 
				            <h5 data-bind="visible:model.encargadoController.editMode()"> Editar Registro</h5>          <!-- /.toolbar -->
				        </header>
				        <div class="body">
				            <form id="formulario" class="form-horizontal" data-bind="with: model.encargadoController.encargado">

				                <div class="form-group">
				                    <div class="col-lg-6">
				                    <label for="text2">Primer Nombre</label>
				                        <input type="text" id="primer_nombre" name="primer_nombre" placeholder="ingrese primer nombre" class="form-control"data-bind="value: primer_nombre"
					                           data-error=".primer_nombre"
					                           minlength="3" maxlength="25" required>
					                    <span class="primer_nombre text-danger help-inline"></span>
				                    </div>

				                    <div class="col-lg-6">
				                    <label for="text2">Segundo Nombre</label>
				                        <input type="text" id="segundo_nombre" name="segundo_nombre" placeholder="ingrese segundo nombre" class="form-control"data-bind="value: segundo_nombre"
					                           data-error=".segundo_nombre"
					                           minlength="3" maxlength="25">
					                    <span class="segundo_nombre text-danger help-inline"></span>
				                    </div>
				                </div>

				                <div class="form-group">
				                    <div class="col-lg-6">
				                    <label for="text2">Primer Apellido</label>
				                        <input type="text" id="primer_apellido" name="primer_nombre" placeholder="ingrese primer apellido" class="form-control"data-bind="value: primer_apellido"
					                           data-error=".primer_apellido"
					                           minlength="3" maxlength="25" required>
					                    <span class="primer_apellido text-danger help-inline"></span>
				                    </div>

				                    <div class="col-lg-6">
				                    <label for="text2">Segundo Apellido</label>
				                        <input type="text" id="segundo_apellido" name="segundo_apellido" placeholder="ingrese segundo nombre" class="form-control"data-bind="value: segundo_apellido"
					                           data-error=".segundo_apellido"
					                           minlength="3" maxlength="25">
					                    <span class="segundo_apellido text-danger help-inline"></span>
				                    </div>
				                </div>

				                <div class="form-group">
				                    <div class="col-lg-6">
				                    <label for="text2">CUI</label>
				                        <input type="number" id="cui" name="cui" placeholder="ingrese cui" class="form-control"data-bind="value: cui"
					                           data-error=".cui"
					                           minlength="13" maxlength="15" required>
					                    <span class="cui text-danger help-inline"></span>
				                    </div>

				                    <div class="col-lg-6">
				                    <label for="text2">NIT</label>
				                        <input type="number" id="nit" name="nit" placeholder="ingrese nit" class="form-control"data-bind="value: nit"
					                           data-error=".nit"
					                           minlength="7" maxlength="10">
					                    <span class="nit text-danger help-inline"></span>
				                    </div>
				                </div>

				                <div class="form-group">

				                	<div class="col-lg-6 col-md-6 col-sm-12">
				                    <label for="text2">Fecha nacimiento</label>
				                        <input type="date" id="fecha_nac" name="fecha_nac" placeholder="ingrese fecha nac" class="form-control"data-bind="value: fecha_nac"
					                           data-error=".fecha_nac" required>
					                    <span class="fecha_nac text-danger help-inline"></span>
				                    </div>

				                    <div class="col-lg-6 col-md-6 col-sm-12">
				                    <label for="text2">Telefono</label>
				                        <input type="number" id="telefono" name="telefono" placeholder="ingrese telefono" class="form-control"data-bind="value: telefono"
					                           data-error=".errorTelefono"
					                           minlength="8" maxlength="15" required>
					                    <span class="errorTelefono text-danger help-inline"></span>
				                    </div>

				                    

				                </div>

				                <div class="form-group">
				                    <div class="col-lg-6 col-md-6 col-sm-12">
				                    <label for="text2">Departamento</label>
				                       <select class="form-control" id="departamento" data-bind="options: model.encargadoController.departamentos, 
				                       optionsText: 'nombre', optionsValue: 'municipios',
				                       optionsCaption: '--seleccione--',
				                       value: model.encargadoController.municipios"></select>
				                    </div>

				                    <div class="col-lg-6 col-md-6 col-sm-12">
				                    <label for="text2">Municipio</label>
				                       <select class="form-control" id="municipio" data-bind="options: model.encargadoController.municipios, 
				                       optionsText: 'nombre', optionsValue: 'id',
				                       optionsCaption: '--seleccione--',
				                       value: municipio_id" 
				                       data-error=".erroMun"
					                    required></select>
					                    <span class="erroMun text-danger help-inline"></span>
				                    </div>
				                </div>
				                 <div class="form-group">
				                    <div class="col-lg-12">
				                    <label for="text2">Dirección especifica</label>
				                        <input type="text" id="direccion" name="direccion" placeholder="ingrese dirección especifica" class="form-control"data-bind="value: direccion"
					                           data-error=".erorDir"
					                           minlength="3" maxlength="255" required>
					                    <span class="erorDir text-danger help-inline"></span>
				                    </div>
				                </div>
				                <div class="form-group">
				                	<div class="col-md-12 text-right">					           
				                		<a class="btn btn-primary btn-sm" data-bind="click:  model.encargadoController.createOrEdit"><i class="fa fa-save"></i> Guardar</a>
					                	<a class="btn btn-danger btn-sm" data-bind="click: model.encargadoController.cancelar"><i class="fa fa-undo"></i> Cancelar</a>
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
            model.encargadoController.initialize();
        });
</script>
@endsection
