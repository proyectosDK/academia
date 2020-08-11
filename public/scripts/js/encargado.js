//controller que se encarga de interactuar con la vista y con los servicios axios
model.encargadoController = {

    encargado: {
        id: ko.observable(null),
        cui: ko.observable(""),
        nit: ko.observable(""),
        primer_nombre: ko.observable(""),
        segundo_nombre: ko.observable(""),
        primer_apellido: ko.observable(""),
        segundo_apellido: ko.observable(""),
        municipio_id: ko.observable(null),
        telefono: ko.observable(""),
        direccion: ko.observable(""),
        fecha_nac: ko.observable("")
    },

    encargados: ko.observableArray([]),
    departamentos: ko.observableArray([]),
    municipios: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    //tipoOpcion: [{ nombre: 'Producto', valor: 'P' }, { nombre: 'Materia Prima', valor: 'M' }, { nombre: 'Vehiculo', valor: 'V' }],


    //mapear funcion para editar
    map: function (data) {
        let self = model.encargadoController;
        var form = model.encargadoController.encargado;
        form.id(data.id);
        form.cui(data.cui);
        form.nit(data.nit);
        form.primer_nombre(data.primer_nombre);
        form.primer_apellido(data.primer_apellido);
        form.segundo_nombre(data.segundo_nombre);
        form.segundo_apellido(data.segundo_apellido);

        self.setMunicipios(data.municipio.departamento);
        form.municipio_id(data.municipio_id);
        form.telefono(data.telefono);
        form.direccion(data.direccion);
        form.fecha_nac(data.fecha_nac);
        //$('#departamento').selectpicker('refresh');
    },

    //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.encargadoController;
       self.clearData();

       self.insertMode(true);
       self.gridMode(false);
    },
   //limpiar formulario
    clearData: function(){
       let self = model.encargadoController;

        Object.keys(self.encargado).forEach(function(key,index) {
          if(typeof self.encargado[key]() === "string") 
            self.encargado[key]("")
          else if (typeof self.encargado[key]() === "boolean") 
            self.encargado[key](true)
          else if (typeof self.encargado[key]() === "number") 
            self.encargado[key](null)
        });
    },


    //editar registros del formulario
    editar: function (data){
        let self = model.encargadoController;
        self.map(data);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(true);
    },

    createOrEdit(){
        let self = model.encargadoController;
     //validar formulario
        if (!model.validateForm('#formulario')) { 
            return;
        }

        self.encargado.id() === null ? self.create() : self.update()
    },
//crear o editar registro, segun condicion if.
    create: function () {
        let self = model.encargadoController;
        var data = self.encargado;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        encargadoService.create(dataParams)
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
        let self = model.encargadoController;
        var data = self.encargado;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        encargadoService.update(dataParams)
        .then(r => {
            toastr.info("registro actualizado con éxito",'éxito');
            self.volverIndex();
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },

    //funcion para actualizar
    destroy: function (data) {
        let self= model.encargadoController;
        bootbox.confirm({ 
            title: "eliminar encargado",
            message: "¿Esta seguro que quiere eliminar " + data.nombre + "?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    encargadoService.destroy(data)
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
        let self = model.encargadoController;
        self.volverIndex();

        model.clearErrorMessage('#formulario');
    },
//funcion para cancelar registro
    volverIndex(){
        let self = model.encargadoController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true)
        self.clearData()
        self.initialize()
    },
//funcion para volver al index, resetea variables de bandera
    getDepartamentos(){
        var self = model.encargadoController;
        //llamada al servicio
        departamentoService.getAll()
        .then(r => {
            self.departamentos(r.data);
        })
        .catch(r => {});
    },

     setMunicipios: function(departamento){
        let self = model.encargadoController;
        self.departamentos().forEach(function(d){
            if(d.id == departamento.id){
                self.municipios(d.municipios);
            }
        })
    },
//archivo que se ejecuta al inicio cuando se carga la vista, lista todos los registros
    initialize: function () {
        var self = model.encargadoController;

        //llamada al servicio
        encargadoService.getAll()
        .then(r => {
            r.data = JSON.parse(JSON.stringify(r.data).replace(/null/g, '""'))
            self.encargados(r.data);
        })
        .catch(r => {});

        self.getDepartamentos();
    }
};