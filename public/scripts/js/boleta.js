model.boletaController = {

    boleta: {
        alumno_id: ko.observable(null),
        ciclo_id: ko.observable(null)
    },

    info: {
        alumno: ko.observableArray(""),
        codigo: ko.observable(""),
        direccion: ko.observable(""),
        ciclo: ko.observable(""),
        foto: ko.observable("")
    },

    alumnos: ko.observableArray([]),
    ciclos: ko.observableArray([]),
    notas: ko.observableArray([]),

    setAlumno: function(){
        let self = this
        var id = self.boleta.alumno_id();
        var ciclo_id = self.boleta.ciclo_id();
        var alumno = self.alumnos().find(x=>x.id == id);
        var ciclo = self.ciclos().find(x=>x.id == ciclo_id);
        self.info.alumno(alumno.primer_nombre+' '+alumno.segundo_nombre+' '+alumno.primer_apellido+' '+alumno.segundo_apellido);
        self.info.codigo(alumno.id);
        self.info.foto(alumno.foto);
        self.info.direccion(alumno.direccion+' '+alumno.municipio.nombre+' '+alumno.municipio.departamento.nombre);
        self.info.ciclo(ciclo.ciclo);
    },

    setData: function(data){
        let self = model.boletaController;
        data.forEach(function(d){
            nota = {
                pb: null,
                sb: null,
                tb: null,
                cb: null,
                nf: 0,
                estado: 3
            };
            d.nota_curso.forEach(function(n){
                if(n.nota_c.bimestre.nombre.toLowerCase() == 'primer bimestre'){
                   nota.pb = n.nota
                }
                if(n.nota_c.bimestre.nombre.toLowerCase() == 'segundo bimestre'){
                   nota.sb = n.nota
                }
                if(n.nota_c.bimestre.nombre.toLowerCase() == 'tercer bimestre'){
                   nota.tb = n.nota
                }
                if(n.nota_c.bimestre.nombre.toLowerCase() == 'cuarto bimestre'){
                   nota.cb = n.nota
                }
                
            });

            nota.nf = parseInt(((nota.pb == null ? 0 : nota.pb)
                                +(nota.sb == null ? 0 : nota.sb)
                                +(nota.tb == null ? 0 : nota.tb)
                                +(nota.cb == null ? 0 : nota.cb)) / 4)

            if(nota.pb !== null && nota.sb && nota.tb !== null && nota.cb !== null){
                nota.nf < 60 ? nota.estado = 0 : nota.estado = 1
            };

            self.notas.push({
                curso: d.curso.nombre,
                nota: nota
            })
        });
    },

    buscar: function(){
        let self = model.boletaController;

        if (!model.validateForm('#formulario')) { 
            return;
        }

        self.setAlumno();

        $('#ver').modal('show');
        notaService.getBoleta(self.boleta.alumno_id(),self.boleta.ciclo_id())
        .then(r => {
            self.setData(r.data)
        })
        .catch(r => {});
    },

    getAlumnos:function(){
        let self = model.boletaController;
        //llamada al servicio
        alumnoService.getAll()
        .then(r => {
            r.data = JSON.parse(JSON.stringify(r.data).replace(/null/g, '""'))
            self.alumnos(r.data);
        })
        .catch(r => {});
    },

    getCiclos: function(){
        let self = model.boletaController;
        cicloService.getAll().
        then(r=>{
            self.ciclos(r.data);
        }).catch(r=>{});
    },

    cancelar: function(){
        let self = model.boletaController;
        self.notas([]);
    },

    initialize: function () {
        var self = model.boletaController;
        self.getAlumnos();
        self.getCiclos();
    }
};