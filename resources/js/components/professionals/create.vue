<template>
<v-layout row justify-center>
    <v-dialog v-model="dialog" persistent max-width="700px">
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
                                <label for="">Name</label>
                                <el-input placeholder="" v-model="form.name"></el-input>
                            </v-flex>
                            <v-flex sm5 offset-sm1>
                            <label for="">Location</label>
                                <el-input placeholder="" v-model="form.location"></el-input>
                            </v-flex>
                            <v-flex sm5 offset-sm1>
                                <label for="">Phone No.</label>
                                <el-input placeholder="" v-model="form.phone"></el-input>
                            </v-flex>
                            <v-flex sm5 offset-sm1>
                                <label for="">Rating</label>
                                <v-rating v-model="form.rating" ></v-rating>
                            </v-flex>
                            <v-flex sm12 offset-sm1>
                                <label for="">Qualifications</label>
                                <el-input type="textarea" :autosize="{ minRows: 2, maxRows: 4}" placeholder="comments" v-model="form.qualifications">
                            </el-input>
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
            rating: 3
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
        eventBus.$on("openCreateProfessional", data => {
            this.dialog = true;
        });
    },

    methods: {
        save() {
            var payload = {
            model: 'professionals',
                data: this.form
            }
            this.$store.dispatch('postItems', payload)
                .then(response => {
                    eventBus.$emit("ProfessionalEvent")
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
