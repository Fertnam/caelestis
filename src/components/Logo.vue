<template>
  <router-link
    tag="img"
    :to="{name: 'general-home'}"
    id="logo"
    src="/images/logo.png"
    alt="Логотип"
    draggable="false"
    exact
  />
</template>

<style>
  #logo {
    cursor: pointer;
    width: 16%;
  }
</style>
