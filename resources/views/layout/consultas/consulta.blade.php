@extends('layout.main')
@section('content')


<div id="content">
	<div class="outer">
		<div class="inner bg-light lter">
			<div class="row">
				 <div class="col-lg-12">
			        <div class="box">
			            <header>
			                <div class="icons"><i class="fa fa-table"></i></div>
			                <h4 class="title">&nbsp; Consulta inscripciones por ciclo</h4>
			            </header>

			            <div class="body">
				            <form id="formulario" class="form-horizontal">

				            	<div class="form-group">
									<label for="text1" class="control-label col-lg-2">Ciclo escolar: </label>
									<div class="col-lg-4">
										<select name="ciclo_id" class="form-control" id="ciclo_id" data-bind="options: model.reporteController.ciclos, optionsText: 'ciclo', optionsValue: 'id',
				                       optionsCaption: '--seleccione ciclo--',
				                       value: model.reporteController.ciclo_id" 
				                       data-error=".errorC"
					                    required></select>
				                    <span class="errorC text-danger help-inline"></span>
									</div>
									<div class="col-md-1 text-right">					           
				                		<a class="btn btn-success btn-sm" data-bind="click:  model.reporteController.getInscripciones"><i class="fa fa-search"></i> Consultar</a>
				                	</div>
								</div>
				            </form>
				        </div>
			        </div>
			    </div>
			</div>
			<div class="row">
				 <div class="col-lg-12">
			        <div class="box">
			            <header>
			                <div class="icons"><i class="fa fa-table"></i></div>
			                <h4 class="title">&nbsp; ciclo escolar <span data-bind="text: model.reporteController.ciclo()"></span> <a class="text-right btn btn-default btn-sm" data-bind="attr: { href: 'consultas_print_inscripciones/'+model.reporteController.ciclo_id() }, visible: model.reporteController.ciclo() !== '' " target="blank"> <i class="fa fa-print"></i> imprimir</a></h4>
			            </header>
			            <div id="collapse4" class="body">
			                <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
			                    <thead>
			                    <tr>
			                        <th width="10%">Codigo alumno</th>
			                        <th>Alumno</th>
			                        <th>Institución educativa</th>
			                        <th>Cursos asignados</th>
			                        <th width="15%">Fecha inscripcion</th>
			                    </tr>
			                    </thead>
			                    <tbody data-bind="dataTablesForEach : {
                                                    data: model.reporteController.inscripciones,
                                                    options: dataTableOptions
                                                  }">
                                    <tr>
                                        <td data-bind="text: codigo_alumno"></td>
                                        <td data-bind="text: nombres"></td>
                                        <td data-bind="text: institucion"></td>
                                        <td data-bind="text: cursos_asignados"></td>
                                        <td data-bind="text: moment(fecha).format('DD/MM/YYYY')"></td>
                                    </tr>

                                </tbody>              
			                 </table>
			            </div>
			        </div>
			    </div>
			</div>
		</div>
	</div>
</div>

<script>
	$(document).ready(function () {
            model.reporteController.initialize();
        });
</script>
@endsection
