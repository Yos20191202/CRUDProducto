<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                Agregar Nuevo Tipo
            </div>

            <div class="card-body">

                <form v-on:submit.prevent="agregarRegistroC">
                    <div class="form-group">
                      <label for="tipo">Tipo: </label>
                      <input type="text"
                        class="form-control" required name="tipo" v-model="categoria.tipo" id="tipo" aria-describedby="helpId" placeholder="Tipo">
                      <small id="helpId" class="form-text text-muted">Escribe el tipo</small>
                    </div>
                    <div class="form-group">
                      <label for="">Descripcion: </label>
                      <input type="text"
                        class="form-control" required name="descripcion" id="descripcion" v-model="categoria.descripcion" aria-describedby="helpId" placeholder="Descripcion">
                      <small id="helpId" class="form-text text-muted">Agrega una descripcion</small>
                    </div>
                    <div class="btn-group" role="group" aria-label="">
                        <button type="submit" class="btn btn-success">Agregar</button>
                        <router-link :to="{name: 'ListCat'}" class="btn btn-warning">Cancelar</router-link>
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
            categoria: {}
        }
    },
    methods:{
        agregarRegistroC(){
            console.log(this.categoria)
            var datosEnviar = {
                tipo: this.categoria.tipo, 
                descripcion: this.categoria.descripcion
            }

            fetch('https://yeremmihost.000webhostapp.com/tienda01/categoria.php/?insertar=1',{
                method: 'POST',
                body: JSON.stringify(datosEnviar),
                headers:{
                    'Content-Type': 'application/json'
                }
            })
            .then(respuesta => respuesta.json())
            .then(datosRespuesta => {
                console.log(datosRespuesta)
                window.location.href = "/ListCat"

            })

        }
    }
}
</script>