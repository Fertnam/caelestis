<template>
  <BaseForm
    id="registration-form"
    @submit.prevent="submit"
  >
    <label for="registration-username-input">Логин:</label>
    <input
      id="registration-username-input"
      name="username"
      type="text"
    />
    <label for="registration-email-input">E-mail:</label>
    <input
      id="registration-email-input"
      name="email"
      type="email"
    />
    <label for="registration-password-input">Пароль:</label>
    <input
      id="registration-password-input"
      name="password"
      type="password"
    />
    <label for="registration-password-repeat-input">Повторите пароль:</label>
    <input
      id="registration-password-repeat-input"
      name="repeat-password"
      type="password"
    />
    <input
      class="recaptcha-input"
      name="recaptcha"
      type="hidden"
    />
    <button>Зарегистрироваться</button>
  </BaseForm>
</template>

<script>
  import BaseForm from '../base/BaseForm';

  export default {
    components: {
      BaseForm
    },
    methods: {
      submit() {
        alert('Форма регистрации отправлена');
      }
    }
  };
</script>
