<template>
<div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">New Plantation</h4>
        </div>
        <div class="modal-body">

            <div class="first-column" style='width:45%; float: left;'>
                <div class="form-group">
                    <label for="species">Type Of Plant</label>
                    <input type="text" class="form-control" name='species' id="species" aria-describedby="species" placeholder="Enter plant type">
                    <small id="species" class="form-text text-muted">Select the Appropriate plant or Enter name.</small>
                </div>

                <div class="form-group">
                    <label for="type_id">Number / Strain</label>
                    <input type="text" name='type_id' class="form-control" id="type_id" aria-describedby="type_id" placeholder="Select Strain">
                    <small id="type_id" class="form-text text-muted">Select the type..</small>
                </div>

            </div>
            <div class="second-column" style='width:45%; float: right;'>
                <div class="form-group">
                    <label for="size">Size OF Allocation</label>
                    <input type="text" name='size' class="form-control" id="size" aria-describedby="size" placeholder="Enter Total Size">
                    <small id="size" class="form-text text-muted">Enter size of the allocation</small>
                </div>
                <label>Calibration in:</label><br>
                <input type="radio" name="callibration" id="meters" value="meters" />
                <label for="meters">Meters &sup2; </label>

                <input type="radio" name="callibration" id="acres" value="acres" />
                <label for="acres">Acres</label>

                <input type="radio" name="callibration" id="hactares" value="hactares" />
                <label for="hactares">Hactares</label>

                <div class="form-group">
                    <label for="planting_date">Date Of Planting</label>
                    <input type="date" class="form-control" name='planting_date' id="planting_date" aria-describedby="planting_date" placeholder="Enter Date of planting">
                    <small id="planting_date" class="form-text text-muted">Select date time Defaut date is today.</small>
                </div>

            </div>

        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-info" value="Submit">Submit</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
    </div>

</div>
</template>

<script>
import {
    mapState
} from 'vuex';
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
        eventBus.$on("openEditPlantation", data => {
            this.form = data
            this.dialog = true;
        });
    },

    methods: {
        save() {
            var payload = {
                model: 'plantations',
                data: this.form,
                id: this.form.id,
            }
            this.$store.dispatch('patchItems', payload)
                .then(response => {
                    eventBus.$emit("PlantationEvent")
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
