<template>
  <div class="container">
    <div class="card">
      <div class="card-header">
        Agregar Nuevo Tipo
      </div>

      <div class="card-body">
        <form @submit.prevent="agregarRegistroC">
          <div class="form-group">
            <label for="tipo">Tipo:</label>
            <input type="text"
              class="form-control" required name="tipo" v-model="categoria.tipo" id="tipo" placeholder="Tipo">
            <small class="form-text text-muted">Escribe el tipo</small>
          </div>
          <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <input type="text"
              class="form-control" required name="descripcion" id="descripcion" v-model="categoria.descripcion" placeholder="Descripción">
            <small class="form-text text-muted">Agrega una descripción</small>
          </div>
          <div class="btn-group" role="group" aria-label="">
            <button type="submit" class="btn btn-success">Agregar</button>
            <router-link :to="{ name: 'ListCat' }" class="btn btn-warning">Cancelar</router-link>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      categoria: {
        tipo: "",
        descripcion: ""
      }
    };
  },
  methods: {
    agregarRegistroC() {
      // Validación del formulario
      if (!this.categoria.tipo || !this.categoria.descripcion) {
        alert("Por favor, completa todos los campos");
        return;
      }

      const datosEnviar = {
        tipo: this.categoria.tipo,
        descripcion: this.categoria.descripcion
      };

      fetch('https://tienda01.proyectowebuni.com/categoria.php/categoria/?insertar=1', {
        method: 'POST',
        body: JSON.stringify(datosEnviar),
        headers: {
          'Content-Type': 'application/json'
        }
      })
      .then(respuesta => respuesta.json())
      .then(datosRespuesta => {
        console.log(datosRespuesta);
        // Redirigir utilizando el enrutamiento programático
        this.$router.push({ name: 'ListCat' });
      })
      .catch(error => {
        console.error("Error al agregar categoría:", error);
        alert("Error al agregar categoría. Por favor, intenta nuevamente.");
      });
    }
  }
}
</script>
