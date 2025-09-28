(function($) {
    'use strict';
    $(function() {
        // --- Setup ---
        let currentStep = 1;
        const totalSteps = $(".form-step").length;
        const formId = 'ziada-reg-form-progress';
        const form = $('#multi-step-form');

        // --- Core Functions ---
        const updateProgressBar = () => {
            const progress = ((currentStep - 1) / (totalSteps - 1)) * 100;
            $(".progress-bar").css("width", progress + "%").text(`Step ${currentStep} of ${totalSteps}`);
        };

        const showStep = (step) => {
            $(".form-step").removeClass("active");
            $(`.form-step[data-step="${step}"]`).addClass("active");
            currentStep = step;
            updateProgressBar();
        };

        const validateStep = (step) => {
            let isValid = true;
            const currentStepFields = $(`.form-step[data-step="${step}"]`).find(':input[required]:visible');
            currentStepFields.removeClass('is-invalid');
            currentStepFields.each(function() {
                if ($(this).val().trim() === '') {
                    $(this).addClass('is-invalid');
                    isValid = false;
                }
            });
            return isValid;
        };

        // --- Event Handlers ---
        $(".next-step").on("click", () => { if (validateStep(currentStep)) showStep(currentStep + 1); });
        $(".prev-step").on("click", () => showStep(currentStep - 1));

        // --- Conditional Logic Fix ---
        $('input[name="account_type"]').on('change', function() {
            const selectedType = this.value;
            // Hide all conditional sections first
            $('#section_b_joint, #section_c_company, #section_d_minor').hide();

            // Show only the relevant section
            if (selectedType === 'joint') {
                $('#section_b_joint').show();
            } else if (selectedType === 'company') {
                $('#section_c_company').show();
            } else if (selectedType === 'minor') {
                $('#section_d_minor').show();
            }
        });
        // Trigger on load to set the initial correct state
        $('input[name="account_type"]:checked').trigger('change');

        // ... (other handlers: dynamic nominees, form submission) ...

        // --- Initialization ---
        updateProgressBar();
    });
})(jQuery);