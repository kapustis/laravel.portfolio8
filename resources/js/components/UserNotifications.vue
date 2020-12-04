<template>
    <li v-if="notifications.length">
        <a href="#">
            <span><i class="fa fa-bell" aria-hidden="true"></i></span>
        </a>
        <ul class="drop-menu">
            <li v-for="notification in notifications">
                <a :href="notification.data.link"
                   v-text="notification.data.message"
                   @click="markAsRead(notification)">
                </a>
            </li>
        </ul>
    </li>
</template>

<script>
  export default {
    data() {
      return {notifications: false}
    },
    created() {
      axios.get("/profiles/" + window.Laravel.user.name + "/notifications").then(response => this.notifications = response.data);
    },
    methods: {
      markAsRead(notification) {
        axios.delete('/profiles/' + window.Laravel.user.name + '/notifications/' + notification.id)
      }
    }
  }
</script>

<style scoped>
    .drop-menu {
        position: absolute;
        display: flex;
        flex-direction: column;
        top: 100%;
        background-color: #051428;
    }

    .drop-menu li {
        position: relative;
        padding: 5px;
        display: none;
    }


    li:hover > ul.drop-menu {
        border: #0a6d9b solid 1px;
    }

    li:hover > ul.drop-menu li {
        display: initial;
    }

</style>
