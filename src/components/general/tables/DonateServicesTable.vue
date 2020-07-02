<template>
  <BaseTable
    id="donate-services-table"
    :captions="captions"
    :contents="contents"
  />
</template>

<script>
  import BaseTable from '../base/BaseTable';
  import { captions, contents } from '@/store/static/donate/services';

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
