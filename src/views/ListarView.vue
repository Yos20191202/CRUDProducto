<!-- ListarView.vue -->
<template>
    <div>
      <h2>Listado de Productos</h2>
      <router-link to="/crear">Agregar Nuevo Producto</router-link>
  
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Talla</th>
            <th>Estilo</th>
            <th>Imagen</th>
            <th>Categoría</th>
            <!-- Agrega más columnas según tus necesidades -->
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="producto in productos" :key="producto.id">
            <td>{{ producto.id }}</td>
            <td>{{ producto.nombre }}</td>
            <td>{{ producto.descripcion }}</td>
            <td>{{ producto.talla }}</td>
            <td>{{ producto.estilo }}</td>
            <td>{{ producto.f_img }}</td>
            <td>{{ producto.f_cat }}</td>
            <!-- Agrega más columnas según tus necesidades -->
  
            <!-- Botones de acciones -->
            <td>
              <router-link :to="{ name: 'Editar', params: { id: producto.id } }" class="btn btn-info">Editar</router-link>
              <button class="btn btn-danger" v-on:click="eliminarProducto(producto.id)">Borrar</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </template>
  
  <script>
import router from '../router';

  export default {
    data() {
        return {
            productos: [], // Almacena la lista de productos
        };
    },
    created() {
        // Cargar la lista de productos al iniciar el componente
        this.consultarProductos();
    },
    methods: {
        consultarProductos() {
            // Realiza la solicitud para obtener la lista de productos desde el servidor
            // Usa axios o fetch para realizar la solicitud GET
            // Ajusta la URL según tu estructura en el servidor
            fetch('https://yeremmihost.000webhostapp.com/tienda01/')
                .then(response => response.json())
                .then(data => {
                this.productos = data;
            })
                .catch(error => console.error('Error al obtener productos:', error));
        },

        eliminarProducto(id) {
          // Realiza la solicitud para eliminar el producto con el ID especificado
          fetch('https://yeremmihost.000webhostapp.com/tienda01/?borrar_producto='+id)
            .then(response => response.json())
            .then(data => {
              console.log(data); 
              //this.consultarProductos();
              window.location.href = "listar"
            })
            .catch(error => console.error('Error al eliminar producto:', error));
        },

        async obtenerDescripcionCategoria(idCategoria) {
            // Realiza una solicitud para obtener la descripción de la categoría
            // Usa axios o fetch para realizar la solicitud GET
            // Ajusta la URL según tu estructura en el servidor
            try {
                const response = await fetch(`https://yeremmihost.000webhostapp.com/tienda01/?consultar_categoria=${idCategoria}`);
                const data = await response.json();
                return data.length > 0 ? data[0].descripcion : 'Categoría no encontrada';
            }
            catch (error) {
                console.error('Error al obtener descripción de la categoría:', error);
                return 'Error al obtener descripción';
              }
        },
      },

};
  </script>
  
  <style>
  /* Estilos opcionales para mejorar la apariencia */
  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
  }
  
  th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
  }
  
  th {
    background-color: #f2f2f2;
  }
  </style>
  