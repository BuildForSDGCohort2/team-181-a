<template>
<div id="death" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Record Death</h4>
            </div>
            <div class="modal-body">
                <!-- <form action="{{route('death_of_animal',$animal)}}" method="post"> -->

                    <div class="first-column">
                        <label> Reason...</label>
                        <hr>
                        <div style="float: left ;width:45%;">
                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="slaughter" name="all">
                                    <label class="custom-control-label" for="slaughter"><span class="text-"> Personal <span class="text-success">uses</span> </span>?</label> <br>
                                    <small class="text-info"> Check this option if you want to use the animal for personal uses.</small>

                                </div>
                            </div>
                        </div>
                        <div style="float: right; width:45%;">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="summon_vet" name="all">
                                <label class="custom-control-label" for="summon_vet"><span class="text-success"><span class="text-warning">Sickness / Accident</span> </span>?</label><br>
                                <small class="text-info"> A Local Vet will be automatically be summoned...</small>
                            </div>
                        </div>

                    </div>


            </div>
            <div class="modal-footer">
                <button @click="save" class="btn btn-info" value="Submit">Submit</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
            <!-- </form> -->
        </div>

    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            form: {}
        }
    },
    methods: {
        save() {
            var payload = {
                model: 'death/' + this.form.id +  '/animal',
                data: this.form,
                // id: this.form.id
            }
            this.$store.dispatch('postItems', payload)
                .then(response => {
                    eventBus.$emit("AnimalEvent")
                });
        },
    },
    created () {
        eventBus.$on('openSellEvent', data => {
            // this.dialog = true
            // console.log(data);
            this.form = data
        });
    },
}
</script>
