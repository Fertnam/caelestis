<template>
  <BaseFormAside
    id="authorization-form"
    @submit.prevent="submit"
  >
    <input
      name="username"
      type="text"
      placeholder="Логин"
    />
    <input
      name="password"
      type="password"
      placeholder="Пароль"
    />
    <input
      class="g-recaptcha-input"
      name="recaptcha"
      type="hidden"
    />
    <button>Войти</button>
  </BaseFormAside>
</template>

<script>
  import BaseFormAside from '../base/BaseFormAside';

  export default {
    components: {
      BaseFormAside
    },
    methods: {
      submit() {
        alert('Форма авторизации отправлена');
      }
    }
  };
</script>
