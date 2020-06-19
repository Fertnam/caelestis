<template>
  <ul class="menu-list">
    <li v-for="(item, index) in menuItems" :key="index">
      <router-link
        v-if="item.route"
        :to="item.route"
        active-class="active-menu-item"
        exact
      >
        <fa-icon :icon="item.icon"></fa-icon>
        {{ item.name }}
      </router-link>
      <a
        v-else-if="item.href"
        :href="item.href"
      >
        <fa-icon :icon="item.icon"></fa-icon>
        {{ item.name }}
      </a>
      <template v-else>
        <a>
          <fa-icon :icon="item.icon"></fa-icon>
          {{ item.name }}
        </a>
        <submenu-list :items="item.subitems"></submenu-list>
      </template>
    </li>
  </ul>
</template>

<script>
  import SubmenuList from './SubmenuList';
  import menuItems from '@/store/states/menu-items.js';

  export default {
    data() {
      return {
        menuItems
      };
    },
    components: {
      SubmenuList
    }
  };
</script>

<style>
  .menu-list a {
    color: #878cb0;
    text-decoration: none;
    cursor: pointer;
    text-transform: uppercase;
  }

  .menu-list svg {
    margin-right: 2px;
    font-size: 1.1em;
    transition: 500ms;
  }

  .menu-list > li > a:hover svg, .active-menu-item svg {
    color: #FFF9CC;
    transition: 500ms;
  }
</style>
