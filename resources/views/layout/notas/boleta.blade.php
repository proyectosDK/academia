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
			                <h4 class="title">&nbsp; Consulta calficaciones</h4>
			            </header>

			            <div class="body">
				            <form id="formulario" class="form-horizontal" data-bind="with: model.boletaController.boleta">

				            	<div class="form-group">
				            		<div class="col-lg-8 col-md-8 col-sm-12">
			                    <label for="text2">Alumno (nombre/codigo)</label>
			                       <select class="form-control" id="alumno_id" name="alumno_id" data-bind="options: model.boletaController.alumnos, optionsText: function(e) {return e.primer_nombre+' '+e.segundo_nombre + ' '+e.primer_apellido+' '+e.segundo_apellido+' /'+e.id}, optionsValue: 'id',
				                       optionsCaption: '--seleccione alumno--',
				                       value: alumno_id" 
				                       data-error=".errorA"
					                    required></select>
				                    <span class="errorA text-danger help-inline"></span>
			                    </div>
			                    <div class="col-lg-4 col-md-4 col-sm-12">
			                    <label for="text2">Ciclo escolar</label>
			                       <select name="ciclo_id" class="form-control" id="ciclo_id" data-bind="options: model.boletaController.ciclos, optionsText: 'ciclo', optionsValue: 'id',
				                       optionsCaption: '--seleccione ciclo--',
				                       value: ciclo_id" 
				                       data-error=".errorC"
					                    required></select>
				                    <span class="errorC text-danger help-inline"></span>
			                    </div>	
				            	</div>
				                
				                <div class="form-group">
				                	<div class="col-md-12 text-right">					           
				                		<a class="btn btn-primary btn-sm" data-bind="click:  model.boletaController.buscar"><i class="fa fa-save"></i> Buscar</a>
				                	</div>


				                </div>
				            </form>
				        </div>
			        </div>
			    </div>
			</div>
		</div>
	</div>

	<!-- Modal -->
<div id="ver" class="modal fade" role="dialog" style="color: black;" data-backdrop="static">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-body" id="print">
      	<div class="modal-header">
      		<div class="row col-lg-12 col-md-12">
      			<div class="col-md-3 col-lg-3">
      				<img height="50px" src="{{asset('img/logo.jpg')}}" alt="">
      			</div>
      			<div class="col-md-6 col-lg-6">
      				<h4 class="modal-title text-center">ACADEMIA DE COMPUTACIÓN </h4>
      				<h4 class="modal-title text-center">CIUDAD PEDRO DE ALVARADO </h4>
      			</div>
      		</div>
      		<hr />

        <h4 class="modal-title text-center" data-bind="text: 'CALIFICACIONES CICLO ESCOLAR '+ model.boletaController.info.ciclo()"></h4><br />
        <label>Codigo alumno: </label> <span data-bind="text: model.boletaController.info.codigo()"></span><br />
        <label>Alumno: </label> <span data-bind="text: model.boletaController.info.alumno()"></span><br />
        <label>Dirección: </label> <span data-bind="text: model.boletaController.info.direccion()"></span><br />
      </div>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th width="15%">Asignatura</th>
                <th>primer bimestre</th>
                <th>segundo bimestre</th>
                <th>tercer bimestre</th>
                <th>cuarto bimestre</th>
                <th>nota final</th>
                <th>estado</th>
            </tr>
            </thead>
            <tbody>
            	<!-- ko foreach: {data: model.boletaController.notas, as: 'c'} -->
                <tr>
                    <td data-bind="text: c.curso" class="text-right"></td>
                    <td data-bind="text: c.nota.pb !== null ? c.nota.pb : 'sin nota' " class="text-right"></td>
                    <td data-bind="text: c.nota.sb !== null ? c.nota.sb : 'sin nota'" class="text-right"></td>
                    <td data-bind="text: c.nota.tb !== null ? c.nota.tb : 'sin nota'" class="text-right"></td>
                    <td data-bind="text: c.nota.cb !== null ? c.nota.cb : 'sin nota'" class="text-right"></td>
                    <td data-bind="text: c.nota.nf" class="text-right"></td>
                    <td data-bind="text: c.nota.estado == 1 ? 'aprobado': c.nota.estado == 0? 'reprobado': 'pendiente', css: c.nota.estado == 1 ? 'text-success' : c.nota.estado == 0 ? 'text-danger':'text-warning' " class="text-right"></td>
                </tr>
                <!-- /ko -->
            </tbody> 
        </table>

        <div class="row col-lg-12 col-md-12">
      			<div class="col-md-12 col-lg-12">
      				<h4 class="modal-title text-center">(firma) _____________________________________</h4>
      				<h6 class="modal-title text-center">director </h6>
      			</div>
      		</div>
        
    </div>

    <div class="modal-footer">
      	<a type='button' class="btn btn-default btn-sm" id='btn' value='Print' onclick='printDiv();'>
      		<i class="fa fa-print"></i> imprimir</a>
        <a type="button" class="btn btn-danger btn-sm" data-bind="click: model.boletaController.cancelar" data-dismiss="modal"><i class="fa fa-undo"></i> Volver</a>
      </div>
      </div>
      
    </div>

  </div>
</div>
</div>

<script>
        $(document).ready(function () {
            model.boletaController.initialize();
        });

         function printDiv() 
			{
			  let printContents, popupWin;
		        printContents = document.getElementById('print').innerHTML;
		        popupWin = window.open('', '_blank', 'top=0,left=0,height=100%,width=auto');
		        popupWin.document.open();
		        popupWin.document.write(`
		          <html>
		            <head>
		            <link rel="stylesheet" href="{{ asset('lib/bootstrap/css/bootstrap.css') }}">
		            </head>
		            <style>
		            	@media print {
						   body { font-size: 10pt }
						 }
						 @media screen {
						   body { font-size: 13px }
						 }
						 @media screen, print {
						   body { line-height: 1.2 }
						 }
		            </style>
		        <body onload="window.print();window.close()">${printContents}</body>
		          </html>`
		        );
		        popupWin.document.close();

			}
</script>
@endsection
