export default [
  {
    name: 'Главная',
    icon: 'home',
    route: { name: 'general-home' }
  },
  {
    name: 'Форум',
    icon: 'comments',
    href: '/forum'
  },
  {
    name: 'Сервера',
    icon: 'list-alt',
    subitems: [
      {
        name: 'Decor 1.12.2',
        route: { name: 'general-home' }
      }
    ]
  },
  {
    name: 'Бан-лист',
    icon: 'scroll',
    route: { name: 'general-banlist' }
  },
  {
    name: 'Донат',
    icon: 'donate',
    route: { name: 'general-donate' }
  },
  {
    name: 'Правила',
    icon: 'clipboard-list',
    route: { name: 'general-rules' }
  }
];
