import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router';
import HomeView from '../views/HomeView.vue'
import CrearImgVue from '../components/CrearImg.vue'
import EditarImgVue from '../components/EditarImg.vue'
import ListImgVue from '../components/ListImg.vue'

const routes: Array<RouteRecordRaw> = [
  { path: '/', name: 'Home', component: HomeView },
  { path: '/listImg', name: 'ListImg', component: ListImgVue },
  { path: '/crearImg', name: 'CrearImg', component: CrearImgVue },
  { path: '/editar/:id', name: 'EditarImg', component: EditarImgVue, props: true },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
