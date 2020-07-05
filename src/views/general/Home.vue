<template>
  <div id="home-page-wrapper">
    <TheSlider
      dir-path="images/slides/"
      :slides="slides"
    />
    <div id="articles-wrapper">
      <CaelestisArticle
        v-for="({caption, date, content}, index) in articles"
        :key="index"
        :caption="caption"
        :date="date"
        :content="content"
      />
    </div>
  </div>
</template>

<script>
  import CaelestisArticle from '@/components/general/CaelestisArticle';
  import TheSlider from '@/components/general/TheSlider';
  import slides from '@/store/static/slides/home-slides';
  import articles from '@/store/static/articles';

  export default {
    components: {
      CaelestisArticle,
      TheSlider
    },
    data() {
      return {
        slides,
        articles
      };
    }
  };
</script>
