@extends('layout.main')
@section('content')

<div id="content">
	<div class="outer">
		<div class="inner bg-light lter">
			<div class="row" data-bind="visible: model.notaController.gridMode()">
				 <div class="col-lg-12">
			        <div class="box">
			            <header>
			                <div class="icons"><i class="fa fa-table"></i></div>
			                <h4 class="title">&nbsp; notas <button class="text-right btn btn-success btn-sm" data-bind="click: model.notaController.nuevo"> <i class="fa fa-plus-square-o"></i> Nuevo</button></h4>
			            </header>
			            <div id="collapse4" class="body">
			                <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
			                    <thead>
			                    <tr>
			                        <th>Ciclo</th>
			                        <th>Bimestre</th>
			                        <th>Aciones</th>
			                    </tr>
			                    </thead>
			                    <tbody data-bind="dataTablesForEach : {
                                                    data: model.notaController.notas,
                                                    options: dataTableOptions
                                                  }">
                                    <tr>
                                        <td data-bind="text: ciclo.ciclo"></td>
                                        <td data-bind="text: bimestre.nombre"></td>
                                        <td width="10%">
                                            <a href="#" class="btn btn-warning btn-xs" data-bind="click: model.notaController.editar" data-toggle="tooltip" title="editar"><i class="fa fa-pencil-square-o"></i></a>

                                            <a href="#" class="btn btn-danger btn-xs" data-bind="click: model.notaController.destroy" data-toggle="tooltip" title="eliminar"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>

                                </tbody>              
			                 </table>
			            </div>
			        </div>
			    </div>
			</div>
			<div class="row" data-bind="visible: model.notaController.insertMode()">
				<div class="col-lg-12 col-md-12 col-sm-12">
				    <div class="box dark">
				        <header> 
				            <h5> Ingresar notas</h5>          <!-- /.toolbar -->
				        </header>

				        <div class="body">
				            <form id="formulario" class="form-horizontal" data-bind="with: model.notaController.nota">

				                <div class="form-group">
				                	<div class="col-lg-4 col-md-4 col-sm-12">
				                    <label for="text2">Ciclo escolar</label>
				                       <select class="form-control" name="ciclo" id="ubicaciclocion" data-bind="options: model.notaController.ciclos, 
				                       optionsText: 'ciclo', optionsValue: 'id',
				                       optionsCaption: '--seleccione--',
				                       value: ciclo_id" 
				                       data-error=".errorCic"
					                    required></select>
					                    <span class="errorCic text-danger help-inline"></span>
				                    </div>
				                    <div class="col-lg-4 col-md-4 col-sm-12">
				                    <label for="text2">Bimestre</label>
				                       <select class="form-control" id="bimestre" name="bimestre" data-bind="options: model.notaController.bimestres, 
				                       optionsText: 'nombre', optionsValue: 'id',
				                       optionsCaption: '--seleccione--',
				                       value: bimestre_id" 
				                       data-error=".errorB"
					                    required></select>
					                    <span class="errorB text-danger help-inline"></span>
				                    </div>
				                    <div class="col-lg-4 col-md-4 col-sm-12">
				                    	<hr />
				                    	<a class="btn btn-info btn-sm" data-bind="click:  model.notaController.getInscripciones"><i class="fa fa-eye"></i> seleccionar</a>
				                    </div>
				                </div>
				            </form>

				            <div class="body-collapse" data-bind="visible: model.notaController.inscripciones().length > 0">
				            	<label>Seleccione curso</label><br />
				            	<!-- ko foreach: {data: model.notaController.cursos, as: 'c'} -->
		                               <a href="#" class="btn btn-primary btn-line" data-original-title="" title="" data-bind="click: model.notaController.getAlumnos(c)"><span data-bind="text: c.nombre"></span></a>   
		                         <!-- /ko -->
				         
				            </div>

				            <div class="col-lg-12" data-bind="visible: model.notaController.curso.nombre() !== ''">
				            	<div class="box">
				            		<header>
											<div class="icons">
											<i class="fa fa-building-o"></i>
											</div>
											<h5 data-bind="text: model.notaController.curso.nombre"></h5>
									</header>
				            	</div>
				            </div>
				        </div>
				    </div>
				</div>
			</div>
		</div>
	</div>
</div>


<script>
        $(document).ready(function () {
            model.notaController.initialize();
        });
</script>
@endsection
