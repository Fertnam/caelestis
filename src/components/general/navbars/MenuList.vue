<template>
  <ul class="menu-list">
    <li>
      <router-link
        :to="{name: 'general-home'}"
        :active-class="activeClass"
        exact
      >
        <fa-icon icon="home"/>
        Главная
      </router-link>
    </li>
    <li>
      <a href="/forum">
        <fa-icon icon="comments"/>
        Форум
      </a>
    </li>
    <li>
      <a>
        <fa-icon icon="list-alt"/>
        Сервера
      </a>
    </li>
    <li>
      <router-link
        :to="{name: 'general-banlist'}"
        :active-class="activeClass"
        exact
      >
        <fa-icon icon="scroll"/>
        Бан-лист
      </router-link>
    </li>
    <li>
      <router-link
        :to="{name: 'general-donate'}"
        :active-class="activeClass"
        exact
      >
        <fa-icon icon="donate"/>
        Донат
      </router-link>
    </li>
    <li>
      <router-link
        :to="{name: 'general-rules'}"
        :active-class="activeClass"
        exact
      >
        <fa-icon icon="clipboard-list"/>
        Правила
      </router-link>
    </li>
  </ul>
</template>

<script>
  export default {
    data() {
      return {
        activeClass: 'active-menu-item'
      };
    }
  };
</script>

<style>
  .menu-list a {
    color: #878cb0;
    font-weight: bold;
    text-decoration: none;
    text-transform: uppercase;
  }

  .menu-list svg {
    margin-right: 2px;
    font-size: 1.1em;
  }

  .menu-list > li > a:hover svg, .active-menu-item svg {
    color: #FFF9CC;
  }
</style>
