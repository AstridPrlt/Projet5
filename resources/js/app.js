/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
// import VueRouter from 'vue-router';
// Vue.use(VueRouter);

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// import PublicHome from './components/PublicHome.vue';
// import Details from './components/DetailsComponent.vue';
// import Events from './components/EventsComponent.vue';
// import Comm from './components/CommComponent.vue';
// import Booking from './components/BookingComponent.vue';

// const routes = [
//     {
//         path: '/',
//         component: PublicHome,
//     },
//     {
//         path: '/details',
//         component: Details
//     },
//     {
//         path: '/events',
//         component: Events
//     },
//     {
//         path: '/coweerkers',
//         component: Comm
//     },
//     {
//         path: '/inscription/:id',
//         name: 'inscription',
//         component: Booking,
//     }
// ];

// const router = new VueRouter({routes});

Vue.component('events-component', require('./components/EventsComponent.vue').default);
Vue.component('booking-component', require('./components/BookingComponent.vue').default);
Vue.component('my-events-component', require('./components/MyEventsComponent.vue').default);
Vue.component('my-profile-component', require('./components/MyProfileComponent.vue').default);
Vue.component('my-contacts-component', require('./components/MyContactsComponent.vue').default);

Vue.component('future-events-component', require('./components/admin/FutureEventsComponent.vue').default);
Vue.component('past-events-component', require('./components/admin/PastEventsComponent.vue').default);
Vue.component('create-event-component', require('./components/admin/CreateEventComponent.vue').default);
Vue.component('modify-event-component', require('./components/admin/ModifyEventComponent.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '.appVue',
});
