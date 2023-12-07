<template>

  <nav class="navbar navbar-expand navbar-light bg-light">
    <div class="nav navbar-nav">
        <router-link to="/" class="nav-link">Inicio</router-link>
        <router-link to="/crear" class="nav-link">Crear</router-link>
        <router-link to="/listar" class="nav-link">Productos</router-link>
        <router-link to="/listCat" class="nav-link">VerCat</router-link>
        <router-link to="/crearCat" class="nav-link">CrearCat</router-link>
      </div>
  </nav>
  <br>

  <router-view/>
</template>

