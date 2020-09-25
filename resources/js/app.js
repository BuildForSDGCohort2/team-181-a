/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window.eventBus = new Vue()

import vuetify from './vuetify'
import router from './router'
import store from './vuex'

import ElementUI from 'element-ui';
import locale from 'element-ui/lib/locale/lang/en'
import 'element-ui/lib/theme-chalk/index.css';
// import '../theme/index.css'

// import 'material-design-icons-iconfont/dist/material-design-icons.css'

import VueGoodTablePlugin from 'vue-good-table';

// import the styles
import 'vue-good-table/dist/vue-good-table.css'

Vue.use(VueGoodTablePlugin);

Vue.use(ElementUI, { locale });


import Chartkick from 'vue-chartkick'
import Chart from 'chart.js'
Vue.use(Chartkick.use(Chart))

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
// import myExample from './components/ExampleComponent.vue'
// import myHeader from './components/include/Header'
// import myApp from './components/app.vue'
import myHome from './components/register'
import mySupplier from './components/browse/supplier'
import myProfessional from './components/browse/professional'


import myRegsupply from './components/register/supplier'

import myCharts from './components/charts'


import myAnimal from "./components/animals";
import myPlantation from "./components/plantation";

import myBrood from "./components/brood";

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


const app = new Vue({
    el: '#app',
    router,
    store,
    vuetify,
    components: {
        // myHeader, myApp,
        mySupplier, myHome, myProfessional,
        myCharts, myAnimal, myPlantation, myRegsupply, myBrood
    },
});
