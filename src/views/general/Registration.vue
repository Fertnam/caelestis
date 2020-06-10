<template>
  <div>
    <h1>Регистрация</h1>
    <registration-form></registration-form>
  </div>
</template>

<script>
  import RegistrationForm from '@/components/general/forms/RegistrationForm';

  export default {
    components: {
      RegistrationForm
    }
  };
</script>

<style scoped>
  h1 {
    margin-bottom: 36px;
  }
</style>
