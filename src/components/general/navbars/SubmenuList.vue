<template>
  <ul class="submenu-list">
    <li v-for="(item, index) in items" :key="index">
      <router-link
        :to="item.route"
      >
        <a>{{ item.name }}</a>
      </router-link>
    </li>
  </ul>
</template>

<script>
  export default {
    props: {
      items: {
        type: Array,
        required: true
      }
    }
  };
</script>

<style>
  .submenu-list {
    display: none;
  }
</style>
