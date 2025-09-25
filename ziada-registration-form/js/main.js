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
            $(".progress-bar").css("width", progress + "%").text("Step " + currentStep + " of " + totalSteps);
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

        // --- Save/Load Progress ---
        const saveFormProgress = () => {
            const formData = form.serializeArray();
            localStorage.setItem(formId, JSON.stringify(formData));
        };

        const loadFormProgress = () => {
            const savedData = localStorage.getItem(formId);
            if (savedData) {
                const formData = JSON.parse(savedData);
                formData.forEach(function(item) {
                    const $element = $('[name="' + item.name + '"]');
                    if ($element.is(':radio') || $element.is(':checkbox')) {
                        $element.filter('[value="' + item.value + '"]').prop('checked', true).trigger('change');
                    } else {
                        $element.val(item.value);
                    }
                });
            }
        };

        // --- Event Handlers ---
        form.on('input', ':input[required]', function() { $(this).removeClass('is-invalid'); });
        form.on('change', 'input, select, textarea', saveFormProgress);

        $(".next-step").on("click", () => { if (validateStep(currentStep) && currentStep < totalSteps) showStep(currentStep + 1); });
        $(".prev-step").on("click", () => { if (currentStep > 1) showStep(currentStep - 1); });

        $('input[name="account_type"]').on('change', function() {
            const selectedType = $(this).val();
            $('#section_b_joint, #section_c_company, #section_d_minor').hide();
            if (selectedType === 'joint') $('#section_b_joint').show();
            else if (selectedType === 'company') $('#section_c_company').show();
            else if (selectedType === 'minor') $('#section_d_minor').show();
        }).trigger('change');

        $('#add-nominee').on('click', function() {
            const wrapper = $('#nominees-wrapper');
            const newNominee = wrapper.find('.nominee-group:first').clone();
            newNominee.find('h5').text('Nominee ' + (wrapper.find('.nominee-group').length + 1));
            newNominee.find('input').val('');
            newNominee.find('h5').append(' <button type="button" class="btn btn-danger btn-sm remove-nominee float-right">Remove</button>');
            wrapper.append(newNominee);
        });

        $('#nominees-wrapper').on('click', '.remove-nominee', function() { $(this).closest('.nominee-group').remove(); });

        form.on('submit', function(e) {
            e.preventDefault();
            if (!validateStep(currentStep)) return;

            const submitButton = form.find('button[type="submit"]');
            const originalButtonText = submitButton.text();
            submitButton.prop('disabled', true).text('Submitting...');

            const messageContainer = $('#form-messages');
            messageContainer.html('');

            const formData = new FormData(this);
            formData.append('action', 'ziada_form_submit');
            formData.append('nonce', ziada_form_params.nonce);

            $.ajax({
                type: 'POST',
                url: ziada_form_params.ajax_url,
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        form.hide();
                        $('.progress').hide();
                        messageContainer.html('<div class="alert alert-success">' + response.data.message + '</div>');
                        localStorage.removeItem(formId);
                    } else {
                        messageContainer.html('<div class="alert alert-danger">' + response.data.message + '</div>');
                        submitButton.prop('disabled', false).text(originalButtonText);
                    }
                },
                error: () => {
                    messageContainer.html('<div class="alert alert-danger">An unexpected error occurred.</div>');
                    submitButton.prop('disabled', false).text(originalButtonText);
                }
            });
        });

        // --- Initialization ---
        loadFormProgress();
        updateProgressBar();
    });
})(jQuery);