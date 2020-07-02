<template>
  <BaseAsideElement caption="Авторизация">
    <AuthorizationForm/>
  </BaseAsideElement>
</template>

<script>
  import BaseAsideElement from './base/BaseAsideElement';
  import AuthorizationForm from './forms/AuthorizationForm';

  export default {
    components: {
      BaseAsideElement,
      AuthorizationForm
    }
  };
</script>
