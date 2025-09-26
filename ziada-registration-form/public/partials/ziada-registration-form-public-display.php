<?php
/**
 * The public-facing display of the form.
 */
require_once plugin_dir_path(dirname(__FILE__, 2)) . 'includes/ziada-language-helper.php';
?>
<div id="ziada-reg-form-wrapper">
    <div id="ziada-reg-form" class="container card p-4">
        <div class="progress mb-4">
            <div class="progress-bar" role="progressbar" style="width: 0%;"></div>
        </div>
        <form id="multi-step-form" method="POST" enctype="multipart/form-data">
            <p class="honeypot-field"><label for="user_website">Website</label><input type="text" name="user_website" id="user_website" value="" tabindex="-1" autocomplete="off"></p>

            <!-- Step 1: Account Type & 1st Investor -->
            <div class="form-step active" data-step="1">
                <h4 class="form-section-title"><?php echo ziada_get_string('account_type'); ?></h4>
                <!-- ... All fields for Step 1 ... -->
            </div>
            <!-- ... All other steps ... -->
            <div class="form-step" data-step="5">
                <h4 class="form-section-title"><?php echo ziada_get_string('declaration'); ?></h4>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="declaration" name="declaration" required>
                    <label class="form-check-label" for="declaration"><?php echo ziada_get_string('declaration_text'); ?></label>
                </div>
                <div class="btn-wrapper">
                    <button type="button" class="btn btn-secondary prev-step"><?php echo ziada_get_string('prev'); ?></button>
                    <button type="submit" class="btn btn-success"><?php echo ziada_get_string('submit'); ?></button>
                </div>
            </div>
        </form>
        <div id="form-messages" class="mt-3"></div>
    </div>
</div>