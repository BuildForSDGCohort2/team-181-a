<template>
<v-main>
    <v-container fluid fill-height>
        <v-layout justify-center align-center wrap>
            <v-flex sm12>
                <v-card style="padding: 20px 0;">
                    <el-breadcrumb separator-class="el-icon-arrow-right">
                        <el-breadcrumb-item :to="{ path: '/' }">Dashboard</el-breadcrumb-item>
                        <el-breadcrumb-item>Plantations</el-breadcrumb-item>
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
                                    <v-btn icon v-on="on" slot="activator" class="mx-0" @click="getPlantation">
                                        <v-icon color="blue darken-2" small>mdi-refresh</v-icon>
                                    </v-btn>
                                </template>
                                <span>Refresh</span>
                            </v-tooltip>
                        </v-flex>
                        <v-flex sm2>
                            <h3 style="margin-left: 30px !important;margin-top: 10px;">Plantations</h3>
                        </v-flex>
                        <v-flex offset-sm8 sm2>
                            <v-btn color="info" @click="openCreate" text>Register Plantation</v-btn>
                        </v-flex>
                    </v-layout>
                </v-card>
            </v-flex>
            <v-flex sm12>
                <!-- <v-pagination v-model="plantation.current_page" :length="plantation.last_page" total-visible="5" @input="next_page(plantation.path, plantation.current_page)" circle v-if="plantation.last_page > 1"></v-pagination> -->
            </v-flex>
            <v-flex sm12>
                <v-card>
                    <v-card-title>
                        Plantations
                        <v-spacer></v-spacer>
                        <v-text-field v-model="search" append-icon="mdi-magnify" label="Search" single-line hide-details></v-text-field>
                    </v-card-title>
                    <v-data-table :headers="headers" :items="plantation_data" :search="search">
                        <template v-slot:item.species="{ item }">
                            <v-btn @click="openEdit(item)" text color="primary">{{ item.species }}</v-btn>
                        </template>
                    </v-data-table>
                </v-card>
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
import {
    mapState
} from 'vuex';

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
                text: 'Id',
                align: 'start',
                value: 'id'
            }, {
                text: '	Species',
                value: 'species'
            }, {
                text: 'Area Covered',
                value: 'size'
            }, {
                text: 'Planting date',
                value: 'planting_date'
            }, {
                text: 'Expected Produce',
                value: 'health_status'
            }, ],
            plantation_data: [{
                'id': 1,
                'species': 'Maize (Katumani)',
                'size': '4 Acres',
                'planting_date': new Date(),
                'strain': 3,
                health_status: 'Healthy'

            }, {
                'id': 2,
                'species': 'Beans (Rose Coco)',
                'size': '3 Acres',
                'planting_date': new Date(),
                'strain': 3,
                health_status: 'Healthy'

            }, {
                'id': 3,
                'species': 'Tea (Purple Tea)',
                'size': '10 Acres',
                'planting_date': new Date(),
                'strain': 3,
                health_status: 'Healthy'

            }]
        };
    },
    methods: {
        openCreate() {
            eventBus.$emit("openCreatePlantation");
        },
        openEdit(data) {
            eventBus.$emit("openEditPlantation", data);
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
            this.$store.dispatch("deleteItem", "plantation/" + item.id).then(response => {
                this.$message({
                    type: 'success',
                    message: 'Delete completed'
                });
                this.getPlantation();
            });
        },
        openShow(data) {
            eventBus.$emit("openShowPlantation", data);
        },

        getPlantation() {
            var payload = {
                model: 'plantations',
                update: 'updatePlantationsList'
            }
            this.$store.dispatch('getItems', payload)
        },
        next_page(path, page) {
            var payload = {
                path: path,
                page: page,
                update: 'updatePlantationsList'
            }
            this.$store.dispatch("nextPage", payload);
        },
    },
    computed: {
        ...mapState(['plantations'])
    },
    mounted() {
        // this.$store.dispatch('getPlantation');
        eventBus.$emit("LoadingEvent");
    },
    created() {
        eventBus.$on("plantationEvent", data => {
            this.getPlantation();
        });

        eventBus.$on("responseChooseEvent", data => {
            console.log(data);
            if (data == "Excel") {
                eventBus.$emit("openEditPlantation");
            } else {
                eventBus.$emit("openCreatePlantation");
            }
        });
    },

    //   beforeRouteEnter(to, from, next) {
    //     next(vm => {
    //       if (vm.user.can["view plantation"]) {
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
