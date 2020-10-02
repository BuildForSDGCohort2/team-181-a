<template>
<div id="sell_animal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Sell</h4>
            </div>
            <div class="modal-body">

                <div class="first-column">
                    <div class="form-group">
                        <label for="animal_weight">Enter Current Animal Weight</label>
                        <input type="number" class="form-control" v-model='form.animal_weight' id="animal_weight" aria-describedby="animal_weight" placeholder="" min='1'>
                        <small id="animal_weight" class="form-text text-muted"> Current Weight.</small>
                    </div>

                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" class="form-control" v-model='form.price' id="price" aria-describedby="price" placeholder="is the Recommended price">
                        <small id="price" class="form-text text-muted">Price.</small>
                    </div>
                    <div class="form-group">
                        <label for="species"><small>Recommendations</small> </label>
                        <textarea class="form-control" id="recomendations" rows="3" readonly>
                                  </textarea>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="call_vet" v-model="form.call_vet">
                            <label class="custom-control-label" for="call_vet"><span class=""> Summon the <span class="text-success">vet</span> </span>?</label><br>
                            <label> <small><span class="text-warning"> Recommended * </span></small></label>
                        </div>
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button @click="save" class="btn btn-info" value="Submit">Submit</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
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
                model: 'sell/' + this.form.id +  '/animal',
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
