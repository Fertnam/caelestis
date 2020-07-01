<template>
  <aside-wrapper header="Авторизация">
    <authorization-form></authorization-form>
  </aside-wrapper>
</template>

<script>
  import AsideWrapper from '../models/AsideWrapper';
  import AuthorizationForm from '../forms/AuthorizationForm';

  export default {
    components: {
      AsideWrapper,
      AuthorizationForm
    }
  };
</script>
