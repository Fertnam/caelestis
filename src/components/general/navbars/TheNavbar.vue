<template>
  <nav
    id="navbar"
    class="dark-theme"
  >
    <button id="mobile-navbar-button">+</button>
    <MenuList/>
    <router-link
      id="start-game-link"
      class="light-theme"
      :to="{name: 'general-registration'}"
    >
      <fa-icon icon="gamepad" size="2x"/>
      Пора играть
    </router-link>
  </nav>
</template>

<script>
  import MenuList from './MenuList';

  export default {
    components: {
      MenuList
    }
  };
</script>

<style>
  #navbar {
    padding: 20px 4% 20px;
    display: flex;
    justify-content: space-between;
    border-bottom: 8px solid #0c0d1a;
    position: relative;
  }

  #navbar > a {
    padding: 4px 0;
    font-size: 1.2em;
    box-shadow: -6px 6px #5f627d;
  }

  #start-game-link {
    width: 22%;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  #start-game-link svg {
    margin-right: 8px;
  }

  #mobile-navbar-button {
    display: none;
    font-size: 1.5em;
  }

  #navbar .menu-list {
    white-space: nowrap;
    width: 70%;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  #navbar .menu-list > li:not(:last-child) {
    margin-right: 4em;
  }
</style>
