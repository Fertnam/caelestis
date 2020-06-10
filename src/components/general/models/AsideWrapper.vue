<template>
  <div class="aside-wrapper-model">
    <h2 v-if="header">{{ header }}</h2>
    <slot></slot>
  </div>
</template>

<script>
  export default {
    props: {
      header: {
        type: String
      }
    }
  };
</script>

<style>
  .aside-wrapper-model {
    background-color: #101121;
    color: #878cb0;
    padding: 20px;
    box-shadow: -8px 8px #0c0d1a;
  }

  .aside-wrapper-model:not(:last-child) {
    margin-bottom: 38px;
  }

  .aside-wrapper-model h2 {
    margin: 0;
    font-size: 1.25em;
    padding-bottom: 20px;
    font-weight: bold;
  }
</style>
