<template>
<v-main>
    <v-container fluid fill-height>
        <v-layout justify-center align-center wrap>
            <v-flex sm12>
                <v-card style="padding: 20px 0;">
                    <el-breadcrumb separator-class="el-icon-arrow-right">
                        <el-breadcrumb-item :to="{ path: '/' }">Dashboard</el-breadcrumb-item>
                        <el-breadcrumb-item>Orders</el-breadcrumb-item>
                    </el-breadcrumb>
                </v-card>
            </v-flex>
            <v-flex sm12>
                <!-- <myFilter :form="form" :user="user" style></myFilter> -->
            </v-flex>
            <v-flex sm12>
                <v-card style="padding: 10px 0;">
                    <v-layout row>
                        <v-flex sm1 style="margin-left: 10px;">
                            <v-tooltip right>
                                <template v-slot:activator="{ on }">
                                    <v-btn icon v-on="on" slot="activator" class="mx-0" @click="getOrder">
                                        <v-icon color="blue darken-2" small>mdi-refresh</v-icon>                                    </v-btn>
                                </template>
                                <span>Refresh</span>
                            </v-tooltip>
                        </v-flex>
                        <v-flex sm2>
                            <h3 style="margin-left: 30px !important;margin-top: 10px;">Orders</h3>
                        </v-flex>
                        <v-flex offset-sm8 sm2>
                            <v-btn color="info" @click="openCreate" text>Create Order</v-btn>
                        </v-flex>
                    </v-layout>
                </v-card>
            </v-flex>
            <v-flex sm12>
                <!-- <v-pagination v-model="order.current_page" :length="order.last_page" total-visible="5" @input="next_page(order.path, order.current_page)" circle v-if="order.last_page > 1"></v-pagination> -->
            </v-flex>
            <v-flex sm12>
                <v-data-table :headers="headers" :items="orders" :search="search"></v-data-table>
            </v-flex>
        </v-layout>
    </v-container>
    <Create></Create>
    <Edit></Edit>
</v-main>
</template>

<script>
import Create from "./create";
import Edit from "./edit";
import { mapState } from 'vuex';

export default {
    props: ['user'],
    components: {
        Create,
        Edit,
    },
    data() {
        return {
            search: "",
            headers: [{
                text: 'Created On',
                value: 'created_at'
            },{
                text: 'Order No.',
                value: 'order_no'
            },{
                text: 'Customer',
                value: 'customer_name'
            },{
                text: 'Order Status',
                value: 'order_status'
            },{
                text: 'Delivery Status',
                value: 'delivery_status'
            },
            ]
        };
    },
    methods: {
        openCreate() {
            eventBus.$emit("openCreateOrder");
        },
        openEdit(data) {
            eventBus.$emit("openEditOrder", data);
        },

        confirm_delete(item) {
            this.$confirm('This will permanently delete the file. Continue?', 'Warning', {
                confirmButtonText: 'OK',
                cancelButtonText: 'Cancel',
                type: 'warning'
            }).then(() => {
                this.deleteItem(item)
            }).catch(() => {
                this.$message({
                    type: 'error',
                    message: 'Delete canceled'
                });
            });
        },

        deleteItem(item) {
            this.$store.dispatch("deleteItem", "order/" + item.id).then(response => {
                this.$message({
                    type: 'success',
                    message: 'Delete completed'
                });
                this.getOrder();
            });
        },
        openShow(data) {
            eventBus.$emit("openShowOrder", data);
        },

        next_page(path, page) {
            var payload = {
                path: path,
                page: page,
                update: 'updateOrderList'
            }
            this.$store.dispatch("nextPage", payload);
        },

        getOrder() {
            var payload = {
                model: 'orders',
                update: 'updateOrderList'
            }
            this.$store.dispatch('getItems', payload)
        }
    },
    computed: {
        ...mapState(['orders'])
    },
    mounted() {
        // this.$store.dispatch('getOrder');
        eventBus.$emit("LoadingEvent");
    },
    created() {
        eventBus.$on("orderEvent", data => {
            this.getOrder();
        });

        eventBus.$on("responseChooseEvent", data => {
            console.log(data);
            if (data == "Excel") {
                eventBus.$emit("openEditOrder");
            } else {
                eventBus.$emit("openCreateOrder");
            }
        });
    },

    //   beforeRouteEnter(to, from, next) {
    //     next(vm => {
    //       if (vm.user.can["view order"]) {
    //         next();
    //       } else {
    //         next("/");
    //       }
    //     });
    //   }
};
</script>

<style scoped>
.el-input--prefix .el-input__inner {
    border-radius: 50px !important;
}

.v-toolbar__content,
.v-toolbar__extension {
    height: auto !important;
}

.v-avatar {
    height: 10px !important;
    width: 10px !important;
    margin-left: 40% !important;
}
</style>
