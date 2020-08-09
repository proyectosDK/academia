notaService = {
    getAll() {
        return axios.get(`notas`);
    },

    get(id) {
        let self = this;
        return self.axios.get(`${self.baseUrl}/${id}`);
    },

    create(data) {
        return axios.post(`notas`, data);
    },

    update(data) {
        return axios.put(`notas/${data.id}`,data);
    },

    destroy(data){
        return axios.delete(`notas/${data.id}`);
    }

}