<template>
  <BaseTable
    id="banned-users-table"
    :captions="captions"
    @dblclick="clear"
  >
    <tr
      v-for="({user, admin, startDate, endDate, reason}, index) in contents"
      :key="index"
    >
      <td>
        <SkinView
          :username="user"
          :mode="3"
          :size="24"
        />
        {{ user }}
      </td>
      <td>
        <SkinView
          :username="admin"
          :mode="3"
          :size="24"
        />
        {{ admin }}
      </td>
      <td>{{ startDate }}</td>
      <td>{{ endDate }}</td>
      <td>{{ reason }}</td>
    </tr>
  </BaseTable>
</template>

<script>
  import BaseTable from '../base/BaseTable';
  import SkinView from '@/components/SkinView';
  import { captions, contents } from '@/store/static/banned-users';

  export default {
    components: {
      BaseTable,
      SkinView
    },
    data() {
      return {
        captions,
        contents
      };
    },
    methods: {
      clear() {
        alert('Событие двойного клика для таблицы вызвано');
      }
    }
  };
</script>

<style>
  #banned-users-table img {
    vertical-align: -6px;
    margin-right: 3px;
  }
</style>
