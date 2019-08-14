<template>
    <div class="container">
        <personal-informations-form v-if="isPersonalInformationsFormStep"></personal-informations-form>
        <address-informations-form v-if="isAddressInformationsFormStep"></address-informations-form>
        <payment-informations-form v-if="isPaymentInformationsFormStep"></payment-informations-form>
        <form-result v-if="isFormResultStep"></form-result>
    </div>
</template>

<script>
    import {mapState, mapGetters, mapMutations } from 'vuex';
    import AddressInformationsForm from '../components/AddressInformationsForm.vue';
    import PaymentInformationsForm from '../components/PaymentInformationsForm.vue';
    import PersonalInformationsForm from '../components/PersonalInformationsForm.vue';
    import FormResult from '../components/FormResult.vue';

    export default {
        name: 'register-form',
        components: {
            AddressInformationsForm,
            PaymentInformationsForm,
            PersonalInformationsForm,
            FormResult,
        },
        computed: {
            ...mapGetters([
                'isPersonalInformationsFormStep',
                'isAddressInformationsFormStep',
                'isPaymentInformationsFormStep',
                'isFormResultStep',
            ])
        },
        methods: {

        }
    }
</script>

<style lang="css">
    /*@import "~bootstrap";*/
</style>
