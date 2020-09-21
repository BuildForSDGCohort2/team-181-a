<template>
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Register Animal</h4>
                </div>
                <div class="modal-body">
                        <div class="first-column" style='width:45%; float: left;'>
                            <div class="form-group">
                                <label for="name">Name Of Animal</label>
                                <input type="text" class="form-control" v-model='form.name' id="name" aria-describedby="name" placeholder="Enter Name">
                                <small id="name" class="form-text text-muted">Enter Disired name of animal.</small>
                                <small class="has-text-danger" v-if="errors.name">{{ errors.name[0] }}</small>

                            </div>

                            <fieldset>
                                <label>Gender:</label><br>
                                <input type="radio" v-model="form.gender" id="male" value="male" />
                                <label for="male">Male</label>

                                <input type="radio" v-model="form.gender" id="female" value="female" />
                                <label for="female">Female</label>

                            </fieldset>

                            <fieldset>
                                <label>Species:</label><br>
                                <input type="radio" v-model="form.species" id="cow" value="cow" />
                                <label for="cow">Cow</label>

                                <input type="radio" v-model="form.species" id="goat" value="goat" />
                                <label for="goat">Goat</label>

                                <input type="radio" v-model="form.species" id="sheep" value="sheep" />
                                <label for="sheep">Sheep</label>
                            </fieldset>

                            <div class="form-group">
                                <label for="breed">Breed</label>
                                <select class="form-control form-control-sm" v-model="form.breed_id" required>
                                    <option value="1">Charolais</option>
                                    <option value="2">Merino</option>

                                </select>
                                <small id="momsname" class="form-text text-muted">Select the Breed</small>
                                <small class="has-text-danger" v-if="errors.breed_id">{{ errors.breed_id[0] }}</small>
                            </div>

                            <div class="form-group">
                                <label for="mothers_name">Mothers Name/id</label>
                                <input type="text" class="form-control" v-model='form.mothers_name' id="mothers_name" aria-describedby="momsname" placeholder="Enter Name">
                                <small id="momsname" class="form-text text-muted">Enter The Mothers Name or id</small>
                                <small class="has-text-danger" v-if="errors.momsname">{{ errors.momsname[0] }}</small>
                            </div>

                        </div>
                        <div class="second-column" style='width:45%; float: right;'>

                            <div class="form-group">
                                <label for="name">Birth-day</label>
                                <input type="date" class="form-control" v-model='form.birthday' id="birthday" aria-describedby="birthday">
                                <small id="age" class="form-text text-muted">Enter date of birth.</small>
                                <small class="has-text-danger" v-if="errors.birthday">{{ errors.birthday[0] }}</small>
                            </div>

                            <div class="form-group">
                                <label for="weight">If Not Sure?... </label>
                                <input type="text" class="form-control" v-model='form.approx_age' id="approx_age" aria-describedby="approx_age" placeholder="Approximate Age">
                                <small id="approx_age " class="form-text text-muted">Enter Approximate Age</small>
                                <small class="has-text-danger" v-if="errors.approx_age">{{ errors.approx_age[0] }}</small>
                            </div>
                            <label>Approximatin in:</label><br>
                            <input type="radio" v-model="form.approximation" id="months" value="months" />
                            <label for="months">Months</label>

                            <input type="radio" v-model="form.approximation" id="years" value="years" />
                            <label for="years">Years</label>

                            <div class="form-group">
                                <label for="weight">Weight</label>
                                <input type="text" class="form-control" v-model='form.weight' id="weight" aria-describedby="animals_weight" placeholder="Enter Weight" required>
                                <small id="animals_weight " class="form-text text-muted">Enter the animals Weight</small>
                                <small class="has-text-danger" v-if="errors.weight">{{ errors.weight[0] }}</small>
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="health_status" v-model="form.health_status">
                                    <label class="custom-control-label" for="health_status"> Is the animal <span class="text-danger">Healthy</span>?</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="pregnancy_status" v-model="form.pregnancy_status">
                                    <label class="custom-control-label" for="pregnancy_status"> Is the animal <span class="text-success">Pregnant</span>?</label>
                                </div>
                            </div>

                        </div>
                </div>
                <div class="modal-footer">
                    <button @click="save" class="btn btn-info" value="Submit">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
        eventBus.$on("openCreateAnimal", data => {
            this.dialog = true;
        });
    },

    methods: {
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
        ...mapState(['loading', 'errors'])
    },
};
</script>
