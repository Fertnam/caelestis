<template>
  <nav id="mobile-navbar">
    <MenuList/>
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
  #mobile-navbar {
    padding: 12px 20px 20px;
    background-color: #0c0d1a;
    display: none;
  }

  #mobile-navbar .menu-list > li:not(:last-child) {
    margin-bottom: 15px;
  }
</style>
