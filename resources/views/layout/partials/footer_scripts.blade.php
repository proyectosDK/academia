<script src="{{ asset('lib/jquery/jquery.js') }}"></script>


<!--Bootstrap -->
<script src="{{ asset('lib/bootstrap/js/bootstrap.js') }}"></script>
<!-- MetisMenu -->
<script src="{{ asset('lib/metismenu/metisMenu.js') }}"></script>
<!-- onoffcanvas -->
<script src="{{ asset('lib/onoffcanvas/onoffcanvas.js') }}"></script>
<!-- Screenfull -->
<script src="{{ asset('lib/screenfull/screenfull.js') }}"></script>

<!-- Metis core scripts -->
<script src="{{ asset('js/core.js') }}"></script>
<!-- Metis demo scripts -->
<script src="{{ asset('js/app.js') }}"></script>


<!-- DATATABLES -->
<script type="text/javascript" src="{{ asset('js/dataTables.min.js') }}"></script>

<script src="{{ asset('js/application.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.jquery.min.js"></script>

<!--  -->
<script src="{{ asset('js/jquery.validate.js') }}"></script>
<script src="{{ asset('js/jquery.validate.localization.js') }}"></script>
<script src="{{ asset('js/knockout-3.4.2.js')}}"></script>
<script src="{{asset('js/knockout.mapping.js')}}"></script>  
<script src="{{asset('js/bootbox.min.js')}}"></script> 
<script src="{{asset('js/toastr.min.js')}}"></script> 
<script src="{{asset('js/moment.min.js')}}"></script>
<script src="{{asset('js/jquery.steps.min.js')}}"></script>
<script src="{{asset('js/axios.min.js')}}"></script>
<script src="{{asset('js/bootstrap-select.min.js')}}"></script>

<!-- scripts  -->
<script src="{{asset('scripts/js/model.js')}}"></script>
<script src="{{asset('scripts/js/curso.js')}}"></script>
<script src="{{asset('scripts/js/bimestre.js')}}"></script>
<script src="{{asset('scripts/js/departamento.js')}}"></script>
<script src="{{asset('scripts/js/municipio.js')}}"></script>
<script src="{{asset('scripts/js/institucionEducativa.js')}}"></script>
<script src="{{asset('scripts/js/encargado.js')}}"></script>
<script src="{{asset('scripts/js/ciclo.js')}}"></script>
<script src="{{asset('scripts/js/alumno.js')}}"></script>
<script src="{{asset('scripts/js/inscripcion.js')}}"></script>
<script src="{{asset('scripts/js/nota.js')}}"></script>


<script src="{{asset('scripts/js/tipoUsuario.js')}}"></script>
<script src="{{asset('scripts/js/user.js')}}"></script>

<!-- scripts  services-->
<script src="{{asset('scripts/services/CursoService.js')}}"></script>
<script src="{{asset('scripts/services/BimestreService.js')}}"></script>
<script src="{{asset('scripts/services/DepartamentoService.js')}}"></script>
<script src="{{asset('scripts/services/MunicipioService.js')}}"></script>
<script src="{{asset('scripts/services/InstitucionEducativaService.js')}}"></script>
<script src="{{asset('scripts/services/EncargadoService.js')}}"></script>
<script src="{{asset('scripts/services/CicloService.js')}}"></script>
<script src="{{asset('scripts/services/AlumnoService.js')}}"></script>
<script src="{{asset('scripts/services/InscripcionService.js')}}"></script>
<script src="{{asset('scripts/services/NotaService.js')}}"></script>


<script src="{{asset('scripts/services/TipoUsuarioService.js')}}"></script>
<script src="{{asset('scripts/services/UserService.js')}}"></script>

<script>
	$(document).ready(function () {
	    console.log("applyBindings");
	    ko.applyBindings();

	    $("body").tooltip({ selector: '[data-toggle=tooltip]' });
	});
</script>

