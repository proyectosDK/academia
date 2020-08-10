notaService = {
    getAll() {
        return axios.get(`notas`);
    },

    get(id) {
        return self.axios.get(`notas/${id}`);
    },

    getNotas(id) {
        return self.axios.get(`notas/${id}/cursos`);
    },

    getBoleta(alumno_id,ciclo_id) {
        return self.axios.get(`notas/${alumno_id}/${ciclo_id}`);
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