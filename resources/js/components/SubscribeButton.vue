<template>
    <button :class="classes" @click="subscribe">Subscribe</button>
</template>

<script>
  export default {
    name: 'SubscribeButton',
    props: ['active'],
    data() {
      return {
        activ: this.active
      };
    },
    computed: {
      classes() {
        return ['button', this.activ ? 'btn-primary' : 'btn-default'];
      },
    },

    methods: {
      subscribe: function () {
        axios[(this.active ? 'delete' : 'post')](`${location.pathname}/subscription`);
        this.activ = !this.activ;
      }
    }
  }
</script>

<!--<style scoped>-->
<!--    .btn-primary {-->
<!--        background-color: #0e6a62;-->
<!--        color: #ffffff;-->
<!--    }-->

<!--    .btn-default {-->
<!--        background-color: #6c797f;-->
<!--        color: #ffffff;-->
<!--    }-->
<!--</style>-->
