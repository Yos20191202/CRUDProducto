<template>

  <nav class="navbar navbar-expand navbar-light bg-light">
    <div class="nav navbar-nav">
        <router-link to="/" class="nav-link">Inicio</router-link>
        <router-link to="/crear" class="nav-link">Crear</router-link>
        <router-link to="/listar" class="nav-link">Productos</router-link>
      </div>
  </nav>
  <br>

  <router-view/>
</template>

