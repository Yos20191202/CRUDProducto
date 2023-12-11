<template>
    <form @submit.prevent="agregarImagen" class="formulario" enctype="multipart/form-data">
        <div class="card-header">
            Crear nueva Imagen
        </div>
        <div class="form-group">
            <label for="imagen" class="texto">Imagen:</label>
            <input id="imagen" type="file" class="form-control" name="imagen" @change="handleImagenChange" required />
        </div>
        <div class="form-group">
            <label for="descripcion" class="texto"> Descripcion: </label>
            <textarea id="descripcion" v-model="imagen.descripcion" type="text" class="form-control" name="descripcion"
                aria-describedby="helpId" placeholder="Descripcion" required minlength="3"></textarea>
        </div>
        <div class="btn-group" role="group" aria-label="">
            <button type="submit" class="btn-success">Agregar</button>
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
    methods: {
        handleImagenChange(event) {
            
            //almacenamos el objeto de archivo en nuestro modelo de datos
            this.imagen.imagen = event.target.files[0];
        },
        agregarImagen() {
            let formData = new FormData();
            formData.append("imagen", this.imagen.imagen);
            formData.append("descripcion", this.imagen.descripcion);

            fetch("https://yeremmihost.000webhostapp.com/tienda01/imagen.php/img/?insertar=1", {
                method: "POST",
                body: formData,
            })
                .then((respuesta) => respuesta.json())
                .then((datosRespuesta) => {
                    console.log(datosRespuesta);
                    window.location.href = 'listImg'
                })
                .catch((error) => console.log(error));
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