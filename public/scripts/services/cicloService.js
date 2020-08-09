cicloService = {
    getAll() {
        return axios.get(`ciclos`);
    },

    get(id) {
        return self.axios.get(`ciclos/${id}`);
    },

    getInscripciones(id) {
        return self.axios.get(`ciclos/${id}/inscripciones`);
    },

    create(data) {
        return axios.post(`ciclos`, data);
    },

    update(data) {
        return axios.put(`ciclos/${data.id}`,data);
    },

    destroy(data){
        return axios.delete(`ciclos/${data.id}`);
    }

}