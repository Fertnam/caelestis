<template>
  <div id="app">
    <router-view></router-view>
  </div>
</template>

<style>
  @import "~reset-css/reset.css";
  @import "~animate.css/animate.min.css";

  * {
    box-sizing: border-box;
    outline: none;
  }

  .clearfix:after {
    content: "";
    display: table;
    width: 100%;
    clear: both;
  }
</style>
