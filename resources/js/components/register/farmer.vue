<template>
<v-dialog v-model="dialog" persistent max-width="500px">
    <v-card>
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" style="color: black"> Register as a <span style="color: green">Farmer</span> </h4>
                        <strong class="form-text text-muted">Welcome To the Platform that is all about <span class="text-success">You..</span> ..</strong>
                    </div>
                    <div class="modal-body">
                        <div class="first-column" style='width:32%; float: left;margin-right:1%'>
                            <div class="form-group">
                                <label for="type">Full Names</label>
                                <input type="text" class="form-control" name='name' id="name" aria-describedby="name" placeholder="Enter Your Full names" required>
                                <small id="type" class="form-text text-muted">As they appear on the id.</small>
                            </div>

                            <div class="form-group">
                                <label for="strain">Id number</label>
                                <input type="text" name='id_number' class="form-control" id="id_number" aria-describedby="idnumber" placeholder="XXX-XXX" required>
                                <small id="idnnumber" class="form-text text-muted">Enter Id number</small>
                            </div>
                            <div class="form-group">
                                <label for="strain">Phone number</label>
                                <input type="text" name='phone_number' class="form-control" id="phone_number" aria-describedby="phonenumber" placeholder="07XX-XXX-XXX" required>
                                <small id="phonenumber" class="form-text text-muted">Enter Phone number</small>
                            </div>
                            <div class="form-group">
                                <label for="location">Location</label>
                                <input type="text" name='location' class="form-control" id="location" aria-describedby="loc" placeholder="eg. Nakuru.." required>
                                <small id="loc" class="form-text text-muted">Enter Location</small>
                            </div>

                        </div>

                        <div class="second-column" style='width:32%; float: left;margin-right:1%'>
                            <div class="form-group">
                                <label for="size"> Farm size..</label>
                                <input type="text" name='size' class="form-control" id="size" aria-describedby="size" placeholder="optional">
                                <small id="size" class="form-text text-muted">Farm Size..</small>
                            </div>
                            <label>Calibration in:</label><br>
                            <input type="radio" name="callibration" id="meters" value="meters" />
                            <label for="meters">M &sup2; </label>

                            <input type="radio" name="callibration" id="acres" value="acres" />
                            <label for="acres">Acr</label>

                            <input type="radio" name="callibration" id="hactares" value="hactares" />
                            <label for="hactares">Ha</label>
                            <label>Check Where Appropriate:</label><br>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="animals" name="fields[animal]">
                                    <label class="custom-control-label" for="animals"> Animals</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="crops" name="fields[crops]">
                                    <label class="custom-control-label" for="crops">Crops</label>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="poultry" name="fields[poultry]">
                                    <label class="custom-control-label" for="poultry">Poultry Broods</label>
                                </div>
                            </div>

                        </div>
                        <div class="third-column" style='width:32%; float: right;margin-right:1%'>
                            <div class="form-group">
                                <label for="size">Email</label>
                                <input type="email" name='email' class="form-control" id="email" aria-describedby="mail" placeholder="abc@xyz.com" required>
                                <small id="mail" class="form-text text-muted">Enter Email</small>
                            </div>

                            <div class="form-group">
                                <label for="exp">Password..</label>
                                <input type="password" class="form-control" name='password' id="password" aria-describedby="password" placeholder="password" required>
                                <small id="expirience" class="form-text text-muted">Password</small>
                            </div>

                            <div class="form-group">
                                <label for="password">Confirm Password..</label>
                                <input type="password" class="form-control" name='conf_password' id="conf_password" aria-describedby="conf_password" placeholder="password" required>
                                <small id="password" class="form-text text-muted"> Confirm Password</small>
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="agr" name="agr" required>
                                    <label class="custom-control-label" for="agr"> Agree to <a href="#" class="text-primary">terms and conditions</a> </label>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button @click="save" class="btn btn-info" value="Submit">Submit</button>
                        <button type="button" class="btn btn-default" @click="dialog = false">Cancel</button>
                    </div>
                    <input type="hidden" id="reg_type" name="reg_type" value="farmer">
                </div>
            </div>
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
