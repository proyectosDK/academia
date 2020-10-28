model.cicloController = {

    ciclo: {
        id: ko.observable(null),
        ciclo: ko.observable(""),
        inicio: ko.observable(""),
        fin: ko.observable("")
    },

    ciclos: ko.observableArray([]),
    info_ciclos: ko.observableArray([]),//arreglo para guardar para dashboard
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    //tipoOpcion: [{ nombre: 'Producto', valor: 'P' }, { nombre: 'Materia Prima', valor: 'M' }, { nombre: 'Vehiculo', valor: 'V' }],


    //mapear funcion para editar
    map: function (data) {
        var form = model.cicloController.ciclo;
        form.id(data.id);
        form.ciclo(data.ciclo);
        form.inicio(data.inicio);
        form.fin(data.fin);
    },

    //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.cicloController;
       self.clearData();

       self.insertMode(true);
       self.gridMode(false);
    },

    clearData: function(){
       let self = model.cicloController;

        Object.keys(self.ciclo).forEach(function(key,index) {
          if(typeof self.ciclo[key]() === "string") 
            self.ciclo[key]("")
          else if (typeof self.ciclo[key]() === "boolean") 
            self.ciclo[key](true)
          else if (typeof self.ciclo[key]() === "number") 
            self.ciclo[key](null)
        });
    },


    //editar registros del formulario
    editar: function (data){
        let self = model.cicloController;
        self.map(data);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(true);
    },

    createOrEdit(){
        let self = model.cicloController;
     //validar formulario
        if (!model.validateForm('#tipoForm')) { 
            return;
        }

        self.ciclo.id() === null ? self.create() : self.update()
    },

    create: function () {
        let self = model.cicloController;
        var data = self.ciclo;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        cicloService.create(dataParams)
        .then(r => {
           toastr.info('registro agregado con éxito','exito')
            self.returnGrid();  
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },

     update: function () {
        let self = model.cicloController;
        var data = self.ciclo;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        cicloService.update(dataParams)
        .then(r => {
            toastr.info("registro actualizado con éxito",'éxito');
            self.returnGrid();
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },


    destroy: function (data) {
        let self= model.cicloController;
        bootbox.confirm({ 
            title: "eliminar tipo persona",
            message: "¿Esta seguro que quiere eliminar " + data.nombre + "?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    cicloService.destroy(data)
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
        let self = model.cicloController;
        self.returnGrid();

        model.clearErrorMessage('#formulario');
    },

    returnGrid(){
        let self = model.cicloController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true)
        self.clearData()
        self.initialize()
    },

    initialize: function () {
        var self = model.cicloController;

        //llamada al servicio
        cicloService.getAll()
        .then(r => {
            self.ciclos(r.data);
        })
        .catch(r => {});
    }
};