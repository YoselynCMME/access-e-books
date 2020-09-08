/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import { BootstrapVue} from 'bootstrap-vue'

// Install BootstrapVue
Vue.use(BootstrapVue)

// app.js
// import 'bootstrap/dist/css/bootstrap.css'
// import 'bootstrap-vue/dist/bootstrap-vue.css'

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('blackboard-component', require('./components/BlackboardComponent.vue').default);
Vue.component('menu-component', require('./components/MenuComponent.vue').default);

Vue.component('m-alert-component', require('./components/AlertComponent.vue').default);

// MATERIALS
Vue.component('materials-component', require('./components/materials/MaterialsComponent.vue').default);
Vue.component('partial-cards', require('./components/materials/partials/PartialCards.vue').default);

// BOOKS
Vue.component('books-component', require('./components/administrator/BooksComponent.vue').default);
Vue.component('users-component', require('./components/administrator/UsersComponent.vue').default);
Vue.component('books-user-component', require('./components/administrator/BooksUserComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
