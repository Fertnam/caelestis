<template>
  <BaseTable
    id="donate-prices-table"
    :captions="captions"
    :contents="contents"
  />
</template>

<script>
  import BaseTable from '../base/BaseTable';
  import { captions, contents } from '@/store/static/donate/prices';

  export default {
    components: {
      BaseTable
    },
    data() {
      return {
        captions,
        contents
      };
    }
  };
</script>
