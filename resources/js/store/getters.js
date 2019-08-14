

export default {
    isPersonalInformationsFormStep(state) { return state.register_form_step === 1; },
    isAddressInformationsFormStep(state) { return state.register_form_step === 2; },
    isPaymentInformationsFormStep(state) { return state.register_form_step === 3; },
    isFormResultStep(state) { return state.register_form_step === 4; },
}

