<template>
  <aside-form-model id="authorization-form">
    <input
      name="username"
      id="authorization-username-input"
      type="text"
      placeholder="Логин"
    />
    <input
      name="password"
      id="authorization-password-input"
      type="password"
      placeholder="Пароль"
    />
    <input type="hidden" class="g-recaptcha-input" name="recaptcha" />
    <p id="authorization-error" class="aside-form-error-wrapper"></p>
    <input type="submit" value="Войти" />
  </aside-form-model>
</template>

<script>
import AsideFormModel from '../models/AsideForm';

export default {
  components: {
    AsideFormModel
  }
};
</script>
