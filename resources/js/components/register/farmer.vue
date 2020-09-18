<template>
<v-dialog v-model="dialog" persistent max-width="400px">
    <v-card>
        <v-card-title primary-title>
            Farmer
            <VSpacer/>
            <v-btn text icon color="primary" @click="dialog = false">
                <v-icon>mdi-close</v-icon>
            </v-btn>
        </v-card-title>
        <VDivider />
        <v-card-text>
            <v-layout row wrap>

                <div class="card card-login card-hidden mb-3">
                    <div class="card-header card-header-primary text-center">
                        <h4 class="card-title"><strong>Register</strong></h4>
                        <div class="social-line">
                            <a href="#pablo" class="btn btn-just-icon btn-link btn-white">
                                <i class="fa fa-facebook-square"></i>
                            </a>
                            <a href="#pablo" class="btn btn-just-icon btn-link btn-white">
                                <i class="fa fa-twitter"></i>
                            </a>
                            <a href="#pablo" class="btn btn-just-icon btn-link btn-white">
                                <i class="fa fa-google-plus"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body ">
                        <p class="card-description text-center">Or Be Classical</p>
                        <div class="bmd-form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="material-icons">face</i>
                                    </span>
                                </div>
                                <input type="text" v-model="form.name" class="form-control" placeholder="Name...">
                                <small class="has-text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                            </div>
                        </div>
                        <div class="bmd-form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="material-icons">email</i>
                                    </span>
                                </div>
                                <input type="email" v-model="form.email" class="form-control" placeholder="Email...">
                                <small class="has-text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                            </div>
                        </div>
                        <div class="bmd-form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="material-icons">lock_outline</i>
                                    </span>
                                </div>
                                <input type="password" v-model="form.password" id="password" class="form-control" placeholder="Password...">
                                <small class="has-text-danger" v-if="errors.password">{{ errors.password[0] }}</small>
                            </div>
                        </div>
                        <div class="bmd-form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="material-icons">lock_outline</i>
                                    </span>
                                </div>
                                <input type="password" v-model="form.password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm Password...">
                            </div>
                        </div>
                        <div class="form-check mr-auto ml-3 mt-3">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" id="policy">
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                                I agree with the <a href="#">Privacy Policy</a>
                            </label>
                        </div>
                    </div>
                    <div class="card-footer justify-content-center">
                        <button type="submit" class="btn btn-primary btn-link btn-lg" @click="save">Create account</button>
                    </div>
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
                model: '/register',
                data: this.form
            }
            this.$store.dispatch('postItems', payload)
                .then(response => {
                    // eventBus.$emit("OrderEvent")
                });

        }
    },
    computed: {
        ...mapState(['errors'])
    },
    created() {
        eventBus.$on('openFarmerEvent', data => {
            this.dialog = true
        });
    },
}
</script>
