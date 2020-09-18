import Vue from 'vue'
import VueRouter from 'vue-router'


Vue.use(VueRouter)



import myUser from './components/users/'

import myDashboard from "./components/dashboard";
import myAnimal from "./components/animals";
import myOrders from "./components/orders";
import myAnimalFacts from "./components/animalfacts";
import myProfessional from "./components/professionals";
import myExpediture from "./components/expediture";




const routes = [
    { path: '/', component: myDashboard },
    { path: '/users', component: myUser },
    { path: '/animals', component: myAnimal },
    { path: '/orders', component: myOrders },
    { path: '/animal-facts', component: myAnimalFacts },
    { path: '/professionals', component: myProfessional },
    { path: '/expediture', component: myExpediture },
]

export default new VueRouter({routes})
