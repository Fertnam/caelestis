<template>
  <div id="layout-wrapper">
    <header>
      <TheLogo/>
    </header>
    <div id="navbars-wrapper">
      <TheNavbar/>
      <TheNavbarMobile/>
    </div>
    <main>
      <transition
        mode="out-in"
        enter-active-class="animate__animated animate__fadeIn animate__faster"
        leave-active-class="animate__animated animate__fadeOut animate__faster"
      >
        <router-view/>
      </transition>
    </main>
    <aside>
      <div id="aside-elements-wrapper">
        <TheUsermenuAside/>
        <TheServerMonitoringAside/>
      </div>
    </aside>
    <footer class="dark-theme">
      <p>Копирование элементов дизайна запрещено</p>
    </footer>
  </div>
</template>

<script>
  import TheLogo from '@/components/TheLogo';
  import TheNavbar from '@/components/general/navbars/TheNavbar';
  import TheNavbarMobile from '@/components/general/navbars/TheNavbarMobile';
  import TheServerMonitoringAside from '@/components/general/aside/TheServerMonitoringAside';
  import TheUsermenuAside from '@/components/general/aside/TheUsermenuAside';

  export default {
    components: {
      TheLogo,
      TheNavbar,
      TheNavbarMobile,
      TheServerMonitoringAside,
      TheUsermenuAside
    }
  };
</script>

<style>
  /* Настройка сетки grid */
  #layout-wrapper {
    display: grid;
    grid-template-columns: 72% 28%;
    grid-template-areas: "header header"
                         "navbars navbars"
                         "main aside"
                         "footer footer";
  }

  header {
    grid-area: header;
  }

  #navbars-wrapper {
    grid-area: navbars;
  }

  main {
    grid-area: main;
  }

  aside {
    grid-area: aside;
  }

  footer {
    grid-area: footer;
  }

  /* Базовые стили для всех элементов layout */
  h1 {
    margin-bottom: 40px;
    font-size: 1.5em;
    box-shadow: -6px 6px #5f627d;
    padding: 16px;
    font-weight: bold;
  }

  .dark-theme {
    background-color: #101121;
    color: #878cb0;
  }

  .light-theme, h1 {
    background-color: #878cb0;
  }

  .light-theme, main {
    color: #101121;
  }

  /* Стили для секций */
  body {
    font-family: Arial, sans-serif;
  }

  header {
    background: url(/images/header-bg.png) center 90% / cover;
    padding: 7%;
    display: flex;
    justify-content: center;
  }

  #navbars-wrapper a {
    text-decoration: none;
    text-transform: uppercase;
    font-weight: bold;
  }

  main, aside, footer {
    padding: 30px;
  }

  main {
    background-color: #c6c9de;
  }

  aside, footer {
    text-align: center;
  }

  aside {
    background-color: #9fa1b3;
  }

  #aside-elements-wrapper {
    position: sticky;
    top: 30px;
  }
</style>
