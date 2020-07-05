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
    border: none;
    padding: 0;
  }

  button, select, a {
    cursor: pointer;
  }

  input, button, select, svg {
    transition-duration: 500ms;
  }

  svg {
    transition-property: color, transform;
  }

  a {
    color: inherit;
  }

  .clearfix:after {
    content: "";
    display: table;
    width: 100%;
    clear: both;
  }
</style>
