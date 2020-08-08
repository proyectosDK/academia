//servicios con axios para consumir controladores
institucionesEducativaService = {
//peticion a funcion index
    getAll() {
        return axios.get(`institucionesEducativas`);
    },
//peticion a funcion get
    get(id) {
        let self = this;
        return self.axios.get(`${self.baseUrl}/${id}`);
    },
//peticion a funcion create
    create(data) {
        return axios.post(`institucionesEducativas`, data);
    },
//peticion a funcion update
    update(data) {
        return axios.put(`institucionesEducativas/${data.id}`,data);
    },
//peticion a funcion destroy
    destroy(data){
        return axios.delete(`institucionesEducativas/${data.id}`);
    }

}