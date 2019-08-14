<template>
    <form id="address-informations-form" method="POST" action="" @submit.prevent="gotoNextStep">
        <h2>Address Informations (2/4)</h2>
        <div class="form-group">
            <label class="label" for="street">Street</label>
            <input id="street" name="street" :value="register_form.street" @input="setRegisterFormFieldValue">
        </div>
        <div class="form-group">
            <label class="label" for="streetNumber">Number</label>
            <input id="streetNumber" name="streetNumber" :value="register_form.streetNumber" @input="setRegisterFormFieldValue">
        </div>
        <div class="form-group">
            <label class="label" for="zipcode">Zip code</label>
            <input id="zipcode" name="zipcode" :value="register_form.zipcode" @input="setRegisterFormFieldValue">
        </div>
        <div class="form-group">
            <label class="label" for="city">City</label>
            <input id="city" name="city" :value="register_form.city" @input="setRegisterFormFieldValue">
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6"><button type="button" @click.prevent="gotoPreviousStep">Back to previous form</button></div>
                <div class="col-md-6"><button type="submit">Next</button></div>
            </div>
        </div>
    </form>
</template>

<script>
    import {mapState, mapGetters, mapMutations } from 'vuex';

    export default {
        name: 'address-informations-form',
        computed: {
            ...mapState(['register_form'])
        },
        methods: {
            ...mapMutations(['setRegisterFormFieldValue', 'gotoNextStep', 'gotoPreviousStep'])
        }
    }
</script>
