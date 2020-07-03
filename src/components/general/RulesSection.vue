<template>
  <div class="rules-section">
    <h3 class="dark-theme">
      <fa-icon :icon="icon"/>
      {{ caption }}
    </h3>
    <div>
      <RuleClause
        v-for="({number, appellation, punishment}, index) in clauses"
        :key="index"
        :number="number"
        :appellation="appellation"
        :punishment="punishment"
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
</style>
