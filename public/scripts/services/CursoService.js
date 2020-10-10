cursoService = {
    getAll() {
        return axios.get(`cursos`);
    },

    get(id) {
        let self = this;
        return self.axios.get(`${self.baseUrl}/${id}`);
    },

    create(data) {
        return axios.post(`cursos`, data);
    },

    update(data) {
        return axios.put(`cursos/${data.id}`,data);
    },

    destroy(data){
        return axios.delete(`cursos/${data.id}`);
    }

}