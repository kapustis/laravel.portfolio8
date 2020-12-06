/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// window.Vue = require('vue');
import Vue from 'vue';
let authorization = require('./authorizations')

Vue.prototype.authorize = function (...params) {
    if (!window.Laravel.signedIn) {
        return false;
    }

    if (typeof params[0] === 'string') {
        return authorization[params[0]](params[1]);
    }
    console.log('return user')
    return params[0](window.Laravel.user);
};


Vue.prototype.signedIn = window.Laravel.signedIn;
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
/* todo my Vue*/
window.events = new Vue();
Vue.component('Flash', require('./components/Flash.vue').default);
Vue.component('paginator', require('./components/Paginator.vue').default);
Vue.component('blog-view', require('./pages/Blog.vue').default);
Vue.component('user-notifications', require('./components/UserNotifications.vue').default);
Vue.component('wysiwyg', require('./components/Wysiwyg.vue').default);
Vue.component('avatar-form', require('./components/AvatarForm.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});

window.flash = function (message, level = 'success') {
    window.events.$emit('flash', {message, level});
};


console.log("im works");

