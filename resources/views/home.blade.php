@extends('layout.main')
@section('content')

<div id="content">
    <div class="outer">
    	<h3>
			<i class="fa fa-dashboard"></i>&nbsp; Dashboard</h3>
        <div class="inner bg-light lter">
            <div class="text-center">
				<ul class="stats_box">
					<li>
					<div class="sparkline bar_week"><i class="fa fa-address-book fa-2x"></i></div>
					<div class="stat_text">
						<strong id="al"></strong>total de alumnos
					</div>
					</li>
					<li>
					<div class="sparkline bar_week"><i class="fa fa-address-card fa-2x"></i></div>
					<div class="stat_text">
						<strong id="enc"></strong>total de encargados
					</div>
					</li>
					<li>
					<div class="sparkline bar_week"><i class="fa fa-book fa-2x"></i></div>
					<div class="stat_text">
						<strong id="insc"></strong>inscritos en periodo {{now()->year}}
					</div>
					</li>
					<li>
					<div class="sparkline bar_week"><i class="fa fa-building fa-2x"></i></div>
					<div class="stat_text">
						<strong id="inst"></strong>instituciones educativas
					</div>
					</li>
				</ul>
			</div>

            <div class="row">
			<div class="col-lg-8">
				<div class="box">
					<header>
						<h5>Inscripciones ultimos 10 años</h5>
					</header>
					<div>
						<canvas id="ciclosChart"></canvas>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="box">
					<div class="body">
						<table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
			                    <thead>
			                    <tr>
			                        <th>Ciclo</th>
			                        <th>Inscripciones</th>
			                    </tr>
			                    </thead>
			                    <tbody>
			                    	<!-- ko foreach: {data: model.cicloController.info_ciclos, as: 'c'} -->
                                    <tr>
                                        <td data-bind="text: label"></td>
                                        <td data-bind="text: value"></td>
                                    </tr>
                                    <!-- /ko -->
                                </tbody>              
			                 </table>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-4">
				<div class="box">
					<header>
						<h5>Inscripciones por curso en ciclo escolar {{ now()->year }}</h5>
					</header>
					<div>
						<canvas id="cursosChart"></canvas>
					</div>
				</div>
			</div>
			<div class="col-lg-8">
				<div class="box">
					<div class="body">
						<header>
							<h5>Inscripciones por institucion</h5>
						</header>
						<div>
							<canvas id="institucionesChart"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div> 

        </div>  

    </div>   
</div>  

<script src="{{ asset('js/Chart.min.js') }}"></script>
<script>
	var colors = ['#BF3F3F','#BF7F3F','#BF3FBF','#3FBF7F','#161C19','#201C9B','#ED1C11','#5E0B07','#B9B6B6','#2F272D','#987654'];
	$(document).ready(function () {

		$.get('/dashboard/info', function(data){
            document.getElementById("al").innerHTML = data.alumnos
            document.getElementById("insc").innerHTML = data.inscripciones
            document.getElementById("enc").innerHTML = data.encargados
            document.getElementById("inst").innerHTML = data.instituciones
        });

		$.get('/dashboard/ciclos', function(data){
            resumen(data,'ciclosChart');
            var table = [];
            for(var $i = 0; $i<data.info.length; $i++){
            	table.push({
            		label: data.labels[$i],
            		value: data.info[$i]
            	});
            }
            model.cicloController.info_ciclos(table)
        });

        $.get('/dashboard/cursos', function(data){
            resumenCursos(data)
        }); 

        $.get('/dashboard/instituciones', function(data){
            resumen(data,'institucionesChart')
        }); 
    });

	function resumen(data,id_html){
		var ctx = document.getElementById(id_html).getContext('2d');
		var chart = new Chart(ctx, {
		    // The type of chart we want to create
		    type: 'bar',

		    // The data for our dataset
		    data: {
		        labels: data.labels,
		        datasets: [{
		            label: 'inscripciones',
		            backgroundColor: colors,
		            borderColor: 'rgb(255, 255, 255)',
		            data: data.info
		        }]
		    },

		    // Configuration options go here
		    options: {
		    	responsive: true,
		    	scales: {
		    		yAxes: [{
		    			ticks: {
		    				beginAtZero: true,
                            //steps: 10,
                            stepValue: 1,
		    			}
		    		}]
		    	}
		    }
		});
	}

	function resumenCursos(data){
		var ctx = document.getElementById('cursosChart').getContext('2d');
		var myDoughnutChart = new Chart(ctx, {
		    type: 'doughnut',
		    // The data for our dataset
		    data: {
		        labels: data.labels,
		        datasets: [{
		            label: 'inscripciones',
		            backgroundColor: colors,
		            //borderColor: 'rgb(255, 255, 255)',
		            data: data.info
		        }]
		    }
		});
	}
</script>

@endsection
