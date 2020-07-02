<template>
  <div id="registration-page-wrapper">
    <h1>Регистрация</h1>
    <RegistrationForm/>
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
