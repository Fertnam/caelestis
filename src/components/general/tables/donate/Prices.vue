<template>
  <table-model :headers="headers" :bodies="bodies"></table-model>
</template>

<script>
  import TableModel from '../../models/Table';
  import { headers, bodies } from '@/store/states/donate/prices.js';

  export default {
    data() {
      return {
        headers,
        bodies
      };
    },
    components: {
      TableModel
    }
  };
</script>
