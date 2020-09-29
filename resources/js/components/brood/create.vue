<template>
<div id="brood_r_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Register Brood</h4>
            </div>
            <div class="modal-body">
                <div class="first-column" style='width:45%; float: left;'>

                    <fieldset>

                        <label>Species:</label><br>
                        <input type="radio" v-model="form.species" id="turkey" value="turkey" />
                        <label for="turkey">Turkey</label>

                        <input type="radio" v-model="form.species" id="chicken" value="chicken" />
                        <label for="chicken">Chicken</label>

                        <input type="radio" v-model="form.species" id="duck" value="duck" />
                        <label for="duck">Duck</label>

                        <small class="has-text-danger" v-if="errors.species">{{ errors.species[0] }}</small>
                        <div class="form-group">
                            <label for="others">Others</label>
                            <input type="text" v-model='form.others' class="form-control" id="others" aria-describedby="others" placeholder="Please indicate">
                            <small id="others" class="form-text text-muted">Please indicate</small>
                            <small class="has-text-danger" v-if="errors.others">{{ errors.others[0] }}</small>
                        </div>
                    </fieldset>
                    <fieldset required>
                        <label>Gender:</label><br>
                        <input type="radio" v-model="form.gender" id="male" value="male" />
                        <label for="male">Male</label>

                        <input type="radio" v-model="form.gender" id="female" value="female" />
                        <label for="female">Female</label>

                    </fieldset>
                    <small class="has-text-danger" v-if="errors.gender">{{ errors.gender[0] }}</small>

                    <div class="form-group">
                        <label for="breed">Breed</label>
                        <input type="text" v-model='form.breed' class="form-control" id="breed" aria-describedby="breedname" placeholder="Select Breed">
                        <small id="momsname" class="form-text text-muted">Select the Breed</small>
                        <small class="has-text-danger" v-if="errors.breed">{{ errors.breed[0] }}</small>
                    </div>

                </div>
                <div class="second-column" style='width:45%; float: right;'>

                    <div class="form-group">
                        <label for="name">Hatched on...</label>
                        <input type="date" class="form-control" v-model='form.hatch_date' id="age" aria-describedby="hatch_date" required>
                        <small id="hatch_date" class="form-text text-muted">Enter the Hatching date....</small>
                        <small class="has-text-danger" v-if="errors.hatch_date">{{ errors.hatch_date[0] }}</small>
                    </div>

                    <div class="form-group">
                        <label for="number">Number of Birds</label>
                        <input type="text" class="form-control" v-model='form.number' id="number" aria-describedby="broods_number" placeholder="Enter Number of Birds" required>
                        <small id="broods_number " class="form-text text-muted">Enter the broods number</small>
                        <small class="has-text-danger" v-if="errors.number">{{ errors.number[0] }}</small>
                    </div>

                    <div class="form-group">
                        <label for="sellers_name">Sellers Name</label>
                        <input type="text" class="form-control" v-model='form.sellers_name' id="sellers_name" aria-describedby="suppliers_name" placeholder="Enter Name" required>
                        <small id="suppliers_name" class="form-text text-muted">Enter The Suppliers Name or id</small>
                        <small class="has-text-danger" v-if="errors.sellers_name">{{ errors.sellers_name[0] }}</small>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button @click="save" class="btn btn-info" value="Submit">Submit</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import {
    mapState
} from "vuex";
export default {
    data: () => ({
        dialog: true,
        form: {
            gender: 'male',
            species: 'Cow'
        },
        options: [{
            value: 'Option1',
            label: 'Option1'
        }, {
            value: 'Option2',
            label: 'Option2'
        }, {
            value: 'Option3',
            label: 'Option3'
        }, {
            value: 'Option4',
            label: 'Option4'
        }, {
            value: 'Option5',
            label: 'Option5'
        }],
    }),
    created() {
        eventBus.$on("openCreateBrood", data => {
            this.dialog = true;
        });
    },

    methods: {
        save() {
            var payload = {
                model: 'brood',
                data: this.form
            }
            this.$store.dispatch('postItems', payload)
                .then(response => {
                    eventBus.$emit("broodEvent")
                });
        },
        close() {
            this.dialog = false;
        }
    },

    computed: {
        ...mapState(['loading', 'errors'])
    },
};
</script>
