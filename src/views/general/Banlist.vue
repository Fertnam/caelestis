<template>
  <div>
    <h1>Бан-лист</h1>
    <find-banned-users-form></find-banned-users-form>
    <banned-users-table></banned-users-table>
  </div>
</template>

<script>
  import FindBannedUsersForm from '@/components/general/forms/FindBannedUsers';
  import BannedUsersTable from '@/components/general/tables/BannedUsers';

  export default {
    components: {
      FindBannedUsersForm,
      BannedUsersTable
    }
  };
</script>
