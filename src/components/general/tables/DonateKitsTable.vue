<template>
  <BaseTable
    id="donate-kits-table"
    :captions="captions"
    :contents="contents"
  />
</template>

<script>
  import BaseTable from '../base/BaseTable';
  import { captions, contents } from '@/store/static/donate/kits';

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
