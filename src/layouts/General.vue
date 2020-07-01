<template>
  <div id="wrapper">
    <header>
      <TheLogo/>
    </header>
    <div id="navbar-wrapper">
      <navbar></navbar>
      <mobile-navbar></mobile-navbar>
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
      <usermenu></usermenu>
      <server-monitoring></server-monitoring>
    </aside>
    <footer>
      <p>Копирование элементов дизайна запрещено</p>
    </footer>
  </div>
</template>

<script>
  import TheLogo from '@/components/TheLogo';
  import Navbar from '@/components/general/navbars/Navbar';
  import MobileNavbar from '@/components/general/navbars/MobileNavbar';
  import ServerMonitoring from '@/components/general/aside-wrappers/ServerMonitoring';
  import Usermenu from '@/components/general/aside-wrappers/Usermenu';

  export default {
    components: {
      TheLogo,
      Navbar,
      MobileNavbar,
      ServerMonitoring,
      Usermenu
    }
  };
</script>

<style>
  /* Настройка сетки grid */
  #wrapper {
    display: grid;
    grid-template-columns: 72% 28%;
    grid-template-areas: "header header"
                         "navbar-wrapper navbar-wrapper"
                         "main aside"
                         "footer footer";
  }

  header {
    grid-area: header;
  }

  #navbar-wrapper {
    grid-area: navbar-wrapper;
  }

  #mobile-menu {
    grid-area: mobile-menu;
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

  /* Остальные настройки */
  body {
    font-family: Arial, sans-serif;
    color: #878cb0;
  }

  main, aside {
    color: #101121;
  }

  h1 {
    margin: 0 0 50px;
    font-size: 1.5em;
    background-color: #878cb0;
    box-shadow: -6px 6px #5f627d;
    padding: 16px;
    font-weight: bold;
  }

  .menu-list {
    margin: 0;
    padding: 0;
  }

  .menu-list > li {
    font-weight: bold;
  }

  /* Header */
  header {
    background: url(/images/header-bg.png) center 90% / cover;
    height: 35vh;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  /* Main */
  main {
    padding: 30px;
    background-color: #c6c9de;
  }

  /* Aside */
  aside {
    text-align: center;
    padding: 30px;
    background-color: #9fa1b3;
  }

  /* Footer */
  footer {
    text-align: center;
    padding: 20px 30px;
    background-color: #101121;
  }
</style>
