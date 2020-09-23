<template>
<div style="background: linear-gradient(0deg, rgb(0, 0, 0), rgba(12, 12, 12, 0.55)), url(http://team188.jim/material/img/login.jpg);color: #fff !important;padding: 0;background-size: cover; background-position: top center;align-items: center;height: 100vh">
    <div class="container">
        <div class="row justify-content-center" style="margin-top: 100px;">
            <v-card style="width: 80%">
                <v-card-title>
                    Professionals
                    <v-spacer></v-spacer>
                    <v-text-field v-model="search" append-icon="mdi-magnify" label="Search" single-line hide-details></v-text-field>
                </v-card-title>
                <v-data-table :headers="headers" :items="supplier_data" :search="search">
                    <template v-slot:item.name="{ item }">
                            <v-btn @click="openShow(item)" text :color="color">{{ item.name }}</v-btn>
                        </template>
                    <template v-slot:item.rating="{ item }">
                            <v-rating v-model="item.rating" readonly half-increments :color="color"></v-rating>

                        </template>
                </v-data-table>
            </v-card>
        </div>
    </div>
    <div class="container" style="margin-top: 10px">
        <nav class="float-left">
            <ul>
                <li class="list-group-item">
                    <a href="#">
                        About Us
                    </a>
                </li>
            </ul>
        </nav>
        <v-spacer></v-spacer>
        <div class="copyright float-right">
            &copy;{{ new Date().getFullYear() }}, Made with <i class="material-icons">favorite</i> ,For A Happier
            <a href="/" style="color: green">Farmer</a> and A Happier Better Africa.
        </div>
    </div>
</div>
</template>

<script>
export default {
    components: {},
    data() {
        return {
            color: 'rgb(255, 179, 0)',
            search:'',
            headers: [{
                    text: 'Name',
                    align: 'start',
                    value: 'name',
                },
                {
                    text: 'Email',
                    value: 'email'
                },
                {
                    text: 'Phone',
                    value: 'phone'
                },
                {
                    text: 'Address',
                    value: 'address'
                },
                {
                    text: 'Rating',
                    value: 'rating'
                },
            ],

            supplier_data: [{
                id: 1,
                name: "PJohn Doe",
                email: "john@gmail.com",
                address: "78662 Verlie Falls Effertzview, VA 88814-2313",
                phone: "(815) 608-1633",
                rating: 4.5,
            }]
        }
    },
    methods: {
        openShow() {
            eventBus.$emit('openShowrEvent')
        },
        openProfessional() {
            eventBus.$emit('openProfessionalEvent')
        },
        openFarmer() {
            eventBus.$emit('openFarmerEvent')
        },
    },
}
</script>
