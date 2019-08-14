import Vue from 'vue';
import Vuex from 'vuex';
import VuexPersistence from 'vuex-persist';
import createLogger from 'vuex/dist/logger';
import actions from './actions';
import getters from './getters';
import mutations from './mutations';

Vue.use(Vuex);

const vuexLocal = new VuexPersistence({storage: window.localStorage});

export const initialState = {
    register_form: {
        firstName: '',
        lastName: '',
        telephone: '',
        street: '',
        streetNumber: '',
        zipcode: '',
        city: '',
        accountOwner: '',
        iban: ''
    },
    register_form_error_message: '',
    register_form_errors: {},
    register_form_step: 1,
    register_form_last_step: 4,
    persisted_customer: null
};

const store = new Vuex.Store({
    plugins: [createLogger(), vuexLocal.plugin],
    state: {...initialState},
    getters,
    actions,
    mutations: {
        ...mutations,
        resetState(state) { for (let k in initialState) state[k] = initialState[k]; }
    }
});

export default store
