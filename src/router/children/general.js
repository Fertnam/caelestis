import Home from '@/views/general/Home';

export default [
  {
    path: '',
    name: 'general-home',
    component: Home
  },
  {
    path: 'banlist',
    name: 'general-banlist',
    component: () => import('@/views/general/Banlist')
  },
  {
    path: 'donate',
    name: 'general-donate',
    component: () => import('@/views/general/Donate')
  },
  {
    path: 'rules',
    name: 'general-rules',
    component: () => import('@/views/general/Rules')
  },
  {
    path: 'registration',
    name: 'general-registration',
    component: () => import('@/views/general/Registration')
  },
  {
    path: 'profile',
    name: 'general-profile',
    component: () => import('@/views/general/Profile')
  }
];
