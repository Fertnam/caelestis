<template>
  <BaseForm
    class="aside-form-model"
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
  .aside-form-model input {
    text-align: center;
    margin-top: 0;
  }

  .aside-form-model input, .aside-form-model input:focus, .aside-form-model button, .aside-form-model button:hover {
    border: none;
  }

  .aside-form-model input, .aside-form-model input:focus {
    transition: none;
  }

  .aside-form-model input, .aside-form-model button {
    padding: 8px;
  }

  .aside-form-error-wrapper {
    color: #c45252;
  }

  .aside-form-model button {
    text-transform: none;
    box-shadow: -4.5px 4.5px #5f627d;
    transition-property: box-shadow, background-color;
  }

  .aside-form-model button:hover {
    box-shadow: -4.5px 4.5px #99957a;
  }
</style>
