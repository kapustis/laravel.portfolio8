<template>
  <div class="comment-main-level">
    <div class="comment-avatar">
      <img :src="data.owner.avatar_path" :alt="data.owner.name">
    </div>

    <div class="comment-box" :class="isBest ? 'success': ''">
      <div class="comment-head" >
        <h6 class="comment-name" :class="isAuthorThreads ? 'by-author' : ''">
          <a :href="'/profiles/'+data.owner.name" v-text="data.owner.name"></a>
        </h6>
        <span v-text="ago"></span>
        <!--<i class="fa fa-reply"></i>-->
        <div v-if="signedIn" style="right: 0">
          <favorite :reply="data"></favorite>
        </div>
      </div>

      <div class="comment-content">
        <div v-if="editing">
          <div>
            <wysiwyg v-model="body"></wysiwyg>
          </div>
          <button class="btn" @click="update">Update</button>
          <button class="btn" @click="editing = false">Cancel</button>
        </div>

        <div v-else v-html="body"/>

        <div class="comment-footer">
          <div v-if="authorize('owns', data)">
            <button @click="editing = true">Edit</button>
            <button @click="destroy">Delete</button>
          </div>

          <button class="btn btn-xs btn-default"
                  @click="markBestReply"
                  v-if="authorize('owns', data.thread) && ! isBest && ! isAuthorThreads"
          >
            <i class="fa  fa-thumbs-up"></i>
            Best Reply?
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

import moment from 'moment';

moment.defineLocale('en-foo', {parentLocale: 'en'});

export default {
  name: "Reply",
  props: ['data'],
  components: {
    Favorite: () => import("./Favorite.vue")
  },
  data() {
    return {
      editing: false,
      id: this.data.id,
      body: this.data.body,
      isBest: this.data.isBest,
      isAuthorThreads: this.data.isAuthorThreads,
    };
  },
  computed: {
    ago() {
      return moment(this.data.created_at).locale(window.default_locale).fromNow();
    },
  },
  created() {
    window.events.$on('best-reply-selected', id => {
      this.isBest = (id === this.id);
    });
  },

  methods: {
    update() {
      axios.patch(`/replies/${this.data.id}`, {body: this.body})
      .catch(error => {
        flash(error.response.data, 'danger');
      });
      this.editing = false;
      flash('Updated!');
    },
    destroy() {
      axios.delete(`/replies/${this.data.id}`);
      this.$emit('deleted', this.data.id);
    },
    markBestReply() {
      axios.post(`/replies/${this.data.id}/best`);
      window.events.$emit('best-reply-selected', this.data.id);
    }
  }
}
</script>
<style scoped>
.success {
  /*background-color: aquamarine;*/
  box-shadow: 0 0 2rem 1rem rgba(145, 255, 211, 1);
}
</style>
