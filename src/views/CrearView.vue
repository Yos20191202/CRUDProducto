<template>
  <div>
    <h2>Agregar Nuevo Producto</h2>

    <form v-on:submit.prevent="agregarProducto">
      <div>
        <label for="nombre">Nombre:</label>
        <input type="text" v-model="nuevoProducto.nombre" required />
      </div>

      <div>
        <label for="descripcion">Descripción:</label>
        <textarea v-model="nuevoProducto.descripcion" required></textarea>
      </div>

      <div>
        <label for="nombre">Talla:</label>
        <select v-model="nuevoProducto.talla" required>
          <option
            v-for="talla in tallasDisponibles"
            :key="talla"
            :value="talla"
          >
            {{ talla }}
          </option>
        </select>
      </div>

      <div>
        <label for="nombre">Estilo:</label>
        <input type="text" v-model="nuevoProducto.estilo" required />
      </div>

      <div>
        <label for="nombre">Imagen:</label>
        <select v-model="nuevoProducto.f_img" required @change="cargarImagen">
          <option v-for="opcion in opcionesFImg" :key="opcion.id" :value="opcion.id">
            {{ opcion.id }}
          </option>
        </select>

        <!-- Mostrar la imagen seleccionada -->
        <img v-if="imagenSeleccionada" :src="imagenSeleccionada" alt="Imagen seleccionada" />
      </div>


      <div>
        <label for="nombre">Categoría:</label>
        <select v-model="nuevoProducto.f_cat" required>
          <option
            v-for="opcion in opcionesFCat"
            :key="opcion.value"
            :value="opcion.value"
          >
            {{ opcion.label }}
          </option>
        </select>
      </div>

      <div>
        <button class="btn btn-success" type="submit">Agregar Producto</button>
        <router-link to="/listar">Cancelar</router-link>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  data() {
    return {
      nuevoProducto: {
        // Otras propiedades del nuevo producto
        //f_img: null,
      },
      tallasDisponibles: ["S", "M", "L", "XL", "XXL"],
      opcionesFImg: [],
      opcionesFCat: [], // Se llenará dinámicamente al montar el componente
      imagenSeleccionada: null,
    };
  },
  mounted() {
    // Llamar a la función para obtener las categorías cuando el componente está montado
    this.obtenerCategorias();
    this.obtenerImagenes();
  },
  methods: {
    obtenerCategorias() {
      fetch("https://yeremmihost.000webhostapp.com/tienda01/categoria.php/?obtener_categorias=1")
        .then((respuesta) => respuesta.json())
        .then((datosCategorias) => {
          // Asignar las categorías a la propiedad opcionesFCat
          this.opcionesFCat = datosCategorias.map((categoria) => {
            return { label: categoria.tipo, value: categoria.id };
          });
        });
    },

    obtenerImagenes() {
      fetch("https://yeremmihost.000webhostapp.com/tienda01/imagen.php/?obtener_imagenes=1")
        .then((respuesta) => respuesta.json())
        .then((datosImagenes) => {
          // Asignar las imágenes a la propiedad opcionesFImg
          this.opcionesFImg = datosImagenes.map((imagen) => {
            return { id: imagen.id, nombre: imagen.imagen };
          });
        });
    },

    agregarProducto() {
      var datosEnviar = {
        nombre: this.nuevoProducto.nombre,
        descripcion: this.nuevoProducto.descripcion,
        talla: this.nuevoProducto.talla,
        estilo: this.nuevoProducto.estilo,
        f_img: this.nuevoProducto.f_img,
        f_cat: this.nuevoProducto.f_cat,
      };

      fetch("https://yeremmihost.000webhostapp.com/tienda01/?insertar_producto=1", {
        method: "POST",
        body: JSON.stringify(datosEnviar),
        headers: {
          "Content-Type": "application/json",
        },
      })
        .then((respuesta) => respuesta.json())
        .then((datosRespuesta) => {
          console.log(datosRespuesta);
          window.location.href = "/listar";
        });
    },
  },
};
</script>

<style>
/* Estilos opcionales para mejorar la apariencia */
form {
  max-width: 400px;
  margin: 20px auto;
}

label {
  display: block;
  margin-bottom: 5px;
}

input,
textarea,
select {
  width: 100%;
  padding: 8px;
  margin-bottom: 10px;
}

button {
  background-color: #4caf50;
  color: white;
  padding: 10px 15px;
  border: none;
  cursor: pointer;
}

button:hover {
  background-color: #45a049;
}
</style>
