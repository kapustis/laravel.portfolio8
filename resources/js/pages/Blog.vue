<template>

</template>

<script>
export default {
  name: "BlogView",
  props: ['thread'],
  components: {
    replies: () => import("../components/Replies"),
    SubscribeButton: () => import("../components/SubscribeButton"),
  },
  data() {
    return {
      repliesCount: this.thread.replies_count,
      form: null,
      locked: this.thread.locked,
      title: this.thread.title,
      body: this.thread.body,
      editing: false
    }
  },
  methods: {
    lockToggle() {
      axios[this.locked ? 'delete' : 'post']('/locked-threads/' + this.thread.slug);
      this.locked = !this.locked;
    },
    editToggle() {
      this.editing = true;
      this.form = {
        title: this.thread.title,
        body: this.thread.body
      };
    },
    cancelToggle() {
      this.editing = false;
      this.form = null;
    },
    update() {
      const uri = `/blog/${this.thread.channel.slug}/${this.thread.slug}`;

      axios.patch(uri, this.form).then(() => {
        this.editing = false;
        this.title = this.form.title;
        this.body = this.form.body;
        flash('Your thread has been updated.', 'success');
      })
    }

  }
}
</script>
