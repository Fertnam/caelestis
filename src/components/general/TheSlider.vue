<template>
  <div
    id="slider-wrapper"
    class="dark-theme"
  >
    <div>
      <button
        id="slider-prev-button"
        @click="prev"
      >
        <fa-icon icon="chevron-circle-left"/>
      </button>
      <div
        id="slider-images-wrapper"
        :style="{'margin-left': '-' + (position * 100) + '%'}"
      >
        <img
          v-for="{id, name} in slides"
          :key="id"
          :src="dirPath + name"
          alt="Слайд"
        >
      </div>
      <button
        id="slider-next-button"
        @click="next"
      >
        <fa-icon icon="chevron-circle-right"/>
      </button>
      <div id="slider-spans-wrapper">
        <span
          v-for="{id} in slides"
          :key="id"
          @click="position = id"
        >
          <fa-icon :icon="(id === position) ? 'dot-circle' : ['far', 'dot-circle']"/>
        </span>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    props: {
      dirPath: {
        type: String,
        required: true
      },
      slides: {
        type: Array,
        required: true
      },
      intervalDelay: {
        type: Number,
        default: 40000
      }
    },
    data() {
      return {
        position: 0,
        intervalId: null
      };
    },
    methods: {
      prev() {
        if (this.position > 0) {
          this.position--;
        } else {
          this.position = this.slides.length - 1;
        }
      },
      next() {
        if (this.position < (this.slides.length - 1)) {
          this.position++;
        } else {
          this.position = 0;
        }
      }
    },
    mounted() {
      this.intervalId = setInterval(() => this.next(), this.intervalDelay);
    },
    destroyed() {
      clearInterval(this.intervalId);
    }
  };
</script>

<style>
  #slider-wrapper {
    padding: 7px;
    position: relative;
    margin-bottom: 40px;
  }

  #slider-wrapper > div {
    overflow: hidden;
  }

  #slider-wrapper button {
    background-color: rgba(255,255,255,0);
    font-size: 2.5em;
    width: 10%;
    position: absolute;
    top: 7px;
    bottom: 7px;
    opacity: 0;
  }

  #slider-wrapper button:hover {
    opacity: .8;
  }

  #slider-next-button {
    right: 7px;
  }

  #slider-images-wrapper {
    display: flex;
    transition: ease 800ms;
  }

   #slider-images-wrapper, #slider-images-wrapper img {
     width: 100%;
   }

   #slider-wrapper button, #slider-spans-wrapper {
     color: #c6c9de;
   }

   #slider-spans-wrapper {
    font-size: 1.3em;
    text-align: center;
    position: absolute;
    left: calc(10% + 7px);
    right: calc(10% + 7px);
    bottom: calc(4% + 7px);
   }

   #slider-spans-wrapper span {
    cursor: pointer;
    display: inline-block;
    transition: 500ms;
   }

   #slider-spans-wrapper span:not(:last-child) {
     margin-right: 12px;
   }

   #slider-spans-wrapper span:hover {
    transform: scale(1.2);
   }
</style>
