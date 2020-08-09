//controller que se encarga de interactuar con la vista y con los servicios axios
model.inscripcionController = {

    inscripcion: {
        id: ko.observable(null),
        alumno_id: ko.observable(null),
        ciclo_id: ko.observable(null),
        instituciones_educativa_id: ko.observable(null),
        fecha: ko.observable(""),
        cursos: ko.observableArray([])
    },

    inscripcions: ko.observableArray([]),
    alumnos: ko.observableArray([]),
    ciclos: ko.observableArray([]),
    cursos: ko.observableArray([]),
    instituciones: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    insertMode: ko.observable(false),

    //mapear funcion para editar
    map: function (data) {
        let self = model.inscripcionController;
        var form = model.inscripcionController.inscripcion;
        form.id(data.id);
        form.alumno_id(data.alumno_id);
        form.ciclo_id(data.ciclo_id);
        form.instituciones_educativa_id(data.instituciones_educativa_id);
        form.fecha(data.fecha);
        
        self.setCursos(data.cursos);
    },

    setCursos(cursos){
        let self = model.inscripcionController;
        self.inscripcion.cursos([]);
        //seteamos los presupuestos a los usuarios
        cursos.forEach(function(c){
            self.inscripcion.cursos.push(c.curso_id);
        });
    },

    //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.inscripcionController;
       self.clearData();

       self.insertMode(true);
       self.gridMode(false);
    },
   //limpiar formulario
    clearData: function(){
       let self = model.inscripcionController;

        Object.keys(self.inscripcion).forEach(function(key,index) {
          if(typeof self.inscripcion[key]() === "string") 
            self.inscripcion[key]("")
          else if (typeof self.inscripcion[key]() === "boolean") 
            self.inscripcion[key](true)
          else if (typeof self.inscripcion[key]() === "number") 
            self.inscripcion[key](null)
        });
        self.inscripcion.cursos([]);
    },


    //editar registros del formulario
    editar: function (data){
        let self = model.inscripcionController;
        self.map(data);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(true);
    },

    createOrEdit(){
        let self = model.inscripcionController;
     //validar formulario
        if (!model.validateForm('#formulario')) { 
            return;
        }

        self.inscripcion.id() === null ? self.create() : self.update()
    },
//crear o editar registro, segun condicion if.
    create: function () {
        let self = model.inscripcionController;
        var data = self.inscripcion;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        inscripcionService.create(dataParams)
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
        let self = model.inscripcionController;
        var data = self.inscripcion;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        inscripcionService.update(dataParams)
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
        let self= model.inscripcionController;
        bootbox.confirm({ 
            title: "eliminar inscripcion",
            message: "¿Esta seguro que quiere eliminar inscripcion ?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    inscripcionService.destroy(data)
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
        let self = model.inscripcionController;
        self.volverIndex();

        model.clearErrorMessage('#formulario');
    },
//funcion para cancelar registro
    volverIndex(){
        let self = model.inscripcionController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true)
        self.clearData()
        self.initialize()
    },
//funcion para volver al index, resetea variables de bandera
    getAlumnos(){
        var self = model.inscripcionController;
        //llamada al servicio
        alumnoService.getAll()
        .then(r => {
            self.alumnos(r.data);
        })
        .catch(r => {});
    },

    getCiclos(){
        var self = model.inscripcionController;
        //llamada al servicio
        cicloService.getAll()
        .then(r => {
            self.ciclos(r.data);
        })
        .catch(r => {});
    },

    getCursos(){
        var self = model.inscripcionController;
        //llamada al servicio
        cursoService.getAll()
        .then(r => {
            self.cursos(r.data);
        })
        .catch(r => {});
    },

    getInstituciones(){
        var self = model.inscripcionController;
        //llamada al servicio
        institucionesEducativaService.getAll()
        .then(r => {
            self.instituciones(r.data);
        })
        .catch(r => {});
    },
//archivo que se ejecuta al inicio cuando se carga la vista, lista todos los registros
    initialize: function () {
        var self = model.inscripcionController;

        //llamada al servicio
        inscripcionService.getAll()
        .then(r => {
            self.inscripcions(r.data);
        })
        .catch(r => {});

        self.getAlumnos();
        self.getCiclos();
        self.getInstituciones();
        self.getCursos();
    }
};