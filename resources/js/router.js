import Vue from 'vue'
import VueRouter from 'vue-router'


Vue.use(VueRouter)

import myUser from './components/users/'

import myAnimal from "./components/animals";
import myDashboard from "./components/dashboard";




const routes = [
    { path: '/', component: myDashboard },
    { path: '/users', component: myUser },
    { path: '/animals', component: myAnimal },
]

export default new VueRouter({routes})
