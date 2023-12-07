import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'
import ListarView from '../views/ListarView.vue'
import CrearView from '../views/CrearView.vue'
import EditarView from '../views/EditarView.vue'

const routes = [
  { path: '/', name: 'Home', component: HomeView },
  { path: '/listar', name: 'Listar', component: ListarView },
  { path: '/crear', name: 'Crear', component: CrearView },
  { path: '/editar/:id', name: 'Editar', component: EditarView, props: true }
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
