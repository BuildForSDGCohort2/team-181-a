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
                    <th>
                        ID
                    </th>
                    <th>
                        Name
                    </th>
                    <th>
                        Breed
                    </th>
                    <th>
                        Age
                    </th>
                    <th>
                        Info
                    </th>
                    <th>
                        Status
                    </th>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            1
                        </td>
                        <td>
                            <a href="#"> <span style="color: black" @click="openEdit">Thomas</span><span style="color: rgb(19, 197, 108)">&nbsp;(Bull)</span></a>
                        </td>
                        <td>
                            <a href="breed_info"><span style="color: black">Charolais</span></a>
                        </td>
                        <td>
                            12
                        </td>
                        <td class="text-primary">
                            <span style="color: rgb(19, 197, 108)">540Kg</span>
                        </td>
                        <td>
                            Healthy
                        </td>
                    </tr>
                    <tr>
                        <td>
                            2
                        </td>
                        <td>
                            <a href="#"> <span style="color: black">Jane</span><span style="color: rgb(19, 197, 108)">&nbsp;(Cow)</span></a>
                        </td>
                        <td>
                            <a href="#"> <span style="color: black">Fresian</span></a>
                        </td>
                        <td>
                            12
                        </td>
                        <td class="text-primary">
                            <span style="color: rgb(19, 197, 108)">20lts/day</span>
                        </td>
                        <td>
                            Sick <span style="color: red">&nbsp;(Yellow Fever)</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            3
                        </td>
                        <td>
                            <a href="#"> <span style="color: black">Ndun'gu</span><span style="color: rgb(19, 197, 108)">&nbsp;(Billy Goat)</span></a>
                        </td>
                        <td>
                            <a href="#"> <span style="color: black">Saaneen</span></a>
                        </td>
                        <td>
                            8
                        </td>
                        <td class="text-primary">
                            <span style="color: rgb(19, 197, 108)">&nbsp;80Kg</span>
                        </td>
                        <td>
                            Healthy <span style="color: rgb(39, 144, 21)">&nbsp;(Prime)</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            4
                        </td>
                        <td>
                            <a href="#"> <span style="color: black">Lucka</span><span style="color: rgb(19, 197, 108)">&nbsp;(Ram)</span></a>
                        </td>
                        <td>
                            <a href="#"> <span style="color: black">Merino</span></a>
                        </td>
                        <td>
                            8
                        </td>
                        <td class="text-primary">
                            <span style="color: rgb(19, 197, 108)">&nbsp;50Kg</span>
                        </td>
                        <td>
                            Healthy <span style="color: rgb(39, 144, 21)">&nbsp;(Prime)</span>
                        </td>
                    </tr>
                    <td>
                        5
                    </td>
                    <td>
                        <a href=#> <span style="color: black">Avril</span><span style="color: rgb(19, 197, 108)">&nbsp;(F-Rabit)</span></a>
                    </td>
                    <td>
                        <a href="#"> <span style="color: black">Belgian Hare</span></a>
                    </td>
                    <td>
                        3
                    </td>
                    <td class="text-primary">
                        <span style="color: rgb(19, 197, 108)">&nbsp;30kg</span>
                    </td>
                    <td>
                        Healthy
                    </td>
                    </tr>
                    <tr>
                        <td>
                            6
                        </td>
                        <td>
                            <a href="#"> <span style="color: black">Mary</span><span style="color: rgb(19, 197, 108)">&nbsp;(F-Pig)</span></a>
                        </td>
                        <td>
                            <a href="#"> <span style="color: black">Large White</span></a>
                        </td>
                        <td>
                            5
                        </td>
                        <td class="text-primary">
                            <span style="color: rgb(19, 197, 108)">&nbsp;340Kg</span>
                        </td>
                        <td>
                            Healthy <span style="color: rgb(39, 144, 21)">&nbsp;(PG)</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <Edit />
</div>
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
        save() {
            var payload = {
                model: 'animal',
                data: this.form
            }
            this.$store.dispatch('postItems', payload)
                .then(response => {
                    eventBus.$emit("AnimalEvent")
                });
        },
        close() {
            this.dialog = false;
        }
    },
    computed: {
        ...mapState(['animals', 'errors'])
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
