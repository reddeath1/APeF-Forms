(function( $ ) {
    'use strict';

    $(function() {
        let currentStep = 1;
        const totalSteps = $(".form-step").length;

        // Function to update the progress bar
        const updateProgressBar = () => {
            const progress = (currentStep / totalSteps) * 100;
            $(".progress-bar").css("width", progress + "%").text("Step " + currentStep + " of " + totalSteps);
        };

        // Function to show a specific step
        const showStep = (step) => {
            $(".form-step").removeClass("active");
            $(`.form-step[data-step="${step}"]`).addClass("active");
            currentStep = step;
            updateProgressBar();
        };

        // --- Validation Function ---
        const validateStep = (step) => {
            let isValid = true;
            const currentStepFields = $(`.form-step[data-step="${step}"] :input[required]:visible`);

            // Clear previous errors
            currentStepFields.removeClass('is-invalid');

            currentStepFields.each(function() {
                if ($(this).val().trim() === '') {
                    $(this).addClass('is-invalid');
                    isValid = false;
                }
                // Special check for email format
                if ($(this).attr('type') === 'email') {
                    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailPattern.test($(this).val())) {
                        $(this).addClass('is-invalid');
                        isValid = false;
                    }
                }
            });

            return isValid;
        };

        // Remove validation error on input
        $('#multi-step-form :input[required]').on('input', function() {
            if ($(this).val().trim() !== '') {
                $(this).removeClass('is-invalid');
            }
        });

        // Next button click handler
        $(".next-step").on("click", function() {
            if (validateStep(currentStep)) {
                if (currentStep < totalSteps) {
                    showStep(currentStep + 1);
                }
            }
        });

        // Previous button click handler
        $(".prev-step").on("click", function() {
            if (currentStep > 1) {
                showStep(currentStep - 1);
            }
        });

        // --- Conditional Logic for Account Type ---
        $('input[name="account_type"]').on('change', function() {
            const selectedType = $(this).val();

            $('#section_b_joint, #section_c_company, #section_d_minor').hide();
            // Also make their fields not required when hidden
            $('#section_b_joint :input, #section_c_company :input, #section_d_minor :input').prop('required', false);


            if (selectedType === 'joint') {
                $('#section_b_joint').show();
                $('#section_b_joint :input').prop('required', true); // This is a simplification, need to be specific
            } else if (selectedType === 'company') {
                $('#section_c_company').show();
                $('#section_c_company :input').prop('required', true); // This is a simplification
            } else if (selectedType === 'minor') {
                $('#section_d_minor').show();
                $('#section_d_minor :input').prop('required', true); // This is a simplification
            }
        });

        $('input[name="account_type"]:checked').trigger('change');

        // --- Dynamic Nominees ---
        let nomineeCount = 1;
        $('#add-nominee').on('click', function() {
            nomineeCount++;
            const newNominee = `
                <div class="nominee-group mt-3 pt-3 border-top">
                    <h5>Nominee ${nomineeCount} <button type="button" class="btn btn-danger btn-sm remove-nominee float-right">Remove</button></h5>
                    <div class="row">
                        <div class="col-md-4 form-group"><label>Jina Kamili</label><input type="text" name="nominee_name[]" class="form-control"></div>
                        <div class="col-md-3 form-group"><label>Tarehe ya Kuzaliwa</label><input type="date" name="nominee_dob[]" class="form-control"></div>
                        <div class="col-md-2 form-group"><label>Asilimia ya Umiliki (%)</label><input type="number" name="nominee_ownership[]" class="form-control"></div>
                        <div class="col-md-3 form-group"><label>Uhusiano</label><input type="text" name="nominee_relation[]" class="form-control"></div>
                    </div>
                </div>`;
            $('#nominees-wrapper').append(newNominee);
        });

        $('#nominees-wrapper').on('click', '.remove-nominee', function() {
            $(this).closest('.nominee-group').remove();
        });

        // Init
        updateProgressBar();

    });

})( jQuery );
