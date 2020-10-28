//controller que se encarga de interactuar con la vista y con los servicios axios
model.notaController = {

    nota: {
        id: ko.observable(null),
        ciclo_id: ko.observable(null),
        bimestre_id: ko.observable(null),
        notas: ko.observableArray([])
    },

    curso: {
        id: ko.observable(null),
        nombre: ko.observable("")
    },

    notas: ko.observableArray([]),
    notasArray: ko.observableArray([]),
    bimestres: ko.observableArray([]),
    ciclos: ko.observableArray([]),
    cursos: ko.observableArray([]),
    current_cursos: ko.observableArray([]),
    inscripciones: ko.observableArray([]),
    alumnos: ko.observableArray([]),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    insertMode: ko.observable(false),

    //mapear funcion para editar
    map: function (data) {
        let self = model.notaController;
        var form = model.notaController.nota;
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
        self.nota.notas([]);
        self.inscripciones([]);
    },


    //editar registros del formulario
    editar: function (data){
        let self = model.notaController;
        self.inscripciones([]);
        self.nota.notas([]);
        self.curso.nombre("");
        self.map(data);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(false);

        self.getInscripciones();

        /*notaService.getNotas(data.id)
        .then(r => {
            console.log(r.data)
        })
        .catch(r => {});*/


    },

    createOrEdit(){
        let self = model.notaController;

     //validar formulario
        if (!model.validateForm('#formulario')) { 
            return;
        }

        self.nota.id() === null ? self.create() : self.update()
    },
//crear o editar registro, segun condicion if.
    create: function () {
        let self = model.notaController;
        var data = self.nota;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        notaService.create(dataParams)
        .then(r => {
            toastr.info('notas de '+self.curso.nombre()+' asignadas con','exito');
            self.getAll();
            //self.volverIndex();  
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
            toastr.info("nostas actualizadas "+self.curso.nombre()+" con éxito",'éxito');
            self.getInscripciones();
            //self.curso.nombre("");
            //self.nota.notas([]);
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
                       

                        //self.volverIndex();
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
    volverIndex: function (){
        let self = model.notaController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true)
        self.clearData()
        self.initialize()
    },

    getCiclos: function(){
        var self = model.notaController;
        //llamada al servicio
        cicloService.getAll()
        .then(r => {
            self.ciclos(r.data);
        })
        .catch(r => {});
    },

    getCursos: function(){
        var self = model.notaController;
        //llamada al servicio
        cursoService.getAll()
        .then(r => {
            self.cursos(r.data);
            self.current_cursos(r.data);
        })
        .catch(r => {});
    },

    getBimestres: function(){
        var self = model.notaController;
        //llamada al servicio
        bimestreService.getAll()
        .then(r => {
            self.bimestres(r.data);
        })
        .catch(r => {});
    },


    //limpiar cursos de bimestres asignados
    clearCursos: function(){
        let self = model.notaController;
        self.nota.notas([]);
        self.curso.nombre("");
        self.cursos(ko.toJS(self.current_cursos()));

        self.notas().forEach(function(n){
            self.current_cursos().forEach(function(c){
                var e = n.notas_cursos.some(nc => nc.curso_inscripcion.curso_id === c.id);
                if(e && n.bimestre_id == self.nota.bimestre_id() && n.ciclo_id == self.nota.ciclo_id()){
                    self.removeCursos(c.id)
                }
            });
        });
    },


    //función para limpiar y remover ciclos
    selectCursos: function(){
        let self = model.notaController;
        self.clearCursos();

        if (!model.validateForm('#formulario')) { 
            return;
        }
        self.getInscripciones();
    },

    //traer inscripciones
    getInscripciones: function(){
        let self = model.notaController;

        cicloService.getInscripciones(self.nota.ciclo_id())
        .then(r => {
            self.inscripciones(r.data);
        })
        .catch(r => {});
    },

    //obtener alumnos del curso
    getAlumnos: function(curso){
        let self = model.notaController;
        self.curso.nombre(curso.nombre);
        self.curso.id(curso.id);
        self.nota.notas([]);

        self.inscripciones().forEach(function(i) {
            //curso_inscripcion_id = i.cursos.find(x => x.curso_id === curso.id).id;
            curso_inscripcion = i.cursos.find(x => x.curso_id === curso.id);

            //i.cursos.some(c => c.curso_id === curso.id)
            
            if (curso_inscripcion){
                segundo_n = i.alumno.segundo_nombre !== null ? i.alumno.segundo_nombre : "";
                segundo_a = i.alumno.segundo_apellido !== null ? i.alumno.segundo_apellido : "";
                id = null;
                nota = null;

                nota_curso = curso_inscripcion.nota_curso.find(x => x.nota_c.bimestre_id === self.nota.bimestre_id()
                                                                    &&x.nota_c.ciclo_id === self.nota.ciclo_id());

                if(nota_curso){
                    id = nota_curso.id;
                    nota = nota_curso.nota;
                }else{
                    if(self.editMode()){return}
                }

                al = {
                    id: id,
                    nombre: i.alumno.primer_nombre+' '+segundo_n+i.alumno.primer_apellido+' '+segundo_a,
                    cursos_inscripcion_id: curso_inscripcion.id,
                    nota: nota
                };
                self.nota.notas.push(al);
            }
        });
    },

    //setear notas array
    setNotasArray: function(){
        let self = model.notaController;
        for (var i = 0; i <= 100; i++) {
            self.notasArray.push(i)
        }
    },

    //remover curso
    removeCursos: function(id){
        let self = model.notaController;
        //self.cursos(ko.toJS(self.current_cursos()));
        self.cursos.remove(function(e) {
            return e.id == id;
        });
    },

    //oteneter todas
    getAll: function(){
        let self = model.notaController;
        notaService.getAll()
        .then(r => {
            self.notas(r.data);
            self.clearCursos()
        })
        .catch(r => {});
    },


//archivo que se ejecuta al inicio cuando se carga la vista, lista todos los registros
    initialize: function () {
        var self = model.notaController;
        //llamada al servicio
        self.getAll();

        self.getCiclos();
        self.getBimestres();
        self.getCursos();
        self.setNotasArray();
    }
};