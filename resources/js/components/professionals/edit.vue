<template>
<v-layout row justify-center>
    <v-dialog v-model="dialog" persistent max-width="800px">
        <v-card>
            <v-card-title>
                <span class="headline text-center" style="margin: auto;">Create Professional</span>
            </v-card-title>
            <v-divider></v-divider>
            <v-card-text>
                <v-container grid-list-md>
                    <v-card-text>
                        <v-layout row wrap>
                            <v-flex sm5 offset-sm1>
                                <label for="">Produce Id</label>
                                <el-input placeholder="" v-model="form.produce_id"></el-input>
                            </v-flex>
                            <v-flex sm5 offset-sm1>
                                <label for="">Professional Status</label>
                                <el-input placeholder="" v-model="form.professional_status"></el-input>
                            </v-flex>
                            <v-flex sm5 offset-sm1>
                                <label for="">Delivery status</label>
                                <el-input placeholder="" v-model="form.delivery_status"></el-input>
                            </v-flex>
                            <v-flex sm5 offset-sm1>
                                <label for="">Customer</label>
                                <el-select v-model="form.customer_id" placeholder="Select" style="width: 100%">
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
    }),
    created() {
        eventBus.$on("openEditProfessional", data => {
            this.form = data
            this.dialog = true;
        });
    },

    methods: {
        save() {
            var payload = {
                model: 'professionals',
                data: this.form,
                id: this.form.id,
            }
            this.$store.dispatch('patchItems', payload)
                .then(response => {
                    eventBus.$emit("ProfessionalEvent")
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
