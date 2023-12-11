<template>
    <div class="container">
        <div class="card-header">
            Imagenes
        </div>
        <div class="carda" >

            <router-link :to="{ name: 'CrearImg' }">
                <button class="btn-red">Crear Imagen</button>
            </router-link>

            <div class="card-body">
                <table class="table my-table ">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Imagen</th>
                            <th>Descripcion</th>
                            <th>acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="imagen in tbimagen" :key="imagen.id">
                            <td>{{ imagen.id }}</td>
                            <td>
                                <img :src="imagen.imagen" alt="Imagen" style="max-width: 100px; max-height: 100px;">
                            </td>
                            <td>{{ imagen.descripcion }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="">
                                    <router-link :to="{ name: 'EditarImg', params:{id:imagen.id} }">
                                        <button class="my-button">Editar</button>
                                    </router-link>
                                    <button type="button" @click="borrarImagen(imagen.id)"
                                        class="my-button-red">Borrar</button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            tbimagen: []
        }
    },
    created: function () {
        this.consultarImg();
    },
    methods: {
        consultarImg() {
            fetch('https://tienda01.proyectowebuni.com/imagen.php')
                .then(respuesta => respuesta.json())
                .then(datosRespuesta => {
                    console.log(datosRespuesta)
                    this.tbimagen = []
                    if (typeof datosRespuesta[0].success === 'undefined') {
                        this.tbimagen = datosRespuesta
                    }
                })
                .catch(error => console.log(error));
        },
        borrarImagen(id) {
            console.log(id);
            fetch('https://tienda01.proyectowebuni.com/imagen.php/?borrar=' + id)

                .then(respuesta => respuesta.json())
                .then(datosRespuesta => {
                    console.log(datosRespuesta)
                    window.location.href = 'listImg'
                })
                .catch(error => console.log(error));
        }
    }
}
</script>

<style scoped>
.card-header {
    color: black;
    padding: 10px;
    font-size: 24px;
    text-align: center;
}

.my-table {
    width: 80%;
    margin: 20px auto 20px auto;
    border-collapse: collapse;
}

.my-table th,
.my-table td {
    padding: 10px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

.my-table th {
    background-color: #f2f2f2;
}

.my-table tbody tr:nth-child(even) {
    background-color: #f9f9f9;
}

.my-table tbody tr:hover {
    background-color: #e9e9e9;
}

.my-button {
    display: inline-block;
    padding: 10px 20px;
    margin-right: 10px;
    background-color: #28a745;
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    border: none;
    cursor: pointer;
    font-size: 16px;
}

.btn-red {
    background-color: #28a745;
    padding: 10px 20px;
    color: #fff;
    border: none;
    border-radius: 4px;
    margin-left: 170px;
    margin-top: -10px;
}

.my-button-red {
    display: inline-block;
    padding: 10px 20px;
    margin-right: 10px;
    background-color: #dc3545;
    color: #fff;
    text-decoration: none;
    border-radius: 4px;
    border: none;
    cursor: pointer;
    font-size: 16px;

}

.my-button:hover {
    background-color: #008000;
}

.my-button-red:hover {
    background-color: #FF0000;
}
</style>