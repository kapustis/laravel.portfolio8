<template>
    <div>
        <div>
            <img :src="avatar" width="50" height="50" :alt="user.name">
        </div>
        <form v-if="canUpdate" method="POST" enctype="multipart/form-data">
            <image-upload name="avatar" @loaded="onLoad"/>
        </form>
    </div>
</template>

<script>
  export default {
    props: ['user'],
    components: {
      ImageUpload: () => import('./ImageUpload.vue')
    },
    data() {
      return {
        avatar: this.user.avatar_path
      };
    },
    computed: {
      canUpdate() {
        return this.authorize(user => user.id === this.user.id);
      }
    },
    methods: {
      onLoad(avatar) {
        this.avatar = avatar.src;
        this.persist(avatar.file);
      },
      persist(avatar) {
        let data = new FormData();
        data.append('avatar', avatar);
        axios.post(`/api/users/${this.user.name}/avatar`, data).then(() => flash('Avatar uploaded!'));
      }
    }
  }
</script>
