<template>
    <div class="alert alert-flash" :class="'alert-'+level" role="alert" v-show="show" v-text="body">
        <strong>Success!</strong> {{ body }}
    </div>
</template>

<script>
  export default {
    props: ['message'],
    data() {
      return {
        body: '',
        show: false,
        level: 'success'
      }
    },
    created() {
      if (this.message) {
        if (Array.isArray(this.message)) {
          this.flash(this.message);
          console.log(this.message)
        } else {
          this.body = this.message;
          this.show = true;
          this.hide();
        }
      }

      // window.events.$on(
      //   'flash', data => this.flash(data)
      // );
    },
    methods: {
      flash(data) {
        this.body = data.message;
        this.level = data.level;
        this.show = true;
        this.hide();
      },
      hide() {
        setTimeout(() => {
          this.show = false;
        }, 7000);
      }
    }
  }
</script>

<style>
    .alert {
        position: fixed;
        right: 10rem;
        bottom: 25rem;
        color: white;
        border: #0a6d9b solid 1px;
    }

    .alert-danger {
        background-color: #C2390D;
    }

    .alert-success {
        background-color: #0e6a62;
    }
</style>
