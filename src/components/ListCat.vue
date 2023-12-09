<template>
  <div class="container">
    <router-link to="/crearCat" class="btn btn-success">Agregar nuevo Tipo</router-link>
    <br>
    <br>

    <div class="card">
      <div class="card-header">
        Cat
      </div>
      <div class="card-body">
        <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tipo</th>
                            <th>Descripcion</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>

          <tr v-for="categoria in categoria" :key="categoria.id">
            <td>{{ categoria.id }}</td>
            <td>{{ categoria.tipo }}</td>
            <td>{{ categoria.descripcion }}</td>
            <td>
              <div class="btn-group" role="group" aria-label="">
                <router-link :to="{ name: 'EditarCat', params: { id: categoria.id } }" class="btn btn-info">Editar</router-link>
                <button type="button" @click="borrarCat(categoria.id)" class="btn btn-danger">Borrar</button>
              </div>
            </td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      categoria: []
    };
  },
  created() {
    this.consultarCat();
  },
  methods: {
    consultarCat() {
      fetch('http://localhost/tienda01/categoria.php/')
        .then(respuesta => respuesta.json())
        .then(datosRespuesta => {
          console.log(datosRespuesta)
          this.categoria = []
          if (typeof datosRespuesta[0].success === 'undefined') {
            this.categoria = datosRespuesta
          }
        })
        .catch(error => console.log(error));
    },
    borrarCat(id) {
      console.log(id)
      fetch('http://localhost/tienda01/categoria.php/?borrar=' + id)
        .then(respuesta => respuesta.json())
        .then(datosRespuesta => {
          console.log(datosRespuesta)
          // Utiliza Vue Router para redirigir
          this.$router.push({ name: 'ListCat' });
        })
        .catch(error => console.log(error));
    }
  }
}
</script>
