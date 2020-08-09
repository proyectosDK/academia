alumnoService = {
    getAll(tipo_id) {
        return axios.get(`alumnos`);
    },

    get(id) {
        let self = this;
        return axios.get(`alumnos/${id}`);
    },

    create(data) {
        return axios.post(`alumnos`, data);
    },

    update(data) {
        return axios.put(`alumnos/${data.id}`,data);
    },

    destroy(data){
        return axios.delete(`alumnos/${data.id}`);
    }

}