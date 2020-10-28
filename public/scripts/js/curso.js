model.cursoController = {

    curso: {
        id: ko.observable(null),
        nombre: ko.observable("")
    },

    cursos: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    //tipoOpcion: [{ nombre: 'Producto', valor: 'P' }, { nombre: 'Materia Prima', valor: 'M' }, { nombre: 'Vehiculo', valor: 'V' }],


    //mapear funcion para editar
    map: function (data) {
        var form = model.cursoController.curso;
        form.id(data.id);
        form.nombre(data.nombre);
    },

    //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.cursoController;
       self.clearData();

       self.insertMode(true);
       self.gridMode(false);
    },

    clearData: function(){
       let self = model.cursoController;

        Object.keys(self.curso).forEach(function(key,index) {
          if(typeof self.curso[key]() === "string") 
            self.curso[key]("")
          else if (typeof self.curso[key]() === "boolean") 
            self.curso[key](true)
          else if (typeof self.curso[key]() === "number") 
            self.curso[key](null)
        });
    },


    //editar registros del formulario
    editar: function (data){
        let self = model.cursoController;
        self.map(data);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(true);
    },

    createOrEdit(){
        let self = model.cursoController;
     //validar formulario
        if (!model.validateForm('#tipoForm')) { 
            return;
        }

        self.curso.id() === null ? self.create() : self.update()
    },

    create: function () {
        let self = model.cursoController;
        var data = self.curso;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        cursoService.create(dataParams)
        .then(r => {
           toastr.info('registro agregado con éxito','exito')
            self.returnGrid();  
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },

     update: function () {
        let self = model.cursoController;
        var data = self.curso;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        cursoService.update(dataParams)
        .then(r => {
            toastr.info("registro actualizado con éxito",'éxito');
            self.returnGrid();
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },


    destroy: function (data) {
        let self= model.cursoController;
        bootbox.confirm({ 
            title: "eliminar tipo persona",
            message: "¿Esta seguro que quiere eliminar " + data.nombre + "?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    cursoService.destroy(data)
                    .then(r => {
                        toastr.info("registro eliminado éxito",'éxito');
                        self.returnGrid();
                    })
                    .catch(r => {
                        toastr.error(r.response.data.error)
                    });
                }
            }
        })
    },

    cancelar: function () {
        let self = model.cursoController;
        self.returnGrid();

        model.clearErrorMessage('#tipoForm');
    },

    returnGrid(){
        let self = model.cursoController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true)
        self.clearData()
        self.initialize()
    },

    initialize: function () {
        var self = model.cursoController;

        //llamada al servicio
        cursoService.getAll()
        .then(r => {
            self.cursos(r.data);
        })
        .catch(r => {});
    }
};