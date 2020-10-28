@extends('layout.main')
@section('content')

<div id="content">
	<div class="outer">
		<div class="inner bg-light lter">
			<div class="row" data-bind="visible: model.institucionesEducativaController.gridMode()">
				 <div class="col-lg-12">
			        <div class="box">
			            <header>
			                <div class="icons"><i class="fa fa-table"></i></div>
			                <h4 class="title">&nbsp; institucionesEducativas <button class="text-right btn btn-success btn-sm" data-bind="click: model.institucionesEducativaController.nuevo"> <i class="fa fa-plus-square-o"></i> Nuevo</button></h4>
			            </header>
			            <div id="collapse4" class="body">
			                <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
			                    <thead>
			                    <tr>
			                        <th>institucionesEducativa</th>
			                        <th>telefono</th>
			                        <th>email</th>
			                        <th>Dirección</th>
			                        <th>Aciones</th>
			                    </tr>
			                    </thead>
			                    <tbody data-bind="dataTablesForEach : {
                                                    data: model.institucionesEducativaController.institucionesEducativas,
                                                    options: dataTableOptions
                                                  }">
                                    <tr>
                                        <td data-bind="text: nombre"></td>
                                        <td data-bind="text: telefono"></td>
                                        <td data-bind="text: email"></td>
                                        <td data-bind="text: direccion+' '+municipio.nombre+', '+municipio.departamento.nombre"></td>
                                        <td width="10%">
                                            <a href="#" class="btn btn-warning btn-xs" data-bind="click: model.institucionesEducativaController.editar" data-toggle="tooltip" title="editar"><i class="fa fa-pencil-square-o"></i></a>

                                            <a href="#" class="btn btn-danger btn-xs" data-bind="click: model.institucionesEducativaController.destroy" data-toggle="tooltip" title="eliminar"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>
                                </tbody>              
			                 </table>
			            </div>
			        </div>
			    </div>
			</div>
			<div class="row" data-bind="visible: model.institucionesEducativaController.insertMode()">
				<div class="col-lg-12 col-md-12 col-sm-12">
				    <div class="box dark">
				        <header>
				            <div class="icons"><i data-bind="visible:!model.institucionesEducativaController.editMode()" class="fa fa-plus"></i>
				            	<i data-bind="visible:model.institucionesEducativaController.editMode()" class="fa fa-edit"></i></div>
				            <h5 data-bind="visible:!model.institucionesEducativaController.editMode()"> Nuevo Registro</h5> 
				            <h5 data-bind="visible:model.institucionesEducativaController.editMode()"> Editar Registro</h5>          <!-- /.toolbar -->
				        </header>
				        <div class="body">
				            <form id="formulario" class="form-horizontal" data-bind="with: model.institucionesEducativaController.institucionesEducativa">

				                <div class="form-group">

				                    <div class="col-lg-12">
				                    <label for="text2">Nombre</label>
				                        <input type="text" id="nombre" name="nombre" placeholder="ingrese nombre" class="form-control"data-bind="value: nombre"
					                           data-error=".errorNombre"
					                           minlength="3" maxlength="250" required>
					                    <span class="errorNombre text-danger help-inline"></span>
				                    </div>
				                </div>
				                <div class="form-group">

				                    <div class="col-lg-6 col-md-6 col-sm-12">
				                    <label for="text2">Telefono</label>
				                        <input type="number" id="telefono" name="telefono" placeholder="ingrese telefono" class="form-control"data-bind="value: telefono"
					                           data-error=".errorTelefono"
					                           minlength="8" maxlength="15" required>
					                    <span class="errorTelefono text-danger help-inline"></span>
				                    </div>

				                    <div class="col-lg-6 col-md-6 col-sm-12">
				                    <label for="text2">Email</label>
				                        <input type="email" id="email" name="email" placeholder="ingrese telefono" class="form-control"data-bind="value: email">
				                    </div>

				                </div>

				                <div class="form-group">
				                    <div class="col-lg-6 col-md-6 col-sm-12">
				                    <label for="text2">Departamento</label>
				                       <select class="form-control" id="departamento" data-bind="options: model.institucionesEducativaController.departamentos, 
				                       optionsText: 'nombre', optionsValue: 'municipios',
				                       optionsCaption: '--seleccione--',
				                       value: model.institucionesEducativaController.municipios"></select>
				                    </div>

				                    <div class="col-lg-6 col-md-6 col-sm-12">
				                    <label for="text2">Municipio</label>
				                       <select class="form-control" id="municipio" data-bind="options: model.institucionesEducativaController.municipios, 
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
				                		<a class="btn btn-primary btn-sm" data-bind="click:  model.institucionesEducativaController.createOrEdit"><i class="fa fa-save"></i> Guardar</a>
					                	<a class="btn btn-danger btn-sm" data-bind="click: model.institucionesEducativaController.cancelar"><i class="fa fa-undo"></i> Cancelar</a>
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
            model.institucionesEducativaController.initialize();
        });
</script>
@endsection
