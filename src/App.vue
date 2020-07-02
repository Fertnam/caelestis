<template>
  <div id="app">
    <router-view/>
  </div>
</template>

<style>
  @import "~reset-css/reset.css";
  @import "~animate.css/animate.min.css";

  * {
    box-sizing: border-box;
    outline: none;
  }

  input, button, select {
    width: 100%;
    font-size: 1em;
    transition-duration: 500ms;
  }

  button, select {
    cursor: pointer;
  }

  .clearfix:after {
    content: "";
    display: table;
    width: 100%;
    clear: both;
  }
</style>
