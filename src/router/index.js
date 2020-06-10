import Vue from 'vue';
import VueRouter from 'vue-router';
import GeneralHome from '@/views/general/Home.vue';
import GeneralBanlist from '@/views/general/Banlist.vue';
import GeneralDonate from '@/views/general/Donate.vue';
import GeneralRules from '@/views/general/Rules.vue';
import GeneralRegistration from '@/views/general/Registration.vue';
import GeneralProfile from '@/views/general/Profile.vue';

Vue.use(VueRouter);

const routes = [
  {
    path: '/',
    component: () => import('@/layouts/General.vue'),
    children: [
      {
        path: '',
        name: 'general-home',
        component: GeneralHome
      },
      {
        path: 'banlist',
        name: 'general-banlist',
        component: GeneralBanlist
      },
      {
        path: 'donate',
        name: 'general-donate',
        component: GeneralDonate
      },
      {
        path: 'donate',
        name: 'general-donate',
        component: GeneralDonate
      },
      {
        path: 'rules',
        name: 'general-rules',
        component: GeneralRules
      },
      {
        path: 'registration',
        name: 'general-registration',
        component: GeneralRegistration
      },
      {
        path: 'profile',
        name: 'general-profile',
        component: GeneralProfile
      }
    ]
  }
];

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
});

export default router;
