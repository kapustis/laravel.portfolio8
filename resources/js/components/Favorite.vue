<template>
  <button type="submit"  @click="toggle">
<!--    :class="classes"-->
    <i class="fa fa-heart"></i>
    <span v-text="count"></span>
  </button>
</template>

<script>
export default {
  props: ['reply'],

  data() {
    return {
      count: this.reply.favoritesCount,
      active: this.reply.isFavorited
    }
  },
  computed: {
  //   classes() {
  //     return ['btn', this.active ? 'btn-primary' : 'btn-default'];
  //   },

    endpoint() {
      return '/reply/' + this.reply.id + '/favorites';
    }
  },
  methods: {
    toggle() {
      if (this.active) {
        axios.delete(this.endpoint);
        this.active = false;
        this.count--;
      } else {
        axios.post(this.endpoint);
        this.active = true;
        this.count++;
      }

    }
  }
}
</script>

<style scoped>
button {
  border: none;
  margin: 0;
  padding: 0;
  width: auto;
  overflow: visible;
  background: transparent;
  color: inherit;
  font: inherit;
  line-height: normal;
}
button:focus {outline:0;}
span {
  margin-right: 0.5rem;
}
</style>
