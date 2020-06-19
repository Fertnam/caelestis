<template>
  <form-model id="find-banned-users-form">
    <input name="username" type="text" placeholder="Введите логин игрока">
    <button><fa-icon icon="search"></fa-icon></button>
  </form-model>
</template>

<script>
  import FormModel from '../models/Form';

  export default {
    components: {
      FormModel
    }
  };
</script>

<style>
  #find-banned-users-form {
    display: grid;
    grid-template-columns: 85% 1fr;
    grid-gap: 15px;
    margin-bottom: 30px;
  }

  #find-banned-users-form input, #find-banned-users-form button {
    margin: 0;
  }
</style>
