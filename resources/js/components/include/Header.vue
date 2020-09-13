<template>
<v-app id="inspire">
    <v-navigation-drawer v-model="drawer" :clipped="clipped" app>

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
                    <router-link to="/" class="v-list-item v-list-item--link theme--light">
                        <div class="v-list__tile__action">
                            <v-icon>mdi-view-dashboard</v-icon>
                        </div>
                        <div class="v-list-item__content">
                            <div class="v-list-item__title">Dashboard</div>
                        </div>
                    </router-link>
                    <router-link to="/animals" class="v-list-item v-list-item--link theme--light">
                        <div class="v-list__tile__action">
                            <v-icon>mdi-cow</v-icon>
                        </div>
                        <div class="v-list-item__content">
                            <div class="v-list-item__title">Animals</div>
                        </div>
                    </router-link>


                    <router-link to="/animal-facts" class="v-list-item v-list-item--link theme--light">
                        <div class="v-list__tile__action">
                            <v-icon>mdi-pig</v-icon>
                        </div>
                        <div class="v-list-item__content">
                            <div class="v-list-item__title">Animals Facts</div>
                        </div>
                    </router-link>
                    <router-link to="/orders" class="v-list-item v-list-item--link theme--light">
                        <div class="v-list__tile__action">
                            <v-icon>mdi-cart</v-icon>
                        </div>
                        <div class="v-list-item__content">
                            <div class="v-list-item__title">Orders</div>
                        </div>
                    </router-link>


                    <router-link to="/professionals" class="v-list-item v-list-item--link theme--light">
                        <div class="v-list__tile__action">
                            <v-icon>mdi-professional-hexagon</v-icon>
                        </div>
                        <div class="v-list-item__content">
                            <div class="v-list-item__title">Professionals</div>
                        </div>
                    </router-link>
                    <router-link to="/expediture" class="v-list-item v-list-item--link theme--light">
                        <div class="v-list__tile__action">
                            <v-icon>mdi-briefcase-minus-outline</v-icon>
                        </div>
                        <div class="v-list-item__content">
                            <div class="v-list-item__title">Expediture</div>
                        </div>
                    </router-link>


                    <v-list-group prepend-icon="mdi-account-circle">
                        <template v-slot:activator>
                            <v-list-item-title>Users</v-list-item-title>
                        </template>
                        <router-link to="/users" class="v-list-item v-list-item--link theme--light">
                            <div class="v-list__tile__action">
                                <v-icon>mdi-account-multiple-plus-outline</v-icon>
                            </div>
                            <div class="v-list-item__content">
                                <div class="v-list-item__title">Users</div>
                            </div>
                        </router-link>
                        <router-link to="/roles" class="v-list-item v-list-item--link theme--light">
                            <div class="v-list__tile__action">
                                <v-icon>mdi-rotate-left-variant</v-icon>
                            </div>
                            <div class="v-list-item__content">
                                <div class="v-list-item__title">Roles</div>
                            </div>
                        </router-link>
                    </v-list-group>
                </v-card>
            </template>
        </v-list>
    </v-navigation-drawer>

    <v-app-bar :clipped-left="clipped" app color="blue darken-3" dark>
        <v-app-bar-nav-icon @click.stop="drawer = !drawer" />
        <v-toolbar-title style="width: 300px" class="ml-0 pl-4">
            <img src="/storage/logo.jpg" alt style="width: 130px; height: 60px;border-radius: 20px;">
        </v-toolbar-title>
        <v-spacer />
        <LogoutClient :user="user" v-if="user.is_client"></LogoutClient>
        <Logout :user="user"></Logout>
        <!-- <VDivider vertical style="margin-top: 0px;" /> -->

    </v-app-bar>

    <v-snackbar :timeout="timeout" bottom :color="Snackcolor" right v-model="snackbar">
        {{ message }}
        <v-icon dark right>{{ icon }}</v-icon>
    </v-snackbar>
    <v-footer style="background: #e2e0e0 !important;" app>
        <span style="color: #000; margin: auto;">Farmer &copy; {{ new Date().getFullYear() }}</span>
    </v-footer>
</v-app>
</template>

<script>
import Logout from "./Logout";
import LogoutClient from "./LogoutClient";
export default {
    components: {
        Logout,
        LogoutClient
    },
    props: ["user"],
    data() {
        return {
            clipped: true,
            icon: "",
            Snackcolor: '',
            color: "rgb(25, 117, 210)",
            loading: false,
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
    },
    created() {
        eventBus.$on("progressEvent", data => {
            this.$Progress.start()
        });
        eventBus.$on("StoprogEvent", data => {
            this.$Progress.finish()
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

.theme--light.v-application {
    /* margin-top: -650px; */
}
</style>
