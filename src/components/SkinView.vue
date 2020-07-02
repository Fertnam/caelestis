<template>
  <img
    :src="'https://caelestis.ru/application/components/skin.php?user=' + username + '&mode=' + mode + '&size=' + size"
    :alt="alt"
  >
</template>

<script>
  export default {
    props: {
      username: {
        type: String,
        required: true
      },
      mode: {
        type: Number,
        default: 1
      },
      size: {
        type: Number,
        required: true
      }
    },
    computed: {
      alt() {
        let result;

        switch (this.mode) {
          case 1:
            result = 'Скин спереди';
            break;
          case 2:
            result = 'Скин сзади';
            break;
          case 3:
            result = 'Голова скина';
            break;
          default: result = 'Неизвестный режим';
        }

        return result;
      }
    }
  };
</script>
