<template>
<v-main>
    <v-container fluid fill-height>
        <v-layout justify-center align-center wrap>
            <v-flex sm12>
                <v-card style="padding: 20px 0;">
                    <el-breadcrumb separator-class="el-icon-arrow-right">
                        <el-breadcrumb-item :to="{ path: '/' }">Dashboard</el-breadcrumb-item>
                        <el-breadcrumb-item>Animals</el-breadcrumb-item>
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
                                    <v-btn icon v-on="on" slot="activator" class="mx-0" @click="getAnimal">
                                        <v-icon color="blue darken-2" small>mdi-refresh</v-icon>                                    </v-btn>
                                </template>
                                <span>Refresh</span>
                            </v-tooltip>
                        </v-flex>
                        <v-flex sm2>
                            <h3 style="margin-left: 30px !important;margin-top: 10px;">Animals</h3>
                        </v-flex>
                        <v-flex offset-sm8 sm2>
                            <v-btn color="info" @click="openCreate" text>Create Animal</v-btn>
                        </v-flex>
                    </v-layout>
                </v-card>
            </v-flex>
            <v-flex sm12>
                <!-- <v-pagination v-model="animal.current_page" :length="animal.last_page" total-visible="5" @input="next_page(animal.path, animal.current_page)" circle v-if="animal.last_page > 1"></v-pagination> -->
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
            eventBus.$emit("openCreateAnimal");
        },
        openEdit(data) {
            eventBus.$emit("openEditAnimal", data);
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
            this.$store.dispatch("deleteItem", "animal/" + item.id).then(response => {
                this.$message({
                    type: 'success',
                    message: 'Delete completed'
                });
                this.getAnimal();
            });
        },
        openShow(data) {
            eventBus.$emit("openShowAnimal", data);
        },


        getAnimal() {
            var payload = {
                model: 'animals',
                update: 'updateAnimalsList'
            }
            this.$store.dispatch('getItems', payload)
        },
        next_page(path, page) {
            var payload = {
                path: path,
                page: page,
                update: 'updateAnimalsList'
            }
            this.$store.dispatch("nextPage", payload);
        },
    },
    computed: {
        ...mapState(['animals'])
    },
    mounted() {
        // this.$store.dispatch('getAnimal');
        eventBus.$emit("LoadingEvent");
    },
    created() {
        eventBus.$on("animalEvent", data => {
            this.getAnimal();
        });

        eventBus.$on("responseChooseEvent", data => {
            console.log(data);
            if (data == "Excel") {
                eventBus.$emit("openEditAnimal");
            } else {
                eventBus.$emit("openCreateAnimal");
            }
        });
    },

    //   beforeRouteEnter(to, from, next) {
    //     next(vm => {
    //       if (vm.user.can["view animal"]) {
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
