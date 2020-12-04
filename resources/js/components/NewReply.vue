<template>
    <div>
        <div class="form-group">
            <wysiwyg id="body" name="body" v-model="body" placeholder="Have something to say?" :shouldClear="completed"></wysiwyg>
        </div>
        <button @click="addReply" type="submit" class="button">Отправить</button>
    </div>

</template>

<script>
  import Tribute from "tributejs";

  export default {
    mounted() {
      function remoteSearch(text, cb) {
        let URL = "/api/users";
        let xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function () {
          if (xhr.readyState === 4) {
            if (xhr.status === 200) {
              let data = JSON.parse(xhr.responseText);
              console.log(data)
              if (data) {
                cb(data.map(el => ({name: el})));
              } else {
                cb([]);
              }
            } else if (xhr.status === 403) {
              cb([]);
            }
          }
        };
        xhr.open("GET", URL + "?name=" + text, true);
        xhr.send();
      }

      let tribute = new Tribute({
        trigger: "@",
        menuShowMinLength: 3,
        lookup: 'name',
        fillAttr: 'name',
        values: function (text, cb) {
          remoteSearch(text, users => cb(users));
        },
      });

      tribute.attach(document.getElementById('body'));
    },
    data() {
      return {
        body: '',
        completed: false,
        val: null
      }
    },

    methods: {
      addReply() {
        axios.post(location.pathname + '/replies', {body: this.body})
        .catch(error => {
          flash(error.response.data, 'danger');
        })
        .then(({data}) => {
          this.body = '';
          this.completed = true;
          flash('Your reply has been posted');
          this.$emit('created', data);
        });
      },
    }

  }
</script>
