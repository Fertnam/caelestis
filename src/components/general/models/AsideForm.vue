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

<style>
  .aside-form-model input {
    border: none;
    text-align: center;
    padding: 8px;
    margin-top: 0;
    transition: none;
  }

  .aside-form-model input:not([type="submit"]):focus {
    border: none;
    transition: none;
  }

  .aside-form-error-wrapper {
    color: #c45252;
  }

  .aside-form-model input[type="submit"] {
    margin-top: 30px;
    text-transform: none;
    box-shadow: -4.5px 4.5px #5f627d;
    transition-property: box-shadow, background-color;
    transition-duration: 500ms;
  }

  .aside-form-model input[type="submit"]:hover {
    box-shadow: -4.5px 4.5px #99957a;
    border: none;
  }
</style>
