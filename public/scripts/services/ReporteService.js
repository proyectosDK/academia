reporteService = {
    getInscripciones(id) {
        return self.axios.get(`consultas_inscripciones/${id}`);
    },

    printInscripciones(id) {
        return self.axios.get(`consultas_print_inscripciones/${id}`);
    }
}