(function($) {
    'use strict';
    $(function() {
        let currentStep = 1;
        const totalSteps = $(".form-step").length;
        const formId = 'ziada-reg-form-progress';
        const form = $('#multi-step-form');

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

        const saveFormProgress = () => {
            const formData = form.serializeArray();
            localStorage.setItem(formId, JSON.stringify(formData));
        };

        const loadFormProgress = () => {
            const savedData = localStorage.getItem(formId);
            if (savedData) {
                const formData = JSON.parse(savedData);
                formData.forEach(function(item) {
                    const $el = $(`[name="${item.name}"]`);
                    if ($el.is(':radio') || $el.is(':checkbox')) {
                        $el.filter(`[value="${item.value}"]`).prop('checked', true).trigger('change');
                    } else {
                        $el.val(item.value);
                    }
                });
            }
        };

        form.on('input', ':input[required]', function() { $(this).removeClass('is-invalid'); });
        form.on('change', 'input, select, textarea', saveFormProgress);

        $(".next-step").on("click", () => { if (validateStep(currentStep)) showStep(currentStep + 1); });
        $(".prev-step").on("click", () => showStep(currentStep - 1));

        $('input[name="account_type"]').on('change', function() {
            $('#section_b_joint, #section_c_company, #section_d_minor').hide();
            if (this.value === 'joint') $('#section_b_joint').show();
            else if (this.value === 'company') $('#section_c_company').show();
            else if (this.value === 'minor') $('#section_d_minor').show();
        }).trigger('change');

        $('#add-nominee').on('click', function() {
            const wrapper = $('#nominees-wrapper');
            const newNominee = wrapper.find('.nominee-group:first').clone();
            newNominee.find('h5').text(`Nominee ${wrapper.find('.nominee-group').length + 1}`);
            newNominee.find('input').val('');
            newNominee.find('h5').append(' <button type="button" class="btn btn-danger btn-sm remove-nominee">&times;</button>');
            wrapper.append(newNominee);
        });

        $('#nominees-wrapper').on('click', '.remove-nominee', function() { $(this).closest('.nominee-group').remove(); });

        form.on('submit', function(e) {
            e.preventDefault();
            if (!validateStep(currentStep)) return;

            const submitButton = form.find('button[type="submit"]');
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
                success: (response) => {
                    if (response.success) {
                        form.parent().html(`<div class="alert alert-success">${response.data.message}</div>`);
                        localStorage.removeItem(formId);
                    } else {
                        messageContainer.html(`<div class="alert alert-danger">${response.data.message}</div>`);
                        submitButton.prop('disabled', false).text('Submit Application');
                    }
                },
                error: () => {
                    messageContainer.html('<div class="alert alert-danger">An unexpected error occurred.</div>');
                    submitButton.prop('disabled', false).text('Submit Application');
                }
            });
        });

        loadFormProgress();
        updateProgressBar();
    });
})(jQuery);