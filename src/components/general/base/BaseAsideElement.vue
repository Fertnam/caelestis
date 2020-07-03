<template>
  <div class="aside-element-model dark-theme">
    <h2 v-if="caption">{{ caption }}</h2>
    <slot/>
  </div>
</template>

<script>
  export default {
    props: {
      caption: {
        type: String
      }
    }
  };
</script>

<style>
  .aside-element-model {
    padding: 20px;
    box-shadow: -8px 8px #0c0d1a;
  }

  .aside-element-model:not(:last-child) {
    margin-bottom: 38px;
  }

  .aside-element-model h2 {
    font-size: 1.25em;
    padding-bottom: 20px;
    font-weight: bold;
  }
</style>
