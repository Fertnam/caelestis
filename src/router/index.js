import Vue from 'vue';
import VueRouter from 'vue-router';
import GeneralLayout from '@/layouts/General';
import generalChildren from './children/general';

Vue.use(VueRouter);

const routes = [
  {
    path: '/',
    component: GeneralLayout,
    children: generalChildren
  }
];

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
});

export default router;
