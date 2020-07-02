const captions = ['Наборы (/kit)', 'Игрок', 'VIP', 'Gold', 'Premium', 'Niobium'];

const contents = [
  ['/kit start (только при первом заходе)', true, true, true, true, true],
  ['/kit vip', false, true, false, false, false],
  ['/kit gold', false, false, true, false, false],
  ['/kit premium', false, false, false, true, false],
  ['/kit niobium', false, false, false, false, true]
];

export { captions, contents };
