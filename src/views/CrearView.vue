<!-- CrearView.vue -->
<template>
    <div>
      <h2>Agregar Nuevo Producto</h2>
  
      <form v-on:submit.prevent="agregarProducto">
        <div>
          <label for="nombre">Nombre:</label>
          <input type="text" v-model="nuevoProducto.nombre" required>
        </div>
  
        <div>
          <label for="descripcion">Descripción:</label>
          <textarea v-model="nuevoProducto.descripcion" required></textarea>
        </div>

        <div>
          <label for="nombre">Talla:</label>
          <input type="text" v-model="nuevoProducto.talla" required>
        </div>

        <div>
          <label for="nombre">Estilo:</label>
          <input type="text" v-model="nuevoProducto.estilo" required>
        </div>

        <div>
          <label for="nombre">Imagen:</label>
          <input type="text" v-model="nuevoProducto.f_img" required>
        </div>

        <div>
          <label for="nombre">Categoria:</label>
          <input type="text" v-model="nuevoProducto.f_cat" required>
        </div>
  
        <!-- Agrega más campos según tus necesidades -->
  
        <div>
          <button type="submit">Agregar Producto</button>
          <router-link to="/listar">Cancelar</router-link>
        </div>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        nuevoProducto: {}
      };
    },
    methods: {
      agregarProducto() {
        console.log(this.nuevoProducto)
        var datosEnviar = {
            nombre: this.nuevoProducto.nombre, 
            descripcion: this.nuevoProducto.descripcion,
            talla: this.nuevoProducto.talla,
            estilo: this.nuevoProducto.estilo,
            f_img: this.nuevoProducto.f_img,
            f_cat: this.nuevoProducto.f_cat,
        }
        // Realiza la solicitud para agregar el nuevo producto
        // Usa axios o fetch para realizar la solicitud POST
        // Ajusta la URL según tu estructura en el servidor
        fetch('http://localhost/tienda01/?insertar_producto=1',{
            method: 'POST',
            body: JSON.stringify(datosEnviar),
            headers:{
                'Content-Type': 'application/json'
            }
        })
        .then(respuesta => respuesta.json())
        .then(datosRespuesta => {
            console.log(datosRespuesta)
            window.location.href = "/listar"

        })
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
  textarea {
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
  