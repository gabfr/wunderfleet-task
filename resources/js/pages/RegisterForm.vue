<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <personal-informations-form v-if="isPersonalInformationsFormStep"></personal-informations-form>
                <address-informations-form v-if="isAddressInformationsFormStep"></address-informations-form>
                <payment-informations-form v-if="isPaymentInformationsFormStep"></payment-informations-form>
                <form-result v-if="isFormResultStep"></form-result>
            </div>
        </div>
        <div style="text-align: center;">
            <button class="btn btn-sm" @click="$store.commit('resetState')">Clear form & start again</button>
        </div>

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
        async mounted() {
            const persistedCustomer = this.$store.state.persisted_customer;
            if (persistedCustomer && persistedCustomer.id) {
                await this.$store.dispatch('fetchPersistedCustomer');
                this.$store.commit('setRegisterFormStep', 4);
            }
        }
    }
</script>

<style lang="css">
    label {
        display: block;
    }
    h2 {
        text-align: center;
    }
    .form-group input {
        display: block;
        width: 100%;
    }
</style>
