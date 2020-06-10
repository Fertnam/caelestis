<template>
  <div class="rule-clause">
    <p><span>{{ number }}</span>{{ appellation }}</p>
    <p class="rule-punishment" v-if="punishment">Наказание: {{ punishment }}</p>
  </div>
</template>

<script>
  export default {
    props: {
      number: {
        type: String,
        required: true
      },
      appellation: {
        type: String,
        required: true
      },
      punishment: {
        type: String
      }
    }
  };
</script>

<style>
  .rule-clause {
    padding: 14px;
  }

  .rule-clause span {
    font-weight: bold;
    margin-right: 7px;
  }

  .rule-clause:nth-child(even) {
    background-color: #9fa1b3;
  }

  .rule-punishment {
    margin-top: 10px !important;
    color: #c22727;
  }
</style>
