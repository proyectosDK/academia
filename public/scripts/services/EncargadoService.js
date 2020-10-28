//servicios con axios para consumir controladores
encargadoService = {
//peticion a funcion index
    getAll() {
        return axios.get(`encargados`);
    },
//peticion a funcion get
    get(id) {
        let self = this;
        return self.axios.get(`${self.baseUrl}/${id}`);
    },
//peticion a funcion create
    create(data) {
        return axios.post(`encargados`, data);
    },
//peticion a funcion update
    update(data) {
        return axios.put(`encargados/${data.id}`,data);
    },
//peticion a funcion destroy
    destroy(data){
        return axios.delete(`encargados/${data.id}`);
    }

}