<template>
<v-layout row justify-center>
    <v-dialog v-model="dialog" persistent max-width="800px">
        <v-card>
            <v-card-title>
                <span class="headline text-center" style="margin: auto;">Register Animal</span>
            </v-card-title>
            <v-divider></v-divider>
            <v-card-text>
                <v-container grid-list-md>
                    <v-card-text>
                        <v-layout row wrap>
                            <v-flex sm6>
                                <label for="">Animal</label>
                                <el-input placeholder="" v-model="form.name"></el-input>
                            </v-flex>
                            <v-flex sm6>
                                <label for="">Mother</label>
                                <el-input placeholder="" v-model="form.mothers_name"></el-input>
                            </v-flex>

                            <v-flex sm6>
                                <label for="">Gender</label><br>
                                <el-radio v-model="form.gender" label="male">Male</el-radio>
                                <el-radio v-model="form.gender" label="female">Female</el-radio>
                            </v-flex>
                            <v-flex sm6>
                                <label for="">Weight</label>
                                <el-input placeholder="" v-model="form.weight"></el-input>
                            </v-flex>
                            <v-flex sm6>
                                <label for="">Species</label><br>
                                <el-radio v-model="form.species" label="Cow">Cow</el-radio>
                                <el-radio v-model="form.species" label="Goat">Goat</el-radio>
                                <el-radio v-model="form.species" label="Sheep">Sheep</el-radio>
                            </v-flex>

                            <v-flex sm6>
                                <label for="">Age</label>
                                <el-input placeholder="" v-model="form.age"></el-input>
                            </v-flex>
                            <v-flex sm6>
                                <label for="">Reproductive st</label>
                                <el-input placeholder="" v-model="form.reproductive_st"></el-input>
                            </v-flex>
                            <v-flex sm6>
                                <label for="">Stus</label>
                                <el-input placeholder="" v-model="form.animal"></el-input>
                            </v-flex>
                            <v-flex sm6>
                                <label for="">Health Animal</label>
                                <el-input placeholder="" v-model="form.health_animal"></el-input>
                            </v-flex>
                            <v-flex sm6>
                                <label for="">Sale Animal</label>
                                <el-input placeholder="" v-model="form.sale_animal"></el-input>
                            </v-flex>
                            <v-flex sm6>
                                <label for="">Bleed id</label>
                                <el-select v-model="form.bleed_id" placeholder="Select" style="width: 100%">
                                    <el-option v-for="item in options" :key="item.value" :label="item.label" :value="item.value">
                                    </el-option>
                                </el-select>
                            </v-flex>
                            <v-flex sm6>
                                <label for="">Farmer</label>
                                <el-select v-model="form.farmer_id" placeholder="Select" style="width: 100%">
                                    <el-option v-for="item in options" :key="item.value" :label="item.label" :value="item.value">
                                    </el-option>
                                </el-select>
                            </v-flex>
                            <v-flex sm6>
                                <label for="">Mother</label>
                                <el-select v-model="form.mother_id" placeholder="Select" style="width: 100%">
                                    <el-option v-for="item in options" :key="item.value" :label="item.label" :value="item.value">
                                    </el-option>
                                </el-select>
                            </v-flex>
                            <v-flex sm6>
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
        eventBus.$on("openEditAnimal", data => {
            this.form = data
            this.dialog = true;
        });
    },

    methods: {
        save() {
            var payload = {
                model: 'animals',
                data: this.form,
                id: this.form.id,
            }
            this.$store.dispatch('patchItems', payload)
                .then(response => {
                    eventBus.$emit("AnimalEvent")
                });
        },
        close() {
            this.dialog = false;
        }
    },
    computed: {
        loading() {
            return this.$store.getters.loading;
        },
    },
};
</script>
