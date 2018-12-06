<template>
  <div class="">
    <div class=" is-hidden-mobile">
      <div class="level-item">
        <transition mode="out-in"
          enter-active-class="fadeIn"
          leave-active-class="fadeOut">
          <p class="animated"
              id="page-title"
              v-if="loaded">
              {{ title }}
          </p>
        </transition>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: 'PageHeader',
  props: {
    title: {
      type: String,
      default: null,
    },
  },
  data() {
    return {
      loaded: true,
    };
  },
  watch: {
    title: {
      handler() {
        this.loaded = false;
        setTimeout(() => {
          this.loaded = true;
        }, 350);
      },
    },
  },
};
</script>
