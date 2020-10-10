@extends('layout.main')
@section('content')

<div id="content">
	<div class="outer">
		<div class="inner bg-light lter">
			<div class="row" data-bind="visible: model.tipoUsuarioController.gridMode()">
				 <div class="col-lg-12">
			        <div class="box">
			            <header>
			                <div class="icons"><i class="fa fa-table"></i></div>
			                <h4 class="title">&nbsp; Tipo Usuarios </h4>
			            </header>
			            <div id="collapse4" class="body">
			                <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
			                    <thead>
			                    <tr>
			                        <th>Nombre</th>
			                    </tr>
			                    </thead>
			                    <tbody data-bind="dataTablesForEach : {
                                                    data: model.tipoUsuarioController.tipo_usuarios,
                                                    options: dataTableOptions
                                                  }">
                                    <tr>
                                        <td data-bind="text: nombre"></td>
                                    </tr>

                                </tbody>              
			                 </table>
			            </div>
			        </div>
			    </div>
			</div>

		<!--	<div class="row" data-bind="visible: model.tipoUsuarioController.insertMode()">
				<div class="col-lg-12 col-md-12 col-sm-12">
				    <div class="box dark">
				        <header>
				            <div class="icons"><i data-bind="visible:!model.tipoUsuarioController.editMode()" class="fa fa-plus"></i>
				            	<i data-bind="visible:model.tipoUsuarioController.editMode()" class="fa fa-edit"></i></div>
				            <h5 data-bind="visible:!model.tipoUsuarioController.editMode()"> Nuevo Registro</h5> 
				            <h5 data-bind="visible:model.tipoUsuarioController.editMode()"> Editar Registro</h5>          
				        </header>
				        <div class="body">
				            <form id="tipoForm" class="form-horizontal" data-bind="with: model.tipoUsuarioController.tipo_usuario">

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
				                		<a class="btn btn-primary btn-sm" data-bind="click:  model.tipoUsuarioController.createOrEdit"><i class="fa fa-save"></i> Guardar</a>
					                	<a class="btn btn-danger btn-sm" data-bind="click: model.tipoUsuarioController.cancelar"><i class="fa fa-undo"></i> Cancelar</a>
				                	</div>
				                </div>
				            </form>
				        </div>
				    </div>
				</div>
			</div>-->
		</div>
	</div>
</div>


<script>
        $(document).ready(function () {
            model.tipoUsuarioController.initialize();
        });
</script>
@endsection
