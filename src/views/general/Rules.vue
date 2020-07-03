<template>
  <div id="rules-page-wrapper">
    <h1>Правила</h1>
    <div>
      <RulesSection
        v-for="({caption, icon, clauses}, index) in rulesSections"
        :key="index"
        :caption="caption"
        :icon="icon"
        :clauses="clauses"
      />
    </div>
  </div>
</template>

<script>
  import RulesSection from '@/components/general/RulesSection';
  import rulesSections from '@/store/static/rules-sections';

  export default {
    components: {
      RulesSection
    },
    data() {
      return {
        rulesSections
      };
    }
  };
</script>
