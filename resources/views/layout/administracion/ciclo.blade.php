@extends('layout.main')
@section('content')

<div id="content">
	<div class="outer">
		<div class="inner bg-light lter">
			<div class="row" data-bind="visible: model.cicloController.gridMode()">
				 <div class="col-lg-12">
			        <div class="box">
			            <header>
			                <div class="icons"><i class="fa fa-table"></i></div>
			                <h4 class="title">&nbsp; ciclos <button class="text-right btn btn-success btn-sm" data-bind="click: model.cicloController.nuevo"> <i class="fa fa-plus-square-o"></i> Nuevo</button></h4>
			            </header>
			            <div id="collapse4" class="body">
			                <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
			                    <thead>
			                    <tr>
			                        <th>Ciclo</th>
			                        <th>Estado</th>
			                        <th>Aciones</th>
			                    </tr>
			                    </thead>
			                    <tbody data-bind="dataTablesForEach : {
                                                    data: model.cicloController.ciclos,
                                                    options: dataTableOptions
                                                  }">
                                    <tr>
                                        <td data-bind="text: ciclo"></td>
                                        <td><span class="label" data-bind="text: (activo === 1 ? 'Actual' : 'No actual'), css: (activo === 1 ? 'label-primary' : 'label-danger')"></span></td>
                                        <td width="10%">
                                            <a href="#" class="btn btn-warning btn-xs" data-bind="click: model.cicloController.editar" data-toggle="tooltip" title="editar"><i class="fa fa-pencil-square-o"></i></a>

                                            <a href="#" class="btn btn-danger btn-xs" data-bind="click: model.cicloController.destroy" data-toggle="tooltip" title="eliminar"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>

                                </tbody>              
			                 </table>
			            </div>
			        </div>
			    </div>
			</div>
			<div class="row" data-bind="visible: model.cicloController.insertMode()">
				<div class="col-lg-12 col-md-12 col-sm-12">
				    <div class="box dark">
				        <header>
				            <div class="icons"><i data-bind="visible:!model.cicloController.editMode()" class="fa fa-plus"></i>
				            	<i data-bind="visible:model.cicloController.editMode()" class="fa fa-edit"></i></div>
				            <h5 data-bind="visible:!model.cicloController.editMode()"> Nuevo Registro</h5> 
				            <h5 data-bind="visible:model.cicloController.editMode()"> Editar Registro</h5>          <!-- /.toolbar -->
				        </header>
				        <div class="body">
				            <form id="tipoForm" class="form-horizontal" data-bind="with: model.cicloController.ciclo">

				                <div class="form-group">

				                    <div class="col-lg-4">
				                    <label for="text2">Ciclo</label>
				                        <input type="number" id="ciclo" name="ciclo" placeholder="ingrese ciclo" class="form-control"data-bind="value: ciclo"
					                           data-error=".ciclo"
					                           minlength="4" maxlength="4" required>
					                    <span class="ciclo text-danger help-inline"></span>
				                    </div>

				                    <div class="col-lg-4">
				                    <label for="text2">Inicio</label>
				                        <input type="date" id="inicio" name="inio" placeholder="ingrese inicio" class="form-control"data-bind="value: inicio"
					                           data-error=".inicio" required>
					                    <span class="inicio text-danger help-inline"></span>
				                    </div>

				                    <div class="col-lg-4">
				                    <label for="text2">Fin</label>
				                        <input type="date" id="fin" name="fin" placeholder="ingrese fin" class="form-control"data-bind="value: fin"
					                           data-error=".fin" required>
					                    <span class="ciclo text-danger help-inline"></span>
				                    </div>
				                </div>
				                <div class="form-group">
				                	<div class="col-md-12 text-right">					           
				                		<a class="btn btn-primary btn-sm" data-bind="click:  model.cicloController.createOrEdit"><i class="fa fa-save"></i> Guardar</a>
					                	<a class="btn btn-danger btn-sm" data-bind="click: model.cicloController.cancelar"><i class="fa fa-undo"></i> Cancelar</a>
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
            model.cicloController.initialize();
        });
</script>
@endsection
