/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import VTooltip from 'v-tooltip'

require('./bootstrap');

window.Vue = require('vue');

Vue.use(VTooltip);

require('./sidebar');
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

// Vue.component('codes-dashboard', () => import('./components/CodesDashboard.vue'));
// Vue.component('cards-dashboard', () => import('./components/CardsDashboard.vue'));
// Vue.component('links-dashboard', () => import('./components/LinksDashboard.vue'));
// Vue.component('operators-dashboard', () => import('./components/OperatorsDashboard.vue'));
// Vue.component('gateways-dashboard', () => import('./components/GatewaysDashboard.vue'));
// Vue.component('charges-dashboard', () => import('./components/ChargesDashboard.vue'));
// Vue.component('purchases-dashboard', () => import('./components/PurchasesDashboard.vue'));
// Vue.component('numbers-dashboard', () => import('./components/NumbersDashboard.vue'));
// Vue.component('package-minutes-dashboard', () => import('./components/PackagesMinutesDashboard.vue'));
// Vue.component('reports-dashboard', () => import('./components/ReportsDashboard.vue'));
// Vue.component('errors-dashboard', () => import('./components/ErrorsDashboard.vue'));
// Vue.component('ajax-dashboard', () => import('./components/AjaxDashboard.vue'));
// Vue.component('scripts-dashboard', () => import('./components/ScriptsDashboard.vue'));
// Vue.component('calls-dashboard', () => import('./components/CallsDashboard.vue'));
// Vue.component('tasks-dashboard', () => import('./components/TasksDashboard.vue'));
// Vue.component('monitoring-dashboard', () => import('./components/MonitoringDashboard.vue'));



Vue.component('users-dashboard', require('./components/UsersDashboard.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
