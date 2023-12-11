<template>
    <form @submit.prevent="EditarImagen" class="formulario" enctype="multipart/form-data">
        <div class="card-header">
            Editar Imagen
        </div>
        <div class="form-group">
            <label for="imagen" class="texto">Imagen:</label>
            <input id="imagen" type="file" class="form-control" name="imagen" @change="handleImagenChange" />
        </div>
        <div class="form-group">
            <label for="descripcion" class="texto"> Descripcion: </label>
            <textarea id="descripcion" v-model="imagen.descripcion" type="text" class="form-control" name="descripcion"
                aria-describedby="helpId" placeholder="Descripcion"></textarea>
        </div>
        <div class="btn-group" role="group" aria-label="">
            <button type="submit" class="btn-success">Modificar</button>
            <router-link :to="{ name: 'ListImg' }">
                <button class="btn-red">Cancelar</button>
            </router-link>
        </div>
    </form>
</template>

<script>
export default {
    data() {
        return {
            imagen: {
                imagen: null,
                descripcion: "",
            },
            imagenActual: 'https://tienda01.proyectowebuni.com/img/',
        };
    },
    created() {
        this.ObtenerDatos();
    },
    methods: {
        ObtenerDatos() {
            fetch('https://tienda01.proyectowebuni.com/imagen.php/?consultar=' + this.$route.params.id)
                .then(respuesta => respuesta.json())
                .then(datosRespuesta => {
                    console.log(datosRespuesta)
                    this.imagen = datosRespuesta[0];
                })
                .catch(error => console.log(error));
        },
        EditarImagen() {
            var formData = new FormData();
            formData.append('imagen', this.imagen.imagen);
            formData.append('descripcion', this.imagen.descripcion);

            fetch("https://tienda01.proyectowebuni.com/imagen.php/?actualizar=" + this.$route.params.id, {
                method: "POST",
                body: formData,
            })
                .then((respuesta) => {
                    if (!respuesta.ok) {
                        throw new Error('Error en la solicitud: ' + respuesta.statusText);
                    }
                    return respuesta.json();
                })
                .then((datosRespuesta) => {
                    if (datosRespuesta && datosRespuesta.success === 1) {
                        console.log('Actualización exitosa');
                        // Utiliza el enrutador de Vue.js para navegar a la página de lista de imágenes
                        this.$router.push({ name: 'ListImg' });
                    } else {
                        console.error('Error en la actualización:', datosRespuesta && datosRespuesta.error);
                    }
                })
                .catch((error) => {
                    console.error('Error al procesar la respuesta:', error);
                });
        },
        handleImagenChange(event) {
            this.imagen.imagen = event.target.files[0]; // Actualiza el valor de la propiedad imagen
        },
    },
};
</script>


<style scoped>
.card-header {
    color: black;
    padding: 10px;
    font-size: 24px;
    text-align: center;
}

.formulario {
    max-width: 400px;
    margin: 0 auto;
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 20px;
    background-color: #fff;
    text-align: center;
}

.form-group {
    margin-bottom: 15px;
    font-size: 14px;
}

label {
    display: block;
    font-weight: bold;
    text-align: left;
}

input[type="file"],
textarea {
    width: 100%;
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.btn-group {
    margin-top: 10px;
}

button {
    padding: 10px 20px;
    margin-right: 10px;
    border-radius: 4px;
    cursor: pointer;
}

.btn-success:hover {
    background-color: #008000;
}

.btn-success {
    background-color: #28a745;
    color: #fff;
    border: none;
}

.btn-red {
    background-color: #dc3545;
    color: #fff;
    border: none;
}

.btn-red:hover {
    background-color: #FF0000;
}
</style>