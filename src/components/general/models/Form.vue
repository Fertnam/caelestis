<template>
  <form class="form-model">
    <slot></slot>
  </form>
</template>

<style>
  .form-model {
    font-weight: bold;
  }

  .form-model input, .form-model button {
    font-size: 1em;
    margin: 6px 0 22px;
    display: block;
    width: 100%;
    font-weight: bold;
    background-color: #9fa1b3;
    border: 2.5px solid #9fa1b3;
    color: #101121;
    padding: 10px;
    transition-property: border;
    transition-duration: 500ms;
  }

  .form-error-wrapper {
    margin-bottom: 28px;
  }

  .form-model input[type="submit"], .form-model button {
    cursor: pointer;
    transition-property: background-color, border;
    text-transform: uppercase;
    margin: 32px 0 0;
  }

  .form-model input:not([type="submit"]):focus {
    border: 2.5px solid #5f627d;
    transition: 500ms;
  }

  .form-model input[type="submit"]:hover, .form-model button:hover {
    border: 2.5px solid #5f627d;
    background-color: #FFF9CC;
    transition: 500ms;
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
