<template>
<div class="card">
    <div class="card-header card-header-primary">
        <h4 class="card-title ">Plantations On Farm..</h4>
        <p class="card-category"> Showing six (6) Plantations</p>
        <button type="button" class="btn btn-small btn-warning" data-toggle="modal" data-target="#plant_modal" style="float: right;">Add plantation</button>

    </div>
    <div id="plant_modal" class="modal fade" role="dialog">
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
                        Species
                    </th>
                    <th>
                        Area Covered
                    </th>
                    <th>
                        Remaining Time To Expected harvest
                    </th>
                    <th>
                        Expected Produce
                    </th>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            1
                        </td>
                        <td>
                            Maize <a href="#"><span style="color: rgb(19, 197, 108)">(Katumani)</span></a>
                        </td>
                        <td>
                            10 Acres
                        </td>
                        <td>
                            1 Month 3 Days
                        </td>
                        <td class="text-success">
                            100 Sacks
                        </td>
                    </tr>
                    <tr>
                        <td>
                            2
                        </td>
                        <td>
                            Wheat <a href="#"><span style="color: rgb(19, 197, 108)">(EinKorn)</span></a>
                        </td>
                        <td>
                            10 Acres
                        </td>
                        <td>
                            1 Month 3 Days
                        </td>
                        <td class="text-success">
                            100 Sacks
                        </td>
                    </tr>
                    <tr>
                        <td>
                            3
                        </td>
                        <td>
                            Beans <a href="#"><span style="color: rgb(19, 197, 108)">(Rose Coco)</span></a>
                        </td>
                        <td>
                            14 Acres
                        </td>
                        <td>
                            <span style="color: red"> Past Due!</span>
                        </td>
                        <td class="text-success">
                            15 Sacks
                        </td>
                    </tr>
                    <tr>
                        <td>
                            4
                        </td>
                        <td>
                            Tea <a href="#"><span style="color: rgb(19, 197, 108)">(Purple Tea)</span></a>
                        </td>
                        <td>
                            14 Acres
                        </td>
                        <td>
                            0 Months 3 Days
                        </td>
                        <td class="text-success">
                            15 Tonnes
                        </td>
                    </tr>
                    <tr>
                        <td>
                            3
                        </td>
                        <td>
                            Beans <a href="#"><span style="color: rgb(19, 197, 108)">(Rose Coco)</span></a>
                        </td>
                        <td>
                            14 Acres
                        </td>
                        <td>
                            <span style="color: rgb(19, 197, 108)">Ready!</span>
                        </td>
                        <td class="text-success">
                            15 Sacks
                        </td>
                    </tr>
                    <tr>
                        <td>
                            6
                        </td>
                        <td>
                            Grapes <a href="#"><span style="color: rgb(19, 197, 108)">(Green Grapes)</span></a>
                        </td>
                        <td>
                            14 Acres
                        </td>
                        <td>
                            0 Months 3 Days
                        </td>
                        <td class="text-success">
                            15 Sacks
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
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

<style>
.has-text-danger {
    color: #f00 !important;
}
</style>
