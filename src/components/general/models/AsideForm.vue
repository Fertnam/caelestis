<template>
  <form-model class="aside-form-model">
    <slot></slot>
  </form-model>
</template>

<script>
  import FormModel from './Form';

  export default {
    components: {
      FormModel
    }
  };
</script>
