<template>
  <table class="table-model">
    <thead>
      <tr>
        <td v-for="(header, index) in headers" :key="index">{{ header }}</td>
      </tr>
    </thead>
    <tbody>
      <tr v-for="(body, bodyIndex) in bodies" :key="bodyIndex">
        <td
          v-for="(td, tdIndex) in body"
          :key="tdIndex"
          :aria-label="tdIndex != 0 ? headers[tdIndex] : null"
        >
          <allowed-icon v-if="td === true"></allowed-icon>
          <prohibited-icon v-else-if="td === false"></prohibited-icon>
          <template v-else>{{ td }}</template>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
  import AllowedIcon from '../icons/Allowed';
  import ProhibitedIcon from '../icons/Prohibited';

  export default {
    props: {
      headers: {
        type: Array,
        required: true
      },
      bodies: {
        type: Array,
        required: true
      }
    },
    components: {
      AllowedIcon,
      ProhibitedIcon
    }
  };
</script>

<style>
  .table-model {
    text-align: center;
    border-spacing: 0;
    width: 100%;
    vertical-align: middle;
  }

  .table-model thead {
    background-color: #101121;
    color: #878cb0;
    text-transform: uppercase;
  }

  .table-model td {
    padding: 14px;
    vertical-align: middle;
  }

  .table-model tr:nth-child(even) {
    background-color: #9fa1b3;
  }
</style>
