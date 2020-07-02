<template>
  <div id="banlist-page-wrapper">
    <h1>Бан-лист</h1>
    <UsersBannedFindForm/>
    <UsersBannedTable/>
  </div>
</template>

<script>
  import UsersBannedFindForm from '@/components/general/forms/UsersBannedFindForm';
  import UsersBannedTable from '@/components/general/tables/UsersBannedTable';

  export default {
    components: {
      UsersBannedFindForm,
      UsersBannedTable
    }
  };
</script>

<style>
  #find-banned-users-form {
    margin-bottom: 30px;
  }
</style>
