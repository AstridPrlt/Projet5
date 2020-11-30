/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

Vue.component('events-component', require('./components/events/EventsComponent.vue').default);
Vue.component('booking-component', require('./components/events/BookingComponent.vue').default);
Vue.component('payment-component', require('./components/events/PaymentComponent.vue').default);

Vue.component('coweerkers-component', require('./components/users/CoweerkersComponent.vue').default);

Vue.component('my-events-component', require('./components/users/MyEventsComponent.vue').default);
Vue.component('my-profile-component', require('./components/users/MyProfileComponent.vue').default);
Vue.component('my-contacts-component', require('./components/users/MyContactsComponent.vue').default);

Vue.component('future-events-component', require('./components/admin/FutureEventsComponent.vue').default);
Vue.component('past-events-component', require('./components/admin/PastEventsComponent.vue').default);
Vue.component('create-event-component', require('./components/admin/CreateEventComponent.vue').default);
Vue.component('modify-event-component', require('./components/admin/ModifyEventComponent.vue').default);
Vue.component('list-event-component', require('./components/admin/ListEventComponent.vue').default);
Vue.component('list-users-component', require('./components/admin/ListUsersComponent.vue').default);
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '.appVue',
});
