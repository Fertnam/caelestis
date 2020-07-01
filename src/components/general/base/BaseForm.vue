<template>
  <form
    class="form-model"
    v-on="$listeners"
  >
    <slot/>
  </form>
</template>

<style>
  .form-model * {
    font-weight: bold;
  }

  .form-model input, .form-model button, .form-model select {
    margin: 6px 0 22px;
    background-color: #9fa1b3;
    border: 2.5px solid #9fa1b3;
    color: #101121;
    padding: 10px;
    transition-property: border;
  }

  .form-model input:focus, .form-model button:hover {
    border: 2.5px solid #5f627d;
  }

  .form-error-wrapper {
    margin-bottom: 28px;
  }

  .form-model button {
    transition-property: background-color, border;
    text-transform: uppercase;
    margin: 10px 0 0;
  }

  .form-model button:hover {
    background-color: #FFF9CC;
  }

  .form-model input::-webkit-input-placeholder {
    color: #101121;
    opacity: 1;
  }
  .form-model input::-moz-placeholder {
    color: #101121;
    opacity: 1;
  }
  .form-model input:-ms-input-placeholder {
    color: #101121;
    opacity: 1;
  }
</style>
