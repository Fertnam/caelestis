<template>
  <form-model id="registration-form">
    <label for="registration-username-input">Логин:</label>
    <input name="username" id="registration-username-input" type="text" />
    <label for="registration-email-input">E-mail:</label>
    <input name="email" id="registration-email-input" type="email" />
    <label for="registration-password-input">Пароль:</label>
    <input name="password" id="registration-password-input" type="password" />
    <label for="registration-password-repeat-input">Повторите пароль:</label>
    <input name="repeat-password" id="registration-password-repeat-input" type="password" />
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
