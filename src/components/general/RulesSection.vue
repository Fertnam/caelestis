<template>
  <div class="rules-section">
    <h3>
      <fa-icon :icon="icon"/>
      {{ caption }}
    </h3>
    <div>
      <RuleClause
        v-for="(clause, index) in clauses"
        :key="index"
        :number="clause.number"
        :appellation="clause.appellation"
        :punishment="clause.punishment"
      />
    </div>
  </div>
</template>

<script>
  import RuleClause from './RuleClause';

  export default {
    components: {
      RuleClause
    },
    props: {
      caption: {
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
    }
  };
</script>

<style>
  .rules-section:not(:last-child) {
    margin-bottom: 30px;
  }

  .rules-section > h3 {
    background-color: #101121;
    color: #878cb0;
    text-transform: uppercase;
    padding: 14px;
    text-align: center;
  }

  .rules-section svg {
    margin-right: 4px;
  }

  .rules-section:hover svg {
    color: #FFF9CC;
    transform: scale(1.15);
  }

  .rules-section svg, .rules-section:hover svg {
    transition: 500ms;
  }
</style>
