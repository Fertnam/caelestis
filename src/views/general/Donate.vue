<template>
  <div>
    <h1>Донат</h1>
    <div id="donate-tables-wrapper">
      <services-table></services-table>
      <kits-table></kits-table>
      <prices-table></prices-table>
    </div>
  </div>
</template>

<script>
  import ServicesTable from '@/components/general/tables/donate/Services';
  import KitsTable from '@/components/general/tables/donate/Kits';
  import PricesTable from '@/components/general/tables/donate/Prices';

  export default {
    components: {
      ServicesTable,
      KitsTable,
      PricesTable
    }
  };
</script>

<style>
  #donate-tables-wrapper table:not(:last-child) {
    margin-bottom: 30px;
  }
</style>
