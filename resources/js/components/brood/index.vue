<template>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title ">Brood List</h4>
                    <p class="card-category">Showing Various Poultry</p>
                    <button type="button" class="btn btn-small btn-warning" data-toggle="modal" data-target="#brood_r_modal" style="float: right;">Register New Brood</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class=" text-success">
                                <th>ID</th>
                                <th>Type</th>
                                <th>Breed</th>
                                <th>Age</th>
                                <th>Info</th>
                                <th>Status</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> 1</td>
                                    <td> <a href="#"  data-toggle="modal" data-target="#brood_r_modal"> <span style="color: black">Thomas</span><span style="color: rgb(19, 197, 108)">&nbsp;(Bull)</span></a></td>
                                    <td> <a href="breed_info"><span style="color: black">Charolais</span></a></td>
                                    <td> 12</td>
                                    <td class="text-primary"> <span style="color: rgb(19, 197, 108)">540Kg</span></td>
                                    <td> Healthy</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<Create />
<Edit />
</div>
<!-- Modal -->
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
        Edit
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
            brood_data: [{
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
            eventBus.$emit("openCreateBrood");
        },
        openEdit(data) {
            eventBus.$emit("openEditBrood", data);
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
            this.$store.dispatch("deleteItem", "brood/" + item.id).then(response => {
                this.$message({
                    type: 'success',
                    message: 'Delete completed'
                });
                this.getBrood();
            });
        },
        openShow(data) {
            eventBus.$emit("openShowBrood", data);
        },

        getBrood() {
            var payload = {
                model: 'broods',
                update: 'updateBroodsList'
            }
            this.$store.dispatch('getItems', payload)
        },
        next_page(path, page) {
            var payload = {
                path: path,
                page: page,
                update: 'updateBroodsList'
            }
            this.$store.dispatch("nextPage", payload);
        },
        save() {
            var payload = {
                model: 'brood',
                data: this.form
            }
            this.$store.dispatch('postItems', payload)
                .then(response => {
                    eventBus.$emit("BroodEvent")
                });
        },
        close() {
            this.dialog = false;
        }
    },
    computed: {
        ...mapState(['broods', 'errors'])
    },
    mounted() {
        // this.$store.dispatch('getBrood');
        eventBus.$emit("LoadingEvent");
    },
    created() {
        eventBus.$on("broodEvent", data => {
            this.getBrood();
        });

        eventBus.$on("responseChooseEvent", data => {
            console.log(data);
            if (data == "Excel") {
                eventBus.$emit("openEditBrood");
            } else {
                eventBus.$emit("openCreateBrood");
            }
        });
    },

    //   beforeRouteEnter(to, from, next) {
    //     next(vm => {
    //       if (vm.user.can["view brood"]) {
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
