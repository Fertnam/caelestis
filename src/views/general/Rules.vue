<template>
  <div id="rules-page-wrapper">
    <h1>Правила</h1>
    <div>
      <RulesSection
        v-for="(rule, index) in rules"
        :key="index"
        :caption="rule.caption"
        :icon="rule.icon"
        :clauses="rule.clauses"
      />
    </div>
  </div>
</template>

<script>
  import RulesSection from '@/components/general/RulesSection';
  import rules from '@/store/static/rules';

  export default {
    components: {
      RulesSection
    },
    data() {
      return {
        rules
      };
    }
  };
</script>
