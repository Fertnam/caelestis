<template>
  <form-model id="registration-form">
    <label for="registration-username-input">Логин:</label>
    <input name="username" id="registration-username-input" type="text" />
    <p id="username-message"></p>
    <label for="registration-email-input">E-mail:</label>
    <input name="email" id="registration-email-input" type="email" />
    <p id="email-message"></p>
    <label for="registration-password-input">Пароль:</label>
    <input name="password" id="registration-password-input" type="password" />
    <p id="password-message"></p>
    <label for="registration-password-repeat-input">Повторите пароль:</label>
    <input name="repeat-password" id="registration-password-repeat-input" type="password" />
    <p id="password-repeat-message"></p>
    <input type="hidden" class="recaptcha-input" name="recaptcha" />
    <input type="submit" value="Зарегистрироваться" />
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
  #registration-form input {
    margin-top: 6px;
  }

  #registration-form p {
    margin: 18px 0 32px;
  }
</style>
