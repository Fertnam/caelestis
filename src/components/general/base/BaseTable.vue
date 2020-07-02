<template>
  <table
    class="table-model"
    v-on="$listeners"
  >
    <thead v-if="captions">
      <tr>
        <td
          v-for="(caption, index) in captions"
          :key="index"
        >
          {{ caption }}
        </td>
      </tr>
    </thead>
    <tbody v-if="contents">
      <tr
        v-for="(content, index) in contents"
        :key="index"
      >
        <td
          v-for="(value, valueIndex) in content"
          :key="valueIndex"
        >
          <AllowIcon v-if="value === true"/>
          <ForbidIcon v-else-if="value === false"/>
          <template v-else>{{ value }}</template>
        </td>
      </tr>
    </tbody>
    <tbody v-else>
      <slot/>
    </tbody>
  </table>
</template>

<script>
  import AllowIcon from '../icons/AllowIcon';
  import ForbidIcon from '../icons/ForbidIcon';

  export default {
    components: {
      AllowIcon,
      ForbidIcon
    },
    props: {
      captions: {
        type: Array
      },
      contents: {
        type: Array
      }
    }
  };
</script>

<style>
  .table-model {
    text-align: center;
    width: 100%;
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
