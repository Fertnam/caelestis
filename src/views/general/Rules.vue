<template>
  <div>
    <h1>Правила</h1>
    <div>
      <rule
        v-for="(rule, index) in rules"
        :key="index"
        :header="rule.header"
        :icon="rule.icon"
        :clauses="rule.clauses"
      ></rule>
    </div>
  </div>
</template>

<script>
  import Rule from '@/components/general/rules/Rule';
  import rules from '@/store/states/rules.js';

  export default {
    data() {
      return {
        rules
      };
    },
    components: {
      Rule
    }
  };
</script>
