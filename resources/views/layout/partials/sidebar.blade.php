<!-- /#top -->
<div id="left">
    <div class="media user-media bg-dark dker">
        <div class="user-media-toggleHover">
            <span class="fa fa-user"></span>
        </div>
        <div class="user-wrapper bg-dark">
            <a class="user-link" href="">
              @if(isset(Auth::user()->foto))
                    <img src="{{URL::asset('img/'.Auth::user()->foto)}}" class="media-object img-thumbnail user-img" alt="User Image" style="height: 70px; width: 60px;">
              @else
                <img class="media-object img-thumbnail user-img" alt="User Picture" src="{{ asset('img/user.gif') }}">
              @endif
                <span class="label label-danger user-label"></span>
            </a>
    
            <div class="media-body">
                <h5 class="media-heading">{{Auth::user()->email}}</h5>
                <ul class="list-unstyled user-info">
                    <li><h5 href="">Usuario: {{Auth::user()->tipo_usuario->nombre}}</h5></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- #menu -->
    <ul id="menu" class="bg-dark dker">
              <li class="nav-header">Menu</li>
              <li class="nav-divider"></li>
              <li class="">
                <a href="/">
                  <i class="fa fa-dashboard"></i><span class="link-title">&nbsp;Escritorio</span>
                </a>
              </li>
              <li class="">
                <a href="javascript:;">
                  <i class="fa fa-building "></i>
                  <span class="link-title">Catálogos</span>
                  <span class="fa arrow"></span>
                </a>
                @if(Auth::user()->tipo_usuario->nombre == "administrador")
                <ul class="collapse">
                  <li>
                    <a href="{{ route('departamentosView') }}">
                      <i class="fa fa-angle-right"></i>&nbsp; Departamentos</a>
                  </li>
                </ul>
                <ul class="collapse">
                  <li>
                    <a href="{{ route('municipiosView') }}">
                      <i class="fa fa-angle-right"></i>&nbsp; Municipios</a>
                  </li>
                </ul>
                <ul class="collapse">
                  <li>
                    <a href="{{ route('cursosView') }}">
                      <i class="fa fa-angle-right"></i>&nbsp; Cursos</a>
                  </li>
                </ul>
                <ul class="collapse">
                  <li>
                    <a href="{{ route('bimestresView') }}">
                      <i class="fa fa-angle-right"></i>&nbsp; Bimestres</a>
                  </li>
                </ul>
                <ul class="collapse">
                  <li>
                    <a href="{{ route('institucionesView') }}">
                      <i class="fa fa-angle-right"></i>&nbsp; Instituciones Educativas</a>
                  </li>
                </ul>
                @endif
              </li>
              <li class="">
                <a href="javascript:;">
                  <i class="fa fa-user "></i>
                  <span class="link-title">Acceso</span>
                  <span class="fa arrow"></span>
                </a>
                @if(Auth::user()->tipo_usuario->nombre == "administrador")
                <ul class="collapse">
                  <li>
                    <a href="{{ route('tipoUsuariosView') }}">
                      <i class="fa fa-angle-right"></i>&nbsp; Tipo Usuarios</a>
                  </li>
                </ul>
                <ul class="collapse">
                  <li>
                    <a href="{{ route('usersView') }}">
                      <i class="fa fa-angle-right"></i>&nbsp; Usuarios</a>
                  </li>
                </ul>
                @endif
                <ul class="collapse">
                  <li>
                    <a href="{{ route('cambiarContrasenaView') }}">
                      <i class="fa fa-angle-right"></i>&nbsp; Cambiar contraseña</a>
                  </li>
                </ul>
              </li>
              <li class="">
                <a href="#">
                  <i class="fa fa-file"></i><span class="link-title">&nbsp; Ayuda</span>
                </a>
              </li>
              <li class="">
                <a href="#">
                  <i class="fa fa-file"></i><span class="link-title">&nbsp; a cerca de</span>
                </a>
              </li><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
              <li class="">
                
              </li>
            </ul>
    <!-- /#menu -->
</div>