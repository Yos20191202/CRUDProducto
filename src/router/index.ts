import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router';
import HomeView from '../views/HomeView.vue'
import ListarView from '../views/ListarView.vue'
import CrearView from '../views/CrearView.vue'
import EditarView from '../views/EditarView.vue'
//Categoria
import CrearCatVue from '../views/CrearCat.vue'
import EditarCatVue from '../views/EditarCat.vue'
import ListCatVue from '../views/ListCat.vue'

const routes: Array<RouteRecordRaw> = [
  { path: '/', name: 'Home', component: HomeView },
  { path: '/listar', name: 'Listar', component: ListarView },
  { path: '/crear', name: 'Crear', component: CrearView },
  { path: '/editar/:id', name: 'Editar', component: EditarView, props: true },
  { path: '/crearCat', name: 'CrearCat', component: CrearCatVue},
  { path: '/listCat', name: 'ListCat', component: ListCatVue},
  { path: '/editarCat', name: 'EditarCat', component: EditarCatVue, props: true}
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
