<template>
<v-layout row justify-center>
    <v-dialog v-model="dialog" persistent max-width="600px">
        <v-card>
            <v-card-title>
                <span class="headline text-center" style="margin: auto;">Register Plantation</span>
            </v-card-title>
            <v-divider></v-divider>
            <v-card-text>
                <v-container grid-list-md>
                    <v-card-text>
                        <v-layout row wrap>
                            <v-flex sm6>
                                <label for="">Type of plant</label>
                                <el-input placeholder="" v-model="form.species"></el-input>
                            </v-flex>
                            <v-flex sm6>
                                <label for="">Size of allocation</label>
                                <el-input placeholder="" v-model="form.size"></el-input>
                            </v-flex>

                            <v-flex sm6>
                                <label for="">Number / Strain</label><br>
                                <el-input placeholder="" v-model="form.strain"></el-input>
                            </v-flex>
                            <v-flex sm6>
                                <label for="">Date Of Planting</label>
                                <el-date-picker v-model="form.planting_date" type="date" placeholder="Pick a day"></el-date-picker>
                            </v-flex>
                        </v-layout>
                    </v-card-text>
                </v-container>
            </v-card-text>
            <v-card-actions>
                <v-btn color="blue darken-1" text @click="close">Close</v-btn>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="save" :loading="loading" :disabled="loading">Save</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</v-layout>
</template>

<script>
import {
    mapState
} from "vuex";
export default {
    data: () => ({
        dialog: false,
        form: {
            gender: 'male',
            species: 'Cow'
        },
        errors: {},
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
        eventBus.$on("openCreatePlantation", data => {
            this.dialog = true;
        });
    },

    methods: {
        save() {
            var payload = {
                model: 'plantations',
                data: this.form
            }
            this.$store.dispatch('postItems', payload)
                .then(response => {
                    eventBus.$emit("PlantationEvent")
                });
        },
        close() {
            this.dialog = false;
        }
    },

    computed: {
        ...mapState(['loading'])
    },
};
</script>
