<template>
  <BaseForm
    class="one-line-form-model"
    v-on="$listeners"
  >
    <slot/>
  </BaseForm>
</template>

<script>
  import BaseForm from './BaseForm';

  export default {
    components: {
      BaseForm
    }
  };
</script>

<style>
  .one-line-form-model {
    display: grid;
    grid-template-columns: 85% 1fr;
    grid-gap: 15px;
  }

  .one-line-form-model input, .one-line-form-model button {
    margin: 0;
  }
</style>
