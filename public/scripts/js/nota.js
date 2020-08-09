//controller que se encarga de interactuar con la vista y con los servicios axios
model.notaController = {

    nota: {
        id: ko.observable(null),
        ciclo_id: ko.observable(null),
        bimestre_id: ko.observable(null)
    },

    curso: {
        nombre: ko.observable("")
    },

    notas: ko.observableArray([]),
    bimestres: ko.observableArray([]),
    ciclos: ko.observableArray([]),
    cursos: ko.observableArray([]),
    inscripciones: ko.observableArray([]),
    alumnos: ko.observableArray([]),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    insertMode: ko.observable(false),

    //mapear funcion para editar
    map: function (data) {
        let self = model.notaController;
        var form = model.notaController.notas;
        form.id(data.id);
        form.ciclo_id(data.ciclo_id);
        form.bimestre_id(data.bimestre_id);
    
    },

    //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.notaController;
       self.clearData();
       self.curso.nombre("");

       self.insertMode(true);
       self.gridMode(false);
    },
   //limpiar formulario
    clearData: function(){
       let self = model.notaController;

        Object.keys(self.nota).forEach(function(key,index) {
          if(typeof self.nota[key]() === "string") 
            self.notas[key]("")
          else if (typeof self.nota[key]() === "boolean") 
            self.notas[key](true)
          else if (typeof self.nota[key]() === "number") 
            self.nota[key](null)
        });
    },


    //editar registros del formulario
    editar: function (data){
        let self = model.notaController;
        self.map(data);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(true);
    },

    createOrEdit(){
        let self = model.notaController;
     //validar formulario
        if (!model.validateForm('#formulario')) { 
            return;
        }

        self.notas.id() === null ? self.create() : self.update()
    },
//crear o editar registro, segun condicion if.
    create: function () {
        let self = model.notaController;
        var data = self.nota;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        notaService.create(dataParams)
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
        let self = model.notaController;
        var data = self.nota;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        notaService.update(dataParams)
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
        let self= model.notaController;
        bootbox.confirm({ 
            title: "eliminar notas",
            message: "¿Esta seguro que quiere eliminar notas ?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    notaService.destroy(data)
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
        let self = model.notaController;
        self.volverIndex();

        model.clearErrorMessage('#formulario');
    },
//funcion para cancelar registro
    volverIndex(){
        let self = model.notaController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true)
        self.clearData()
        self.initialize()
    },

    getCiclos(){
        var self = model.notaController;
        //llamada al servicio
        cicloService.getAll()
        .then(r => {
            self.ciclos(r.data);
        })
        .catch(r => {});
    },

    getCursos(){
        var self = model.notaController;
        //llamada al servicio
        cursoService.getAll()
        .then(r => {
            self.cursos(r.data);
        })
        .catch(r => {});
    },

    getBimestres(){
        var self = model.notaController;
        //llamada al servicio
        bimestreService.getAll()
        .then(r => {
            self.bimestres(r.data);
        })
        .catch(r => {});
    },

    //traer inscripciones
    getInscripciones(){
        let self = model.notaController;

        if (!model.validateForm('#formulario')) { 
            return;
        }

        cicloService.getInscripciones(self.nota.ciclo_id())
        .then(r => {
            self.inscripciones(r.data);
        })
        .catch(r => {});
    },

    //obtener alumnos del curso
    getAlumnos(curso){
        let self = model.notaController;
        self.curso.nombre(curso.nombre);
        self.alumnos([]);

        self.inscripciones().forEach(function(i) {
            if (i.cursos.some(c => c.curso_id === curso.id)){
              self.alumnos.push(i);
            }
        });
    },



//archivo que se ejecuta al inicio cuando se carga la vista, lista todos los registros
    initialize: function () {
        var self = model.notaController;

        //llamada al servicio
        notaService.getAll()
        .then(r => {
            self.notas(r.data);
        })
        .catch(r => {});

        self.getCiclos();
        self.getBimestres();
        self.getCursos();
    }
};