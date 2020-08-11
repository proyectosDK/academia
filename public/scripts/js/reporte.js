model.reporteController = {
    ciclo_id: ko.observable(null),
    ciclos: ko.observableArray([]),
    inscripciones: ko.observableArray([]),
    ciclo: ko.observable(""),

    getCiclos: function(){
        var self = model.reporteController;

        //llamada al servicio
        cicloService.getAll()
        .then(r => {
            self.ciclos(r.data)
        })
        .catch(r => {});
    },

    getInscripciones: function(){
        var self = model.reporteController;

        self.ciclo(self.ciclos().find(c=>c.id == self.ciclo_id()).ciclo);

        if (!model.validateForm('#formulario')) { 
            return;
        }

        //llamada al servicio
        reporteService.getInscripciones(self.ciclo_id())
        .then(r => {
            self.inscripciones(r.data)
        })
        .catch(r => {});
    },

    print: function(){
        let self = model.reporteController;

        reporteService.printInscripciones(self.ciclo_id())
        .then(r => {
            
        })
        .catch(r => {});
    },

    initialize: function(){
        let self = model.reporteController;
        self.getCiclos();
    }
};