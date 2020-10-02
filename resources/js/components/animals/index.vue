<template>
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title ">Animals List</h4>
        <p class="card-category"> Here is a subtitle for this table</p>
        <button type="button" class="btn btn-small btn-warning" data-toggle="modal" data-target="#animal_r_modal" style="float: right;">Register Animal</button>
    </div>
    <div id="animal_r_modal" class="modal fade" role="dialog">
        <Create />
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table">
                <thead class=" text-success">
                    <th>ID</th>
                    <th>Name</th>
                    <th>Breed</th>
                    <th>Age</th>
                    <th>Info</th>
                    <th>Status</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    <!-- <tr>
                        <td>1 </td>
                        <td><a href="#"> <span style="color: black" @click="openEdit">Thomas</span><span style="color: rgb(19, 197, 108)">&nbsp;(Bull)</span></a> </td>
                        <td><a href="breed_info"><span style="color: black">Charolais</span></a> </td>
                        <td>12 </td>
                        <td class="text-primary"><span style="color: rgb(19, 197, 108)">540Kg</span> </td>
                        <td>Healthy </td>
                    </tr> -->

                    <tr v-for="(animal, index) in animals" :key="animal.id">
                        <td> {{ index+1 }}</td>
                        <td><a href="#"> <span style="color: black" @click="openEdit">{{ animal.name }}</span><span style="color: rgb(19, 197, 108)">&nbsp;({{ animal.species }})</span></a> </td>
                        <td><a href="breed_info"><span style="color: black"></span></a> </td>
                        <td>{{ animal.age }} </td>
                        <td class="text-primary"><span style="color: rgb(19, 197, 108)">{{ animal.weight }}</span> </td>
                        <td> {{ (animal.health_status) ? 'Health'  : 'Unhealthy' }} </td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Action
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#sell_animal"  @click="openSell(animal)">Sell</a>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#death" @click="openSell(animal)">Dead </a>
                                    <!-- @if ($animal->reproductive_status==1) -->
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#summon_vet">Summon Vet For Ai Procedure</a>
                                    <!-- @elseif($animal->reproductive_status==2) -->
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#summon_vet">Summon Vet For Checkup</a>
                                    <!-- @endif -->
                                </div>
                            </div>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- <Edit /> -->

    <div class="text-center ma-2">
        <v-snackbar v-model="snackbar" right>
            {{ text }}
            <template v-slot:action="{ attrs }">
                <v-btn color="pink" text v-bind="attrs" @click="snackbar = false">
                    Close
                </v-btn>
            </template>
        </v-snackbar>
    </div>
    <Sell />
    <Dead />
</div>
</template>

<script>
import Create from "./create";
import Edit from "./edit";
import Dead from "./dead";
import Sell from "./sell";
import {
    mapState
} from 'vuex';

export default {
    props: ['user', 'animals'],
    components: {
        Create,
        Edit,Sell, Dead
    },
    data() {
        return {
            snackbar: false,
            text: 'Animal Created',
            search: "",
            form: {},
            headers: [{
                text: 'Id',
                align: 'start',
                value: 'id'
            }, {
                text: 'Name',
                value: 'name'
            }, {
                text: 'Age',
                value: 'age'
            }, {
                text: 'Info',
                value: 'weight'
            }, {
                text: 'Status',
                value: 'health_status'
            }, ],
            animal_data: [{
                'id': 1,
                'name': 'Tom',
                'mother_name': 'Mary',
                'age': 3,
                'weight': 300,
                'health_status': 'Health',
                gender: 'male',
                species: 'Cow'
            }, {
                'id': 2,
                'name': 'Jane',
                'mother_name': 'Mary',
                'age': 5,
                'weight': 230,
                'health_status': 'Health',
                gender: 'Female',
                species: 'Cow'
            }, {
                'id': 3,
                'name': 'Mary',
                'mother_name': 'P',
                'age': 2,
                'weight': 130,
                'health_status': 'Unhealthy',
                gender: 'male',
                species: 'Goat'
            }, {
                'id': 4,
                'name': 'Tom',
                'mother_name': 'Paul',
                'age': 5,
                'weight': 300,
                'health_status': 'Health',
                gender: 'male',
                species: 'Cow'
            }, {
                'id': 5,
                'name': 'Tom',
                'mother_name': 'Mary',
                'age': 3,
                'weight': 300,
                'health_status': 'Unhealthy',
                gender: 'male',
                species: 'Sheep'
            }]
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
                model: 'animal',
                update: 'updateAnimalsList'
            }
            this.$store.dispatch('getItems', payload)
        },
        openSell(animal) {
            eventBus.$emit("openSellEvent", animal);
        },
        next_page(path, page) {
            var payload = {
                path: path,
                page: page,
                update: 'updateAnimalsList'
            }
            this.$store.dispatch("nextPage", payload);
        },
        close() {
            this.dialog = false;
        }
    },
    computed: {
        ...mapState(['errors'])
    },
    mounted() {
        // this.getAnimal()
        // this.$store.dispatch('getAnimal');
        eventBus.$emit("LoadingEvent");
    },
    created() {
        eventBus.$on("animalEvent", data => {
            this.getAnimal();
            this.snackbar = true
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

<style>
/* .el-input--prefix .el-input__inner {
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
} */

.has-text-danger {
    color: #f00 !important;
}
</style>
