<template>
<v-layout row justify-center>
    <v-dialog v-model="dialog" persistent max-width="800px">
        <v-card>
            <v-card-title>
                <span class="headline text-center" style="margin: auto;">Create Animal</span>
            </v-card-title>
            <v-divider></v-divider>
            <v-card-text>
                <v-container grid-list-md>
                    <v-card-text>
                        <v-layout row wrap>
                            <v-flex sm5 offset-sm1>
                                <label for="">Animal</label>
                                <el-input placeholder="" v-model="form.name"></el-input>
                            </v-flex>
                            <v-flex sm5 offset-sm1>
                                <label for="">Age</label>
                                <el-input placeholder="" v-model="form.age"></el-input>
                            </v-flex>
                            <v-flex sm5 offset-sm1>
                                <label for="">Species</label>
                                <el-input placeholder="" v-model="form.species"></el-input>
                            </v-flex>
                            <v-flex sm5 offset-sm1>
                                <label for="">Weight</label>
                                <el-input placeholder="" v-model="form.weight"></el-input>
                            </v-flex>
                            <v-flex sm5 offset-sm1>
                                <label for="">Gender</label>
                                <el-input placeholder="" v-model="form.gender"></el-input>
                            </v-flex>
                            <v-flex sm5 offset-sm1>
                                <label for="">Reproductive st</label>
                                <el-input placeholder="" v-model="form.reproductive_st"></el-input>
                            </v-flex>
                            <v-flex sm5 offset-sm1>
                                <label for="">Stus</label>
                                <el-input placeholder="" v-model="form.animal"></el-input>
                            </v-flex>
                            <v-flex sm5 offset-sm1>
                                <label for="">Health Animal</label>
                                <el-input placeholder="" v-model="form.health_animal"></el-input>
                            </v-flex>
                            <v-flex sm5 offset-sm1>
                                <label for="">Sale Animal</label>
                                <el-input placeholder="" v-model="form.sale_animal"></el-input>
                            </v-flex>
                            <v-flex sm5 offset-sm1>
                                <label for="">Bleed id</label>
                                <el-select v-model="form.bleed_id" placeholder="Select" style="width: 100%">
                                    <el-option v-for="item in options" :key="item.value" :label="item.label" :value="item.value">
                                    </el-option>
                                </el-select>
                            </v-flex>
                            <v-flex sm5 offset-sm1>
                                <label for="">Farmer</label>
                                <el-select v-model="form.farmer_id" placeholder="Select" style="width: 100%">
                                    <el-option v-for="item in options" :key="item.value" :label="item.label" :value="item.value">
                                    </el-option>
                                </el-select>
                            </v-flex>
                            <v-flex sm5 offset-sm1>
                                <label for="">Mother</label>
                                <el-select v-model="form.mother_id" placeholder="Select" style="width: 100%">
                                    <el-option v-for="item in options" :key="item.value" :label="item.label" :value="item.value">
                                    </el-option>
                                </el-select>
                            </v-flex>
                            <v-flex sm5 offset-sm1>
                                <label for="">Father</label>
                                <el-select v-model="form.father_id" placeholder="Select" style="width: 100%">
                                    <el-option v-for="item in options" :key="item.value" :label="item.label" :value="item.value">
                                    </el-option>
                                </el-select>
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
        form: {},
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
        eventBus.$on("openCreateAnimal", data => {
            this.dialog = true;
        });
    },

    methods: {
        save() {
            var payload = {
            model: 'animals',
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
        ...mapState(['loading'])
    },
};
</script>
