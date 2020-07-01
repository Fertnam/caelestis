<template>
  <router-link
    id="logo"
    src="/images/logo.png"
    draggable="false"
    alt="Логотип"
    tag="img"
    :to="{name: 'general-home'}"
    exact
  />
</template>

<style>
  #logo {
    cursor: pointer;
    width: 16%;
  }
</style>
