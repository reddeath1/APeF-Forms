(function( $ ) {
    'use strict';

    $(function() {
        let currentStep = 1;
        const totalSteps = $(".form-step").length;
        const formId = 'ziada-reg-form-progress';

        const saveFormProgress = () => {
            const formData = $('#multi-step-form').serializeArray();
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

        // ... (other functions like updateProgressBar, showStep, validateStep)

        $('#multi-step-form').on('change', 'input, select, textarea', saveFormProgress);

        $('#multi-step-form').on('submit', function(e) {
            e.preventDefault();
            // ... (AJAX submission logic)
            $.ajax({
                // ...
                success: function(response) {
                    if (response.success) {
                        // ...
                        localStorage.removeItem(formId); // Clear progress on success
                    } else {
                        // ...
                    }
                },
                // ...
            });
        });

        loadFormProgress();
        updateProgressBar();
    });

})( jQuery );