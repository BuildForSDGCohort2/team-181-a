<template>
<v-dialog v-model="dialog" persistent max-width="600px">
    <v-card>
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="color: black"> Register as a <span style="color: rgb(255, 179, 0)">proffessional</span></h4>
                <small class="form-text text-muted">Successful Applicants will Recieve confirmatory email</small>

            </div>
            <div class="modal-body">

                <div class="first-column" style='width:45%; float: left;'>
                    <div class="form-group">
                        <label for="type">Full Names</label>
                        <input type="text" class="form-control" v-model='form.name' id="name" aria-describedby="name" placeholder="Enter Your Full names" required>
                        <small id="type" class="form-text text-muted">As they appear on the id.</small>
                        <small class="has-text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                    </div>

                    <div class="form-group">
                        <label for="strain">Id number</label>
                        <input type="text" v-model='form.id_number' class="form-control" id="id_number" aria-describedby="idnumber" placeholder="XXX-XXX" required>
                        <small id="idnnumber" class="form-text text-muted">Enter Id number</small>
                        <small class="has-text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                    </div>
                    <div class="form-group">
                        <label for="strain">Phone number</label>
                        <input type="text" v-model='form.phone_number' class="form-control" id="phone_number" aria-describedby="phonenumber" placeholder="07XX-XXX-XXX" required>
                        <small id="phonenumber" class="form-text text-muted">Enter Id number</small>
                        <small class="has-text-danger" v-if="errors.phone_number">{{ errors.phone_number[0] }}</small>
                    </div>
                    <fieldset>
                        <label>Specialty:</label><br>
                        <input type="radio" v-model="form.specialty" id="vet" value="vet" />
                        <label for="vet">Vet</label>

                        <input type="radio" v-model="form.specialty" id="feo" value="feo" />
                        <label for="feo">Feild Extension Officer</label>

                        <input type="radio" v-model="form.specialty" id="other" value="other" />
                        <label for="other">Other</label>
                        <small class="has-text-danger" v-if="errors.specialty">{{ errors.specialty[0] }}</small>
                    </fieldset>
                    <div class="form-group">
                        <label for="other">If Other Please Specify</label>
                        <input type="text" v-model='form.other' class="form-control" id="other" aria-describedby="other" placeholder="Enter The Specialty">
                        <small id="other" class="form-text text-muted">Please Specify </small>
                        <small class="has-text-danger" v-if="errors.other">{{ errors.other[0] }}</small>
                    </div>
                    <div class="form-group">
                        <label for="location">Location</label>
                        <input type="text" v-model='form.location' class="form-control" id="location" aria-describedby="loc" placeholder="eg. Nakuru.." required>
                        <small id="loc" class="form-text text-muted">Enter Location</small>
                        <small class="has-text-danger" v-if="errors.location">{{ errors.location[0] }}</small>
                    </div>

                </div>

                <div class="second-column" style='width:45%; float: right;'>

                    <div class="form-group">
                        <label for="strain">Id number</label>
                        <input type="text" v-model='form.id_number' class="form-control" id="id_number" aria-describedby="idnumber" placeholder="XXX-XXX" required>
                        <small id="idnnumber" class="form-text text-muted">Enter Id number</small>
                        <small class="has-text-danger" v-if="errors.id_number">{{ errors.id_number[0] }}</small>
                    </div>

                    <div class="form-group">
                        <label for="size">Email</label>
                        <input type="email" v-model='form.email' class="form-control" id="email" aria-describedby="mail" placeholder="abc@xyz.com" required>
                        <small id="mail" class="form-text text-muted">Enter Email</small>
                        <small class="has-text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                    </div>

                    <div class="form-group">
                        <label for="exp">Years Of Expirience</label>
                        <input type="text" class="form-control" v-model='form.exp' id="exp" aria-describedby="expirience" placeholder="0">
                        <small id="expirience" class="form-text text-muted">Please indicate the Number of years of Experience .</small>
                        <small class="has-text-danger" v-if="errors.exp">{{ errors.exp[0] }}</small>
                    </div>

                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="file" id="file" required>
                        <label class="custom-file-label" for="file">Upload <span class="text-danger">CV</span> </label>
                        <div class="invalid-feedback">Invalid File</div>
                    </div>

                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="agre" name="agre" required>
                            <label class="custom-control-label" for="agre"> Agree to <a href="#" class="text-primary">terms and conditions</a> </label>
                        </div>
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button @click="save" class="btn btn-info" value="Submit">Submit</button>
                <button type="button" class="btn btn-default" @click="dialog = false">Cancel</button>
            </div>
            <input type="hidden" id="reg_type" name="reg_type" value="proffessional">

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
                model: 'profesionals_enrole',
                data: this.form
            }
            this.$store.dispatch('postItems', payload)
                .then(response => {
                    this.$message({
                        type: 'success',
                        message: 'Account Created'
                    });
                    // eventBus.$emit("OrderEvent")
                    window.location = '/professional/login'
                });

        }
    },
    computed: {
        ...mapState(['errors'])
    },
    created() {
        eventBus.$on('openProfessionalEvent', data => {
            this.dialog = true
        });
    },
}
</script>
