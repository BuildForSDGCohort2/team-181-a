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

import VueGoodTablePlugin from 'vue-good-table';

// import the styles
import 'vue-good-table/dist/vue-good-table.css'

Vue.use(VueGoodTablePlugin);

Vue.use(ElementUI, { locale });


import Chartkick from 'vue-chartkick'
import Chart from 'chart.js'
Vue.use(Chartkick.use(Chart))

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


import { mapState } from "vuex";

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

    data: {
        cart_count: 0,
        snackbar: false,
        text: '',
        form: {
            weight: '',
            approximation: 'months'
        },
        edit_form: {},
    },
    methods: {
        toggleActive(i) {
            // alert('dwdwdddw');
            // this.activeKey = this.isActive(i) ? null : i;
            var payload = {
                model: 'addCart',
                data: this.form
            }
            this.cart_count += 1
            this.text = 'Cart update'
            this.snackbar = true
            this.$store.dispatch('postItems', payload)
                .then(response => {
                    // this.cart_count += 1
                    // eventBus.$emit("broodEvent")
                });
        },
        checkout(data) {

            this.text = 'Checkout complete'
            this.snackbar = true
            var payload = {
                model: 'checkout',
                data: this.form,
                data: this.form
            }
            this.cart_count += 1
            this.$store.dispatch('patchItems', payload)
                .then(response => {
                    // this.cart_count += 1
                    // eventBus.$emit("broodEvent")
                });

        },

        reduceCart() {
            if (this.cart_count > 0) {
                this.cart_count -= 1
            }
        },
        addCart() {
            this.cart_count += 1
        },

        get_items(model, update) {
            var payload = {
                model: model,
                data: this.form,
                update: update
            }
            console.log(payload);

            this.$store.dispatch('getItems', payload)
                .then(response => {
                    // eventBus.$emit("pushEvent", response)
                });
        },
        save_item(model) {
            var payload = {
                model: model,
                data: this.form
            }
            console.log(payload);

            this.$store.dispatch('postItems', payload)
                .then(response => {
                    this.success('Created')
                    eventBus.$emit("pushEvent", response)
                });
        },
        update_item(model) {
            var payload = {
                model: model,
                data: this.edit_form,
                id: this.edit_form.id,
            }
            console.log(payload);
            this.$store.dispatch('patchItems', payload)
                .then(response => {
                    this.success('Updated')
                    eventBus.$emit("pushEvent", response)
                });
        },
        open_edit(data) {
            console.log(data);
            this.edit_form = data

        },
        birth_day(data) {
            var diff = Math.floor(( Date.parse(new Date()) - Date.parse(this.form.birthday) ) / 86400000);
            console.log(data);

            if (data) {
                var approx = data
            } else {
                var approx = this.form.approximation
            }
            if (approx == "months") {
                console.log('months');

                diff = parseInt(diff) / 30
            } else if(approx == "years") {
                console.log('years');
                diff = parseInt(diff) / 365
            }
            this.form.approx_age = parseFloat(diff).toFixed(1)
        },
        success(text) {
            this.text = text
            this.snackbar = true
        }
    },
    computed: {
        ...mapState(['errors', 'loading']),
    },
});
