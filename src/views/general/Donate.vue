<template>
  <div id="donate-page-wrapper">
    <h1>Донат</h1>
    <div id="donate-tables-wrapper">
      <DonateServicesTable/>
      <DonateKitsTable/>
      <DonatePricesTable/>
    </div>
  </div>
</template>

<script>
  import DonateServicesTable from '@/components/general/tables/DonateServicesTable';
  import DonateKitsTable from '@/components/general/tables/DonateKitsTable';
  import DonatePricesTable from '@/components/general/tables/DonatePricesTable';

  export default {
    components: {
      DonateServicesTable,
      DonateKitsTable,
      DonatePricesTable
    }
  };
</script>

<style>
  #donate-tables-wrapper table:not(:last-child) {
    margin-bottom: 30px;
  }
</style>
