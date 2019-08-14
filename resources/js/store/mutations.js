
export default {
    setRegisterFormErrors(state, errors) {
        state.register_form_errors = errors;
    },
    setRegisterFormErrorMessage (state, msg) {
        state.register_form_error_message = msg;
    },
    setRegisterFormFieldValue(state, e) {
        const field = e.target.id;
        const val = e.target.value;
        state.register_form[field] = val;
    },
    gotoNextStep(state) {
        if (state.register_form_step >= state.register_form_last_step) {
            return;
        }
        state.register_form_step = state.register_form_step + 1;
    },
    gotoPreviousStep(state) {
        if (state.register_form_step <= 1) {
            return;
        }
        state.register_form_step = state.register_form_step - 1;
    },
    setRegisterFormStep(state, stepNum) {
        state.register_form_step = stepNum;
    },
    setPersistedCustomer(state, customer) {
        state.persisted_customer = customer;
    }
}
