<template>
  <div id="home-page-wrapper">
    <h1>Главная</h1>
    <div id="articles-wrapper">
      <caelestis-article
        v-for="(article, index) in articles"
        :key="index"
        :header="article.header"
        :date="article.date"
        :body="article.body"
      ></caelestis-article>
    </div>
  </div>
</template>

<script>
  import CaelestisArticle from '@/components/general/Article';
  import articles from '@/store/static/articles';

  export default {
    data() {
      return {
        articles
      };
    },
    components: {
      CaelestisArticle
    }
  };
</script>
