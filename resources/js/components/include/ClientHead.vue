<template>
<v-app id="inspire">

    <v-navigation-drawer right temporary v-model="drawerRight" fixed>
        <v-list dense style="background: #f0f0f0;">
            <template>
                <Notifications></Notifications>
            </template>
        </v-list>
    </v-navigation-drawer>

    <v-navigation-drawer v-model="drawer" fixed app style="z-index: 1000 !important">
        <v-list dense id="navigation">
            <v-img :aspect-ratio="16/9" src="/storage/landS.jpg">
                <v-layout pa-2 column fill-height class="lightbox white--text">
                    <v-spacer></v-spacer>
                    <v-flex shrink>
                        <div class="subheading">{{ user.name }}</div>
                        <div class="body-1">{{ user.email }}</div>
                    </v-flex>
                </v-layout>
            </v-img>
            <template>
                <v-card>
                    <router-link to="/" class="v-list__tile v-list__tile--link">
                        <div class="v-list__tile__action">
                            <i aria-hidden="true" class="icon material-icons">dashboard</i>
                        </div>
                        <div class="v-list__tile__content">
                            <div class="v-list__tile__title">Dashboard</div>
                        </div>
                    </router-link>

                    <v-list-group prepend-icon="add_shopping_cart">
                        <v-list-tile slot="activator">
                            <v-list-tile-title>Orders Management</v-list-tile-title>
                        </v-list-tile>
                        <router-link to="/salesorders" class="v-list__tile v-list__tile--link">
                            <div class="v-list__tile__action">
                                <i aria-hidden="true" class="icon material-icons">shopping_cart</i>
                            </div>
                            <div class="v-list__tile__content">
                                <div class="v-list__tile__title">Orders</div>
                            </div>
                        </router-link>
                        <!-- <router-link to="/receiveorders" class="v-list__tile v-list__tile--link">
                            <div class="v-list__tile__action">
                                <i aria-hidden="true" class="icon material-icons">send</i>
                            </div>
                            <div class="v-list__tile__content">
                                <div class="v-list__tile__title">Send Orders</div>
                            </div>
                        </router-link> -->
                        <router-link to="/orderHistory" class="v-list__tile v-list__tile--link">
                            <div class="v-list__tile__action">
                                <i aria-hidden="true" class="icon material-icons">history</i>
                            </div>
                            <div class="v-list__tile__content">
                                <div class="v-list__tile__title">Orders History</div>
                            </div>
                        </router-link>
                        <!-- <router-link to="/sales" class="v-list__tile v-list__tile--link">
                            <div class="v-list__tile__action">
                                <i aria-hidden="true" class="icon material-icons">attach_money</i>
                            </div>
                            <div class="v-list__tile__content">
                                <div class="v-list__tile__title">Sales</div>
                            </div>
                        </router-link> -->
                    </v-list-group>

                    <v-list-group prepend-icon="list">
                        <v-list-tile slot="activator">
                            <v-list-tile-title>Inventory</v-list-tile-title>
                        </v-list-tile>
                        <router-link to="/products" class="v-list__tile v-list__tile--link">
                            <div class="v-list__tile__action">
                                <!-- <i aria-hidden="true" class="icon material-icons">dashboard</i> -->
                                <i class="fab fa-product-hunt"></i>
                            </div>
                            <div class="v-list__tile__content">
                                <div class="v-list__tile__title">Products</div>
                            </div>
                        </router-link>
                        <router-link to="/groups" class="v-list__tile v-list__tile--link">
                            <div class="v-list__tile__action">
                                <i aria-hidden="true" class="icon material-icons">group_work</i>
                            </div>
                            <div class="v-list__tile__content">
                                <div class="v-list__tile__title">Products Groups</div>
                            </div>
                        </router-link>
                        <router-link to="/sendInventory" class="v-list__tile v-list__tile--link">
                            <div class="v-list__tile__action">
                                <i aria-hidden="true" class="icon material-icons">send</i>
                            </div>
                            <div class="v-list__tile__content">
                                <div class="v-list__tile__title">Send Inventory</div>
                            </div>
                        </router-link>
                        <router-link to="/history" class="v-list__tile v-list__tile--link">
                            <div class="v-list__tile__action">
                                <i aria-hidden="true" class="icon material-icons">history</i>
                            </div>
                            <div class="v-list__tile__content">
                                <div class="v-list__tile__title">Product History</div>
                            </div>
                        </router-link>
                    </v-list-group>

                    <v-list-group prepend-icon="home">
                        <v-list-tile slot="activator">
                            <v-list-tile-title>Warehouse</v-list-tile-title>
                        </v-list-tile>
                        <router-link to="/createwarehouse" class="v-list__tile theme--light" style="text-decoration: none">
                            <v-list-tile-action>
                                <v-icon>business</v-icon>
                            </v-list-tile-action>
                            <v-list-tile-title>Warehouse</v-list-tile-title>
                        </router-link>
                    </v-list-group>
                    <v-list-group prepend-icon="assignment_return">
                        <v-list-tile slot="activator">
                            <v-list-tile-title>Returns</v-list-tile-title>
                        </v-list-tile>
                        <router-link to="/returns" class="v-list__tile theme--light" style="text-decoration: none">
                            <v-list-tile-action>
                                <v-icon>keyboard_return</v-icon>
                            </v-list-tile-action>
                            <v-list-tile-title>Returns</v-list-tile-title>
                        </router-link>
                    </v-list-group>
                    <router-link to="/invoice" class="v-list__tile v-list__tile--link">
                        <div class="v-list__tile__action">
                            <i aria-hidden="true" class="icon material-icons">book</i>
                        </div>
                        <div class="v-list__tile__content">
                            <div class="v-list__tile__title">Invoices</div>
                        </div>
                    </router-link>

                    <router-link to="/packages" class="v-list__tile v-list__tile--link">
                        <div class="v-list__tile__action">
                            <i aria-hidden="true" class="icon material-icons">book</i>
                        </div>
                        <div class="v-list__tile__content">
                            <div class="v-list__tile__title">Package</div>
                        </div>
                    </router-link>
                </v-card>
            </template>
        </v-list>
    </v-navigation-drawer>
    <v-toolbar :color="color" dark fixed app>
        <v-toolbar-title style="width: 600px" class="ml-0 pl-3">
            <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
            <!-- MFT fulfillment -->
            <img src="/storage/logo.jpg" alt style="width: 130px; height: 60px;border-radius: 20px;">
        </v-toolbar-title>
        <v-tooltip bottom>
            <v-btn icon slot="activator" class="mx-0" @click="getnotifications">
                <v-icon color="white darken-2" small>refresh</v-icon>
            </v-btn>
            <span>Refresh</span>
        </v-tooltip>
        <VSpacer />
        <Logout :user="user"></Logout>
        <VDivider vertical style="margin-top: 0px;"/>
        <v-badge color="black" right overlap>
            <template v-slot:badge>
                {{ notifications.length }}
            </template>
            <v-btn icon @click.stop="drawerRight = !drawerRight">
                <v-icon color="white lighten-1" large>
                    notifications
                </v-icon>
            </v-btn>
        </v-badge>
    </v-toolbar>

    <v-snackbar :timeout="timeout" bottom :color="Snackcolor" right v-model="snackbar">
        {{ message }}
        <v-icon dark right>{{ icon }}</v-icon>
    </v-snackbar>
    <v-footer style="background: #e2e0e0 !important;" app>
        <span style="color: #000; margin: auto;">Mft fulfillment center &copy; {{ new Date().getFullYear() }}</span>
    </v-footer>
</v-app>
</template>

<script>
import Notifications from "../notifications/Notification";
import Logout from "./Logout";
export default {
    components: {
        Notifications,
        Logout
    },
    props: ["user"],
    data() {
        return {
            icon: "",
            Snackcolor: '',
            color: "rgb(25, 117, 210)",
            loading: false,
            dialog: false,
            drawer: true,
            drawerRight: false,
            right: null,
            mode: "",
            snackbar: false,
            timeout: 5000,
            message: "Success",
        };
    },
    methods: {
        close() {
            this.dialog = false;
        },

        successAlert(data) {
            this.message = data;
            this.Snackcolor = "black";
            this.snackbar = true;
            this.icon = 'check_circle'
        },

        errorAlert(data) {
            this.message = data;
            this.Snackcolor = "red";
            this.snackbar = true;
            this.icon = 'block'
        },
        openFullScreen() {
            this.loading = this.$loading({
                lock: true,
                text: 'Loading',
                spinner: 'el-icon-loading',
                background: 'rgba(0, 0, 0, 0.7)'
            });
        },
        closeFullScreen() {
            this.loading.close();
        },
        getnotifications() {
            this.$store.dispatch('getnotifications')
        }
    },
    created() {
        eventBus.$on("progressEvent", data => {
            this.$refs.topProgress.start();
        });
        eventBus.$on("StoprogEvent", data => {
            this.$refs.topProgress.done();
        });
        eventBus.$on("alertRequest", data => {
            this.successAlert(data)
        });
        eventBus.$on("errorEvent", data => {
            this.errorAlert(data)
        });
        eventBus.$on("LoadingEvent", data => {
            // this.openFullScreen(data)
        });
        eventBus.$on("stopLoadingEvent", data => {
            // this.closeFullScreen(data)
        });

        eventBus.$on("notificationCountEvent", data => {
            this.notification = data
        });
    },
    computed: {
        notifications() {
            return this.$store.getters.notifications
        }
    },
    mounted() {
        this.getnotifications();
    },

};
</script>

<style scoped>
.v-expansion-panel__container:hover {
    border-radius: 10px !important;
    width: 90% !important;
    margin-left: 15px !important;
    background: #e3edfe !important;
    color: #1a73e8 !important;
}

.theme--light {
    background-color: #212120 !important;
    /* background: url('storage/logo1.jpg') !important; */
    color: #fff !important;
}

.v-toolbar[data-booted=true] {
    transition: .2s cubic-bezier(.4, 0, .2, 1);
    z-index: 100 !important;
}

.theme--light[data-v-67cb1297] {
    z-index: 101 !important;
}

.theme--dark.v-btn:not(.v-btn--text):not(.v-btn--text):not(.v-btn--outlined) {
    background-color: transparent !important;
}
</style>
