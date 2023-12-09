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
        };
    },
    created: function () {
        this.ObtenerDatos();
    },
    methods: {
        ObtenerDatos() {
            fetch('http://localhost/tienda01/imagen.php/tbimagen/?consultar=' + this.$route.params.id)
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

            fetch("http://localhost/tienda01/imagen.php/tbimagen/?actualizar=" + this.$route.params.id, {
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
                        window.location.href = '../listImg';
                    } else {
                        console.error('Error en la actualización:', datosRespuesta && datosRespuesta.error);
                    }
                })
                .catch((error) => {
                    console.error('Error al procesar la respuesta:', error);
                });
        }

    }
}
</script>