<template>
  <article>
    <div class="article-header">
      <p>{{ header }}</p>
      <p><fa-icon icon="calendar-alt"></fa-icon> {{ date }}</p>
    </div>
    <div class="article-body">
      <img src="https://caelestis.ru/templates/images/slider/1.png" alt="Картинка к статье" />
      <p>{{ body }}</p>
    </div>
    <div class="article-footer clearfix">
      <a href>Подробнее</a>
    </div>
  </article>
</template>

<script>
  export default {
    props: {
      header: {
        type: String,
        required: true
      },
      date: {
        type: String,
        required: true
      },
      body: {
        type: String,
        required: true
      }
    }
  };
</script>

<style scoped>
  article:not(:last-child) {
    margin-bottom: 30px;
  }

  .article-header {
    background-color: #878cb0;
    box-shadow: -6px 6px #5f627d;
    margin-bottom: 26px;
    padding: 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .article-header p:first-child {
    font-size: 1.35em;
  }

  .article-header p {
    font-weight: bold;
  }

  .article-header svg {
    margin-right: 2px;
  }

  .article-body img {
    display: block;
    margin: 0 auto;
    max-width: 100%;
    max-height: 300px;
  }

  .article-body p {
    margin: 20px 0;
    line-height: 1.5;
  }

  .article-footer a {
    background-color: #101121;
    color: #878cb0;
    text-decoration: none;
    padding: 12px;
    display: block;
    float: right;
  }
</style>
