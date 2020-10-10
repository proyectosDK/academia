@extends('layout.main')
@section('content')

<div id="content">
	<div class="outer">
		<div class="inner bg-light lter">
			<div class="row" data-bind="visible: model.departamentoController.gridMode()">
				 <div class="col-lg-12">
			        <div class="box">
			            <header>
			                <div class="icons"><i class="fa fa-table"></i></div>
			                <h4 class="title">&nbsp; Departamentos <button class="text-right btn btn-success btn-sm" data-bind="click: model.departamentoController.nuevo"> <i class="fa fa-plus-square-o"></i> Nuevo</button></h4>
			            </header>
			            <div id="collapse4" class="body">
			                <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
			                    <thead>
			                    <tr>
			                        <th>Nombre</th>
			                        <th>Aciones</th>
			                    </tr>
			                    </thead>
			                    <tbody data-bind="dataTablesForEach : {
                                                    data: model.departamentoController.departamentos,
                                                    options: dataTableOptions
                                                  }">
                                    <tr>
                                        <td data-bind="text: nombre"></td>
                                        <td width="10%">
                                            <a href="#" class="btn btn-warning btn-xs" data-bind="click: model.departamentoController.editar" data-toggle="tooltip" title="editar"><i class="fa fa-pencil-square-o"></i></a>

                                            <a href="#" class="btn btn-danger btn-xs" data-bind="click: model.departamentoController.destroy" data-toggle="tooltip" title="eliminar"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>

                                </tbody>              
			                 </table>
			            </div>
			        </div>
			    </div>
			</div>
			<div class="row" data-bind="visible: model.departamentoController.insertMode()">
				<div class="col-lg-12 col-md-12 col-sm-12">
				    <div class="box dark">
				        <header>
				            <div class="icons"><i data-bind="visible:!model.departamentoController.editMode()" class="fa fa-plus"></i>
				            	<i data-bind="visible:model.departamentoController.editMode()" class="fa fa-edit"></i></div>
				            <h5 data-bind="visible:!model.departamentoController.editMode()"> Nuevo Registro</h5> 
				            <h5 data-bind="visible:model.departamentoController.editMode()"> Editar Registro</h5>          <!-- /.toolbar -->
				        </header>
				        <div class="body">
				            <form id="formulario" class="form-horizontal" data-bind="with: model.departamentoController.departamento">

				                <div class="form-group">

				                    <div class="col-lg-6">
				                    <label for="text2">Nombre</label>
				                        <input type="text" id="nombre" name="nombre" placeholder="ingrese nombre" class="form-control"data-bind="value: nombre"
					                           data-error=".errorNombre"
					                           minlength="3" maxlength="25" required>
					                    <span class="errorNombre text-danger help-inline"></span>
				                    </div>
				                </div>
				                <div class="form-group">
				                	<div class="col-md-6 text-right">					           
				                		<a class="btn btn-primary btn-sm" data-bind="click:  model.departamentoController.createOrEdit"><i class="fa fa-save"></i> Guardar</a>
					                	<a class="btn btn-danger btn-sm" data-bind="click: model.departamentoController.cancelar"><i class="fa fa-undo"></i> Cancelar</a>
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
            model.departamentoController.initialize();
        });
</script>
@endsection
