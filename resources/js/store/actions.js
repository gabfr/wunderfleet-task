import Vue from 'vue'
import axios from 'axios';

export default {
    /**
     * Fetch the persisted customer.
     * If the remotePaymentDataId is not present, it will fetch again in 5 seconds.
     * @param commit
     * @param state
     * @returns {Promise<void>}
     */
    async fetchPersistedCustomer ({commit, state, dispatch}) {
        const persistedCustomer = state.persisted_customer;
        if (persistedCustomer && persistedCustomer.id) {
            const response = await axios.get(`api/customers/${persistedCustomer.id}`);
            const customer = response.data.data;
            commit('setPersistedCustomer', customer);
            if (!customer.remotePaymentDataId) {
                window.setTimeout(() => dispatch('fetchPersistedCustomer'), 5000)
            }
        }
    },
    /**
     * Persist the customer.
     * If the remotePaymentDataId is not available yet, we schedule a fetchPersistedCustomer again to fetch it
     * @param commit
     * @param state
     * @param dispatch
     * @returns {Promise<void>}
     */
    async persistCustomer ({commit, state, dispatch}) {
        const response = await axios.post(`api/customers`, state.register_form);
        const customer = response.data.data;
        commit('setPersistedCustomer', customer);
        if (!customer.remotePaymentDataId) {
            window.setTimeout(() => dispatch('fetchPersistedCustomer'), 5000)
        }
        commit('gotoNextStep');
    }
}
