<template>
  <BaseFormOneLine
    id="find-banned-users-form"
    @submit.prevent="submit"
  >
    <input
      name="username"
      type="text"
      placeholder="Введите логин игрока"
    />
    <button>
      <fa-icon icon="search"/>
    </button>
  </BaseFormOneLine>
</template>

<script>
  import BaseFormOneLine from '../base/BaseFormOneLine';

  export default {
    components: {
      BaseFormOneLine
    },
    methods: {
      submit() {
        alert('Форма поиска забаненных игроков отправлена');
      }
    }
  };
</script>
