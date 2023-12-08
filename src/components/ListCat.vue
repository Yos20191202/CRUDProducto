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

          <tr v-for="cat in cat" :key="cat.id">
            <td>{{ cat.id }}</td>
            <td>{{ cat.tipo }}</td>
            <td>{{ cat.descripcion }}</td>
            <td>
              <div class="btn-group" role="group" aria-label="">
                <router-link :to="{ name: 'EditarCat', params: { id: cat.id } }" class="btn btn-info">Editar</router-link>
                <button type="button" @click="borrarCat(cat.id)" class="btn btn-danger">Borrar</button>
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
      cat: []
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
          this.cat = []
          if (typeof datosRespuesta[0].success === 'undefined') {
            this.cat = datosRespuesta
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
