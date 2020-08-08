//controller que se encarga de interactuar con la vista y con los servicios axios
model.institucionesEducativaController = {

    institucionesEducativa: {
        id: ko.observable(null),
        nombre: ko.observable(""),
        municipio_id: ko.observable(null),
        telefono: ko.observable(""),
        direccion: ko.observable("direccion"),
        email: ko.observable("email")
    },

    institucionesEducativas: ko.observableArray([]),
    departamentos: ko.observableArray([]),
    municipios: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    //tipoOpcion: [{ nombre: 'Producto', valor: 'P' }, { nombre: 'Materia Prima', valor: 'M' }, { nombre: 'Vehiculo', valor: 'V' }],


    //mapear funcion para editar
    map: function (data) {
        let self = model.institucionesEducativaController;
        var form = model.institucionesEducativaController.institucionesEducativa;
        form.id(data.id);
        form.nombre(data.nombre);
        self.setMunicipios(data.municipio.departamento);
        form.municipio_id(data.municipio_id);
        form.telefono(data.telefono);
        form.direccion(data.direccion);
        form.email(data.email);
        //$('#departamento').selectpicker('refresh');
    },

    //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.institucionesEducativaController;
       self.clearData();

       self.insertMode(true);
       self.gridMode(false);
    },
   //limpiar formulario
    clearData: function(){
       let self = model.institucionesEducativaController;

        Object.keys(self.institucionesEducativa).forEach(function(key,index) {
          if(typeof self.institucionesEducativa[key]() === "string") 
            self.institucionesEducativa[key]("")
          else if (typeof self.institucionesEducativa[key]() === "boolean") 
            self.institucionesEducativa[key](true)
          else if (typeof self.institucionesEducativa[key]() === "number") 
            self.institucionesEducativa[key](null)
        });
    },


    //editar registros del formulario
    editar: function (data){
        let self = model.institucionesEducativaController;
        self.map(data);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(true);
    },

    createOrEdit(){
        let self = model.institucionesEducativaController;
     //validar formulario
        if (!model.validateForm('#formulario')) { 
            return;
        }

        self.institucionesEducativa.id() === null ? self.create() : self.update()
    },
//crear o editar registro, segun condicion if.
    create: function () {
        let self = model.institucionesEducativaController;
        var data = self.institucionesEducativa;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        institucionesEducativaService.create(dataParams)
        .then(r => {
           toastr.info('registro agregado con éxito','exito');
            self.volverIndex();  
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },
//crear registro, manda a llamar el create del service
     update: function () {
        let self = model.institucionesEducativaController;
        var data = self.institucionesEducativa;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        institucionesEducativaService.update(dataParams)
        .then(r => {
            toastr.info("registro actualizado con éxito",'éxito');
            $('#nuevo').modal('hide');
            self.volverIndex();
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },

    //funcion para actualizar
    destroy: function (data) {
        let self= model.institucionesEducativaController;
        bootbox.confirm({ 
            title: "eliminar institucionesEducativa",
            message: "¿Esta seguro que quiere eliminar " + data.nombre + "?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    institucionesEducativaService.destroy(data)
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
//funcion para eliminar registro
    cancelar: function () {
        let self = model.institucionesEducativaController;
        self.volverIndex();

        model.clearErrorMessage('#formulario');
    },
//funcion para cancelar registro
    volverIndex(){
        let self = model.institucionesEducativaController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true)
        self.clearData()
        self.initialize()
    },
//funcion para volver al index, resetea variables de bandera
    getDepartamentos(){
        var self = model.institucionesEducativaController;
        //llamada al servicio
        departamentoService.getAll()
        .then(r => {
            self.departamentos(r.data);
        })
        .catch(r => {});
    },

     setMunicipios: function(departamento){
        let self = model.institucionesEducativaController;
        self.departamentos().forEach(function(d){
            if(d.id == departamento.id){
                self.municipios(d.municipios);
            }
        })
    },
//archivo que se ejecuta al inicio cuando se carga la vista, lista todos los registros
    initialize: function () {
        var self = model.institucionesEducativaController;

        //llamada al servicio
        institucionesEducativaService.getAll()
        .then(r => {
            self.institucionesEducativas(r.data);
        })
        .catch(r => {});

        self.getDepartamentos();
    }
};