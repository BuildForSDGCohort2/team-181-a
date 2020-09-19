<template>
<v-dialog v-model="dialog" persistent max-width="600px">
    <v-card>
        <v-card-title primary-title>

                <h4 class="modal-title" style="color: black"> Register as a <span
                        style="color: rgb(212, 210, 204)">supplier</span></h4>
                <small class="form-text text-muted">Successful Applicants will Recieve confirmatory email</small>
        </v-card-title>
        <VDivider />
        <v-card-text>
            <v-layout row wrap>

                <v-flex sm5 offset-sm1>
                    <div class="form-group">
                        <label for="name">Full <span class='text-primary'>business</span> name </label>
                        <input type="text" class="form-control" v-model='form.name' id="name" aria-describedby="name" placeholder="enter business name" required>
                        <small id="type" class="form-text text-muted">Name of business.</small>
                        <small class="has-text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                    </div>
                </v-flex>

                <v-flex sm5 offset-sm1>
                    <div class="form-group">
                        <label for="size">Email</label>
                        <input type="email" v-model='form.email' class="form-control" id="email" aria-describedby="mail" placeholder="abc@xyz.com">
                        <small id="mail" class="form-text text-muted">Enter Email</small>
                        <small class="has-text-danger" v-if="errors.email">{{ errors.email[0] }}</small>

                    </div>
                </v-flex>

                <v-flex sm5 offset-sm1>
                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" v-model='form.location' class="form-control" id="location" aria-describedby="loc" placeholder="eg. Nakuru.." required>
                        <small id="loc" class="form-text text-muted">Enter Location</small>
                        <small class="has-text-danger" v-if="errors.location">{{ errors.location[0] }}</small>
                    </div>
                </v-flex>

                <v-flex sm5 offset-sm1>
                    <div class="form-group">
                        <label for="strain">Phone number</label>
                        <input type="text" v-model='form.phone_number' class="form-control" id="phone_number" aria-describedby="idnumber" placeholder="XXX-XXX" required>
                        <small id="idnnumber" class="form-text text-muted">Enter Phone number</small>
                        <small class="has-text-danger" v-if="errors.id_number">{{ errors.id_number[0] }}</small>
                    </div>
                </v-flex>

                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="validatedCustomFile" required>
                    <label class="custom-file-label" for="validatedCustomFile">Upload <span class="text-danger">KRA</span>
                        Cert</label>
                    <div class="invalid-feedback">Invalid File</div>
                </div>

                <v-flex sm5 offset-sm1>
                    <fieldset>
                        <label>Specialty:</label><br>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="hardware" value="hardware" v-model="form.hardware">
                                <label class="custom-control-label" for="hardware"> Hardware</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="agrovet" value="agrovet" v-model="form.agrovet">
                                <label class="custom-control-label" for="agrovet"> Agrovet</label>
                            </div>
                        </div>

                    </fieldset>
                </v-flex>

                <v-flex sm5 offset-sm1>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" v-model="form.transport" class="custom-control-input" id="transport" value="true">
                            <input type="checkbox" class="custom-control-input" id="transport">
                            <label class="custom-control-label" for="transport">Can You Provide <span class="text-warning">Transport</span> ? </label>
                        </div>
                    </div>
                </v-flex>

                <v-flex sm5 offset-sm1>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" v-model="form.agree" class="custom-control-input" id="agree">
                            <input type="checkbox" class="custom-control-input" id="agree">
                            <label class="custom-control-label" for="agree"> Agree to <a href="#" class="text-primary">terms and
                                    conditions</a> </label>
                        </div>
                    </div>
                </v-flex>

                <input type="hidden" id="reg_type" v-model="form.reg_type" value="suplier">
                <div class="modal-footer">
                    <v-btn color="primary" text @click="save">Submit</v-btn>
                    <v-btn color="primary" text @click="dialog = false">Cancel</v-btn>
                </div>
            </v-layout>

        </v-card-text>
    </v-card>

</v-dialog>
</template>

<script>
import {
    mapState
} from 'vuex';
export default {
    data() {
        return {
            form: {},
            dialog: false
        }
    },
    methods: {
        save() {
            var payload = {
                model: 'supplier/register',
                data: this.form
            }
            this.$store.dispatch('postItems', payload)
                .then(response => {
                    this.$message({
                        type: 'success',
                        message: 'Account Created'
                    });
                    window.location = '/supplier/login'
                });

        }
    },
    computed: {
        ...mapState(['errors'])
    },
    created() {
        eventBus.$on('openSupplierEvent', data => {
            this.dialog = true
        });
    },
}
</script>
