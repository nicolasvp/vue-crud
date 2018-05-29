
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

require('bootstrap-vue');
//Vue.use(VBootstrapVue);

// require('bootstrap/dist/css/bootstrap.css');
// require('bootstrap-vue/dist/bootstrap-vue.css');
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('clients', require('./components/TableComponent.vue'));
Vue.component('v-nav', require('./components/NavComponent.vue'));
Vue.component('v-modal',require('./components/ModalComponent.vue'));
Vue.component('paginate', require('vuejs-paginate'));

const app = new Vue({
    el: '#app'
});
