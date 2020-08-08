model.bimestreController = {

    bimestre: {
        id: ko.observable(null),
        nombre: ko.observable("")
    },

    bimestres: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    //tipoOpcion: [{ nombre: 'Producto', valor: 'P' }, { nombre: 'Materia Prima', valor: 'M' }, { nombre: 'Vehiculo', valor: 'V' }],


    //mapear funcion para editar
    map: function (data) {
        var form = model.bimestreController.bimestre;
        form.id(data.id);
        form.nombre(data.nombre);
    },

    //nuevo registro, limpiar datos del formulario
    nuevo: function () {
       let self = model.bimestreController;
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
    },


    //editar registros del formulario
    editar: function (data){
        let self = model.bimestreController;
        self.map(data);

        self.editMode(true);
        self.gridMode(false);
        self.insertMode(true);
    },

    createOrEdit(){
        let self = model.bimestreController;
     //validar formulario
        if (!model.validateForm('#tipoForm')) { 
            return;
        }

        self.bimestre.id() === null ? self.create() : self.update()
    },

    create: function () {
        let self = model.bimestreController;
        var data = self.bimestre;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        bimestreService.create(dataParams)
        .then(r => {
           toastr.info('registro agregado con éxito','exito')
            self.returnGrid();  
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },

     update: function () {
        let self = model.bimestreController;
        var data = self.bimestre;
        var dataParams = ko.toJS(data);

        //llamada al servicio
        bimestreService.update(dataParams)
        .then(r => {
            toastr.info("registro actualizado con éxito",'éxito');
            self.returnGrid();
        })
        .catch(r => {
            toastr.error(r.response.data.error)
        });
    },


    destroy: function (data) {
        let self= model.bimestreController;
        bootbox.confirm({ 
            title: "eliminar tipo persona",
            message: "¿Esta seguro que quiere eliminar " + data.nombre + "?",
            callback: function(result){ 
                if (result) {
                    //llamada al servicio
                    bimestreService.destroy(data)
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
        let self = model.bimestreController;
        self.returnGrid();

        model.clearErrorMessage('#bimestreForm');
    },

    returnGrid(){
        let self = model.bimestreController;
        self.insertMode(false);
        self.editMode(false);
        self.gridMode(true)
        self.clearData()
        self.initialize()
    },

    initialize: function () {
        var self = model.bimestreController;

        //llamada al servicio
        bimestreService.getAll()
        .then(r => {
            self.bimestres(r.data);
        })
        .catch(r => {});
    }
};