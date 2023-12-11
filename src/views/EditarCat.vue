<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                Edita Cat
            </div>

            <div class="card-body">

                <form v-on:submit.prevent="actualizarRegistro">
                    <div class="form-group">
                      <label for="Tipo">Tipo: </label>
                      <input type="text"
                        class="form-control" required name="tipo" v-model="cat.tipo" id="tipo" aria-describedby="helpId" placeholder="Tipo">
                      <small id="helpId" class="form-text text-muted">Escribe el nuevo tipo</small>
                    </div>
                    <div class="form-group">
                      <label for="">descripcion: </label>
                      <input type="text"
                        class="form-control" required name="descripcion" id="descripcion" v-model="cat.descripcion" aria-describedby="helpId" placeholder="Descripcion">
                      <small id="helpId" class="form-text text-muted">Nueva descripcion</small>
                    </div>
                    <div class="btn-group" role="group" aria-label="">
                        <button type="submit" class="btn btn-success">Modificar</button>
                        <router-link :to="{name: 'ListarCat'}" class="btn btn-warning">Cancelar</router-link>
                    </div>
                </form>

            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            cat: {}
        }
    },
    created:function(){
        this.obtenerInformacionID()
    },
    methods:{
        obtenerInformacionID(){
            fetch('https://tienda01.proyectowebuni.com/categoria.php/cat/?consultar='+this.$route.params.id)
            .then(respuesta => respuesta.json())
            .then((datosRespuesta) => {
                console.log(datosRespuesta)
                this.cat = datosRespuesta[0];
            })
            .catch(error => console.log(error));
        },
        actualizarRegistro(){
            var datosEnviar = {
                id: this.$route.params.id,
                tipo: this.cat.tipo, 
                descripcion: this.cat.descripcion
            }

            fetch('https://tienda01.proyectowebuni.com/categoria.php/cat/?actualizar='+this.$route.params.id,{
                method: 'POST',
                body: JSON.stringify(datosEnviar),
            })
            .then(respuesta => respuesta.json())
            .then(datosRespuesta => {
                console.log(datosRespuesta)
                window.location.href = "../ListCat"
                // alert(datosRespuesta.mensaje)
                // this.empleado = {}
            })
        }
    }
}
</script>