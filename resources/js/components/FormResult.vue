<template>
    <div class="result-page">
        <h2>Registration result (4/4)</h2>
        <p>
            <strong>Name: </strong> {{persisted_customer.firstName}} {{persisted_customer.lastName}}
        </p>
        <p v-if="persisted_customer.remotePaymentDataId"><strong>Payment Data Id:</strong> {{persisted_customer.remotePaymentDataId}}</p>
        <p v-else><strong>Payment Data Id:</strong> Wait a few seconds, we're processing your payment data.</p>
    </div>
</template>

<script>
    import {mapState, mapGetters, mapMutations } from 'vuex';

    export default {
        name: 'form-result',
        computed: {
            ...mapState(['persisted_customer'])
        },
        methods: {
            // ...mapMutations(['setRegisterFormFieldValue'])
        }
    }
</script>
