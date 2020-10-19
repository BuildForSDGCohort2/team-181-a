<template>
<v-main>
    <v-container fluid fill-height>
        <v-layout justify-center align-center wrap>
            <v-flex sm12>
                <v-card style="padding: 20px 0;">
                    <el-breadcrumb separator-class="el-icon-arrow-right">
                        <el-breadcrumb-item :to="{ path: '/' }">Dashboard</el-breadcrumb-item>
                        <el-breadcrumb-item>Animalfacts</el-breadcrumb-item>
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
                                    <v-btn icon v-on="on" slot="activator" class="mx-0" @click="getAnimalfact">
                                        <v-icon color="blue darken-2" small>mdi-refresh</v-icon>
                                    </v-btn>
                                </template>
                                <span>Refresh</span>
                            </v-tooltip>
                        </v-flex>
                        <v-flex sm2>
                            <h3 style="margin-left: 30px !important;margin-top: 10px;">Animalfacts</h3>
                        </v-flex>
                        <v-flex offset-sm8 sm2>
                            <v-btn color="info" @click="openCreate" text>Create Animalfact</v-btn>
                        </v-flex>
                    </v-layout>
                </v-card>
            </v-flex>
            <v-flex sm12>
                <!-- <v-pagination v-model="animalfact.current_page" :length="animalfact.last_page" total-visible="5" @input="next_page(animalfact.path, animalfact.current_page)" circle v-if="animalfact.last_page > 1"></v-pagination> -->
            </v-flex>
            <v-flex sm12>
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
        };
    },
    methods: {
        openCreate() {
            eventBus.$emit("openCreateAnimalfact");
        },
        openEdit(data) {
            eventBus.$emit("openEditAnimalfact", data);
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
            this.$store.dispatch("deleteItem", "animalfact/" + item.id).then(response => {
                this.$message({
                    type: 'success',
                    message: 'Delete completed'
                });
                this.getAnimalfact();
            });
        },
        openShow(data) {
            eventBus.$emit("openShowAnimalfact", data);
        },

        getAnimalfact() {
            var payload = {
                model: 'animal_facts',
                update: 'updateAnimal_facts'
            }
            this.$store.dispatch('getItems', payload)
        },

        next_page(path, page) {
            var payload = {
                path: path,
                page: page,
                update: 'updateAnimal_facts'
            }
            this.$store.dispatch("nextPage", payload);
        },
    },
    computed: {
        ...mapState(['animal_facts'])
    },
    mounted() {
        // this.$store.dispatch('getAnimalfact');
        eventBus.$emit("LoadingEvent");
    },
    created() {
        eventBus.$on("animalfactEvent", data => {
            this.getAnimalfact();
        });

        eventBus.$on("responseChooseEvent", data => {
            console.log(data);
            if (data == "Excel") {
                eventBus.$emit("openEditAnimalfact");
            } else {
                eventBus.$emit("openCreateAnimalfact");
            }
        });
    },

    //   beforeRouteEnter(to, from, next) {
    //     next(vm => {
    //       if (vm.user.can["view animalfact"]) {
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
    banimalfact-radius: 50px !important;
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
