import Vue from 'vue'
import axios from 'axios';

export default {
    async persistCustomer ({commit, state}) {
        try {
            const response = await axios.post(`customers`, state.register_form);
            const customer = response.data;
            commit('setPersistedCustomer', customer);
        } catch (err) {

        }
    }
}
