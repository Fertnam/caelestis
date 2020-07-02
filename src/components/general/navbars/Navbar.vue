<template>
  <nav id="navbar">
    <button id="mobile-navbar-button">+</button>
    <MenuList/>
    <router-link
      id="start-game-link"
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
    background-color: #101121;
    padding: 20px 4% 20px;
    display: flex;
    justify-content: space-between;
    border-bottom: 8px solid #0c0d1a;
    position: relative;
  }

  #navbar > a {
    background-color: #878cb0;
    padding: 4px 0;
    text-decoration: none;
    text-transform: uppercase;
    font-weight: bold;
    font-size: 1.2em;
    color: #101121;
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
    background-color: #101121;
    border: none;
    color: #878cb0;
    font-size: 1.5em;
    padding: 0;
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
