<template>
  <div class="rules-wrapper">
    <h3>
      <fa-icon :icon="icon"></fa-icon>
      {{ header }}
    </h3>
    <div>
      <rule-clause
        v-for="(clause, index) in clauses"
        :key="index"
        :number="clause.number"
        :appellation="clause.appellation"
        :punishment="clause.punishment"
      ></rule-clause>
    </div>
  </div>
</template>

<script>
  import RuleClause from './RuleClause';

  export default {
    props: {
      header: {
        type: String,
        required: true
      },
      icon: {
        type: String,
        required: true
      },
      clauses: {
        type: Array,
        required: true
      }
    },
    components: {
      RuleClause
    }
  };
</script>

<style>
  .rules-wrapper:not(:last-child) {
    margin-bottom: 30px;
  }

  .rules-wrapper > h3 {
    background-color: #101121;
    color: #878cb0;
    text-transform: uppercase;
    padding: 14px;
    text-align: center;
  }

  .rules-wrapper svg {
    margin-right: 4px;
    transition: 500ms;
  }

  .rules-wrapper:hover svg {
    color: #FFF9CC;
    transform: scale(1.15);
    transition: 500ms;
  }
</style>
