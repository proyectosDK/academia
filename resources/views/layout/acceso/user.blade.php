@extends('layout.main')
@section('content')

<div id="content">
	<div class="outer">
		<div class="inner bg-light lter">
			<div class="row" data-bind="visible: model.userController.gridMode()">
				 <div class="col-lg-12">
			        <div class="box">
			            <header>
			                <div class="icons"><i class="fa fa-table"></i></div>
			                <h4 class="title">&nbsp; Usuarios <button class="text-right btn btn-success btn-sm" data-bind="click: model.userController.nuevo"> <i class="fa fa-plus-square-o"></i> Nuevo</button></h4>
			            </header>
			            <div id="collapse4" class="body">
			                <table id="dataTable" class="table table-bordered table-condensed table-hover table-striped">
			                    <thead>
			                    <tr>
			                    	<th>Avatar</th>
			                        <th>Usuario</th>
			                        <th>Tipo usuario</th>
			                        <th>Aciones</th>
			                    </tr>
			                    </thead>
			                    <tbody data-bind="dataTablesForEach : {
                                                    data: model.userController.users,
                                                    options: dataTableOptions
                                                  }">
                                    <tr>
                                    	<td><img class="bgimage img-responsive img-circle" style=" height:90px; width: 100px;" data-bind="attr:{src: (avatar !== null && avatar !== '' ? '/img/'+avatar : emptyLogo)}" /></td>
                                        <td data-bind="text: email"></td>
                                        <td data-bind="text: tipo_usuario.nombre"></td>
                                        <td width="10%">
                                            <a href="#" class="btn btn-warning btn-xs" data-bind="click: model.userController.editar"><i class="fa fa-pencil-square-o"></i></a>
                                            <a href="#" class="btn btn-danger btn-xs" data-bind="click: model.userController.destroy"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>

                                </tbody>              
			                 </table>
			            </div>
			        </div>
			    </div>
			</div>
			<div class="row" data-bind="visible: model.userController.insertMode() || model.userController.editMode()">
				<div class="col-lg-12 col-md-12 col-sm-12">
				    <div class="box dark">
				        <header>
				            <div class="icons"><i data-bind="visible:!model.userController.editMode()" class="fa fa-plus"></i>
				            	<i data-bind="visible:model.userController.editMode()" class="fa fa-edit"></i></div>
				            <h5 data-bind="visible:!model.userController.editMode()"> Nuevo Registro</h5> 
				            <h5 data-bind="visible:model.userController.editMode()"> Editar Registro</h5>          <!-- /.toolbar -->
				        </header>
				        <div class="body">
				            <form id="formulario" class="form-horizontal" data-bind="with: model.userController.user">

				            	<div class="form-group row">
				            		<div class="col-lg-4 col-md-4">
							            	<label for="foto">Foto</label>
							            	<input type="file" id="foto" name="foto" placeholder="seleccione foto" class="form-control" data-bind="event:{ change: model.userController.PreviewAvatar}"><br />
							            	<div class="fileinput-preview thumbnail" alt="arches">
							            		<img class="img-responsive" data-bind="attr:{src: (avatar() !== null ? ( avatar() !== '' ? '/img/'+avatar() : emptyLogo ) : emptyLogo)}" id="previewFoto" src="#" alt="fotografia" style="height: 200px; width: 80%"/>
							            	</div>
						            	</div>
					                	<div class="col-lg-4">
					                    <label for="text2">Email</label>
					                        <input type="email" id="email" name="email" placeholder="ingrese correo electronico" class="form-control"data-bind="value: email"
						                           data-error=".errorEmail" required>
						                    <span class="errorEmail text-danger help-inline"></span>
					                    </div>
					                    <div class="col-lg-4 col-md-4 col-sm-12">
					                    <label for="text2">Rol</label>
					                       <select class="form-control" id="ubicacion" data-bind="options: model.userController.tipoUsuarios, 
					                       optionsText: 'nombre', optionsValue: 'id',
					                       optionsCaption: '--seleccione--',
					                       value: tipo_usuario_id" 
					                       data-error=".errorTipo"
						                    required></select>
						                    <span class="errorTipo text-danger help-inline"></span>
					                    </div>

					                    <div data-bind="visible:!model.userController.editMode()">
				                    
						                    <div class="col-lg-4">
						                    <label for="text2">Contraseña <span class="text-danger"> *</span></label>
				                                <input type="password" id="password" name="password" placeholder="ingrese contraseña" class="form-control"data-bind="value: password"
				                                     data-error=".errorPassword"
				                                     minlength="6" maxlength="25" required>
				                              <span class="text-danger errorPassword help-inline"></span>
						                    </div>
							                 <div class="col-lg-4">
							                    <label for="text2">Confirmar contraseña <span class="text-danger"> *</span></label>
			                                	<input type="password" id="password_confirmation" name="password_confirmation" placeholder="ingrese correo electronico" class="form-control"data-bind="value: password_confirmation"
			                                     data-error=".errorConfirmation"
			                                     minlength="6" maxlength="25" required>
			                              		<span class="text-danger errorConfirmation help-inline"></span>
						                    </div>
						                </div>
				            	</div>

				                
				                <div class="form-group">
				                	<div class="col-md-12 text-right">					           
				                		<a class="btn btn-primary btn-sm" data-bind="click:  model.userController.createOrEdit"><i class="fa fa-save"></i> Guardar</a>
					                	<a class="btn btn-danger btn-sm" data-bind="click: model.userController.cancelar"><i class="fa fa-undo"></i> Cancelar</a>
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
            model.userController.initialize();
        });
</script>
@endsection
