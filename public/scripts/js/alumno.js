//controller que se encarga de interactuar con la vista y con los servicios axios
model.alumnoController = {
    alumno: {
        id: ko.observable(null),
        primer_nombre: ko.observable(""),
        segundo_nombre: ko.observable(""),
        primer_apellido: ko.observable(""),
        segundo_apellido: ko.observable(""),
        fecha_nac: ko.observable(""),
        foto: ko.observable(""),
        direccion: ko.observable(''),
        image_file: ko.observable(""),
        encargado_id: ko.observable(null),
        tipo_encargado: ko.observable(""),
        municipio_id: ko.observable(null),
        telefono: ko.observable("")
    },

    alumnos: ko.observableArray([]),
    departamentos: ko.observableArray([]),
    municipios: ko.observableArray([]),
    encargados: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    tipos: ko.observableArray([{text: 'padre',value:'P'},{text: 'madre',value:'M'},{text: 'representante',value:'R'}]),


    //mapear funcion para editar
    map: function (data) {
        let self = model.alumnoController;
        var form = self.alumno;
        form.id(data.id);
        form.primer_nombre(data.primer_nombre);
        form.segundo_nombre(data.segundo_nombre);
        form.primer_apellido(data.primer_apellido);
        form.segundo_apellido(data.segundo_apellido);
        form.telefono(data.telefono);
        form.direccion(data.direccion);
        form.foto(data.foto);
        form.fecha_nac(data.fecha_nac);

        self.setMunicipios(data.municipio.departamento);
        form.municipio_id(data.municipio_id);
        form.encargado_id(data.encargado_id);
        form.tipo_encargado(data.tipo_encargado);
        form.telefono(data.telefono);
    },

  //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.alumnoController;
       self.clearData();

       self.insertMode(true);
       self.gridMode(false);
    },

    clearData: function(){
       let self = model.bimestreController;

        Object.keys(self.bimestre).forEach(function(key,index) {
          if(typeof self.bimestre[key]() === "string") 
            self.bimestre[key]("")
          else if (typeof self.bimestre[key]() === "boolean") 
            self.bimestre[key](true)
          else if (typeof self.bimestre[key]() === "number") 
            self.bimestre[key](null)
        });

        $("#foto").val(null);
    },

   //editar registros del formulario
    editar: function (data){
        let self = model.alumnoController;
        self.map(data);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(true);
    },

//crear o editar registro, segun condicion if.
    createOrEdit(){
     //validar formulario
        let self= model.alumnoController;
        if (!model.validateForm('#formulario')) { 
            return;
        }

        self.alumno.id() === null ? self.create() : self.update()
    },

//crear registro, manda a llamar el create del service
    create: function () {
        let self = model.alumnoController;
        var data = self.alumno;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        alumnoService.create(dataParams)
        .then(r => {
           toastr.info('registro agregado con éxito','exito')
            self.volverIndex();
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },

    //funcion para actualizar registro
     update: function () {
        let self = model.alumnoController;
        var data = self.alumno;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        alumnoService.update(dataParams)
        .then(r => {
            toastr.info("registro actualizado con éxito",'éxito');
            self.volverIndex();
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },

//funcion para eliminar registro
    destroy: function (data) {
        let self= model.alumnoController;
        bootbox.confirm({ 
            title: "eliminar alumno",
            message: "¿Esta seguro que quiere eliminar " + data.cui + "?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    alumnoService.destroy(data)
                    .then(r => {
                        toastr.info("registro eliminado éxito",'éxito');
                        self.volverIndex();
                    })
                    .catch(r => {
                        toastr.error(r.response.data.error)
                    });
                }
            }
        })
    },

//funcion para cancelar registro
    cancelar: function () {
        let self = model.alumnoController;
        self.volverIndex();

        model.clearErrorMessage('#formulario');
    },

//funcion para volver al index, resetea variables de bandera
    volverIndex(){
        let self = model.alumnoController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true);
        self.clearData();
        self.initialize();
    },

    //image user profile
    PreviewAvatar: function () {
        let self = model.alumnoController;
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("foto").files[0]);

        oFReader.onload = function (oFREvent) {
            self.alumno.image_file = oFREvent.target.result;
            document.getElementById("previewFoto").src = oFREvent.target.result;
        };
    },

    //funcion para obtener departamentos
    getDepartamentos(){
        var self = model.alumnoController;
        //llamada al servicio
        departamentoService.getAll()
        .then(r => {
            self.departamentos(r.data);
        })
        .catch(r => {});
    },

     setMunicipios: function(departamento){
        let self = model.alumnoController;
        self.departamentos().forEach(function(d){
            if(d.id == departamento.id){
                self.municipios(d.municipios);
            }
        })
    },

    //funcion para volver al index, resetea variables de bandera
    getEncargados(){
        var self = model.alumnoController;
        //llamada al servicio
        encargadoService.getAll()
        .then(r => {
            self.encargados(r.data);
        })
        .catch(r => {});
    },

    getAll: function(){
        var self = model.alumnoController;

        alumnoService.getAll()
        .then(r => {
            self.alumnos(r.data);
        })
        .catch(r => {});
    },

//archivo que se ejecuta al inicio cuando se carga la vista, lista todos los registros
    initialize: function () {
        var self = model.alumnoController;

        //llamada al servicio
        alumnoService.getAll()
        .then(r => {
            self.alumnos(r.data);
        })
        .catch(r => {});

        self.getEncargados();
        self.getDepartamentos();
    }
};