<template>
    <form id="personal-informations-form" method="POST" action="" @submit.prevent="gotoNextStep">
        <h2>Personal Informations (1/4)</h2>
        <div class="form-group">
            <label class="label" for="firstName">First name</label>
            <input required id="firstName" name="firstName" :value="register_form.firstName" @input="setRegisterFormFieldValue">
        </div>
        <div class="form-group">
            <label class="label" for="lastName">Last name</label>
            <input required id="lastName" name="lastName" :value="register_form.lastName" @input="setRegisterFormFieldValue">
        </div>
        <div class="form-group">
            <label class="label" for="telephone">Telephone</label>
            <input required id="telephone" name="telephone" :value="register_form.telephone" @input="setRegisterFormFieldValue">
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6"></div>
                <div class="col-md-6 text-right"><button type="submit">Next</button></div>
            </div>
        </div>
    </form>
</template>

<script>
    import {mapState, mapGetters, mapMutations } from 'vuex';

    export default {
        name: 'personal-informations-form',
        computed: {
            ...mapState(['register_form'])
        },
        methods: {
            ...mapMutations(['setRegisterFormFieldValue', 'gotoNextStep'])
        }
    }
</script>
