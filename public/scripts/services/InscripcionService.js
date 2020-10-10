inscripcionService = {
    getAll() {
        return axios.get(`inscripcions`);
    },

    get(id) {
        let self = this;
        return self.axios.get(`${self.baseUrl}/${id}`);
    },

    create(data) {
        return axios.post(`inscripcions`, data);
    },

    update(data) {
        return axios.put(`inscripcions/${data.id}`,data);
    },

    destroy(data){
        return axios.delete(`inscripcions/${data.id}`);
    }

}