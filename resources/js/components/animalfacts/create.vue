<template>
<v-layout row justify-center>
    <v-dialog v-model="dialog" persistent max-width="800px">
        <v-card>
            <v-card-title>
                <span class="headline text-center" style="margin: auto;">Create Animalfact</span>
            </v-card-title>
            <v-divider></v-divider>
            <v-card-text>
                <v-container grid-list-md>
                    <v-card-text>
                        <v-layout row wrap>
                            <v-flex sm5 offset-sm1>
                                <label for="">Breed</label>
                                <el-input placeholder="" v-model="form.breed"></el-input>
                            </v-flex>
                            <v-flex sm5 offset-sm1>
                                <label for="">Gestation Period</label>
                                <el-input placeholder="" v-model="form.gestation_per"></el-input>
                            </v-flex>
                            <v-flex sm5 offset-sm1>
                                <label for="">Max weight</label>
                                <el-input-number style="width: 100%" v-model="form.max_weight"></el-input-number>
                            </v-flex>

                            <v-flex sm5 offset-sm1>
                                <label for="">Prime Age</label>
                                <el-input-number style="width: 100%" v-model="form.prime_age"></el-input-number>
                            </v-flex>
                            <v-flex sm5 offset-sm1>
                                <label for="">Production Rate</label>
                                <el-input-number style="width: 100%" v-model="form.production_rate"></el-input-number>
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
import { mapState } from "vuex";
export default {
    data: () => ({
        dialog: false,
        form: {
            max_weight: 0,
            prime_age: 0,
            production_rate: 0,
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
        eventBus.$on("openCreateAnimalfact", data => {
            this.dialog = true;
        });
    },

    methods: {
        save() {
            var payload = {
            model: 'animalfacts',
                data: this.form
            }
            this.$store.dispatch('postItems', payload)
                .then(response => {
                    eventBus.$emit("AnimalfactEvent")
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
