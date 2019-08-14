<template>
    <form id="payment-informatios-form" method="POST" action="" @submit.prevent="onSubmitForm">
        <h2>Payment Informations (3/4)</h2>
        <div class="form-group">
            <label class="label" for="accountOwner">Account owner</label>
            <input id="accountOwner" name="accountOwner" :value="register_form.accountOwner" @input="setRegisterFormFieldValue">
        </div>
        <div class="form-group">
            <label class="label" for="iban">IBAN</label>
            <input id="iban" name="iban" :value="register_form.iban" @input="setRegisterFormFieldValue">
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-md-6"><button type="button" @click.prevent="gotoPreviousStep" :disabled="sendingFormData">Back to previous form</button></div>
                <div class="col-md-6"><button type="submit" :disabled="sendingFormData">Next</button></div>
            </div>
        </div>
    </form>
</template>

<script>
    import {mapState, mapGetters, mapMutations } from 'vuex';

    export default {
        name: 'payment-informations-form',
        data () {
            return {
                sendingFormData: false
            }
        },
        computed: {
            ...mapState(['register_form'])
        },
        methods: {
            ...mapMutations(['setRegisterFormFieldValue', 'gotoPreviousStep']),
            async onSubmitForm() {
                this.sendingFormData = true;
                const customer = await this.$store.dispatch('persistCustomer');
                this.sendingFormData = false;
                if (customer) {
                    this.$store.commit('gotoNextStep');
                }
            }
        }
    }
</script>
