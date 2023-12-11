<template>
  <div class="container">
    <div class="card">
      <div class="card-header">
        Editar Imagen
      </div>

      <div class="card-body">
        <form @submit.prevent="actualizarRegistro">
          <div class="form-group">
            <label for="imagen">Seleccionar Nueva Imagen:</label>
            <input type="file" class="form-control" name="imagen" @change="handleImagenChange" />
          </div>
          <div class="form-group">
            <!-- Muestra la vista previa de la imagen actual -->
            <img v-if="imagen.imagenUrl" :src="imagen.imagenUrl" alt="Imagen actual" class="imagen-actual" />
          </div>
          <div class="form-group">
            <label for="descripcion">Descripción:</label>
            <textarea class="form-control" required name="descripcion" id="descripcion" v-model="imagen.descripcion"
              placeholder="Descripción"></textarea>
          </div>
          <div class="btn-group" role="group" aria-label="">
            <button type="submit" class="btn btn-success">Modificar</button>
            <router-link :to="{ name: 'ListImg' }" class="btn btn-warning">Cancelar</router-link>
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
      imagen: {
        id: null,
        imagen: null,
        imagenUrl: null,
        descripcion: "",
      },
    };
  },
  created() {
    this.ObtenerDatos();
  },
  methods: {
    ObtenerDatos() {
      fetch('http://localhost/tienda01/imagen.php/?consultar=' + this.$route.params.id)
        .then(respuesta => respuesta.json())
        .then(datosRespuesta => {
          this.imagen = datosRespuesta[0];
        })
        .catch(error => console.error('Error al obtener datos:', error));
    },
    actualizarRegistro() {
      console.log("ID a actualizar:", this.imagen.id);

      // Verificar si es necesario actualizar
      if (!this.imagen.id || !this.imagen.descripcion) {
        console.error('ID o descripción faltante, no se puede actualizar.');
        return;
      }

      var formData = new FormData();
      formData.append('id', this.imagen.id);
      formData.append('descripcion', this.imagen.descripcion);

      if (this.imagen.imagen instanceof File) {
        formData.append('imagen', this.imagen.imagen);
      }

      fetch("http://localhost/tienda01/imagen.php/?actualizar=" + this.$route.params.id, {
        method: "POST",
        body: formData,
      })
        .then(respuesta => respuesta.json())
        .then(datosRespuesta => {
          console.log(datosRespuesta);
          if (datosRespuesta.success === 1) {
            // Vuelve a obtener la lista de imágenes después de la actualización exitosa
            this.ObtenerDatos();
            // Redirige a la lista de imágenes después de la actualización
            this.$router.push({ name: 'ListImg' });
          } else {
            console.error('Error en la actualización:', datosRespuesta.error);
          }
        })
        .catch(error => console.error('Error al procesar la respuesta:', error));
    },
    handleImagenChange(event) {
      if (event.target.files.length > 0) {
        this.imagen.imagen = event.target.files[0];
        // Mostrar la vista previa de la imagen seleccionada
        this.imagen.imagenUrl = URL.createObjectURL(event.target.files[0]);
      }
    },
  },
};
</script>

<style scoped>
.imagen-actual {
  max-width: 300px;
  margin-top: 10px;
}
</style>
