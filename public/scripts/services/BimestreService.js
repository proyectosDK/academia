bimestreService = {
    getAll() {
        return axios.get(`bimestres`);
    },

    get(id) {
        let self = this;
        return self.axios.get(`${self.baseUrl}/${id}`);
    },

    create(data) {
        return axios.post(`bimestres`, data);
    },

    update(data) {
        return axios.put(`bimestres/${data.id}`,data);
    },

    destroy(data){
        return axios.delete(`bimestres/${data.id}`);
    }

}