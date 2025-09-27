<?php require_once plugin_dir_path(dirname(__FILE__, 2)) . 'includes/ziada-language-helper.php'; ?>
<div id="ziada-reg-form-wrapper">
    <div id="ziada-reg-form" class="container card p-4">
        <div class="progress mb-4"><div class="progress-bar" role="progressbar" style="width: 0%;"></div></div>
        <form id="multi-step-form" method="POST" enctype="multipart/form-data">
            <p class="honeypot-field"><label for="user_website">Website</label><input type="text" name="user_website" id="user_website" value="" tabindex="-1" autocomplete="off"></p>

            <!-- Step 1: Account Type & 1st Investor -->
            <div class="form-step active" data-step="1">
                <h4 class="form-section-title"><?php echo ziada_get_string('account_type'); ?></h4>
                <div class="form-group">
                    <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="account_type" id="acc_individual" value="individual" checked><label class="form-check-label" for="acc_individual"><?php echo ziada_get_string('individual'); ?></label></div>
                    <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="account_type" id="acc_joint" value="joint"><label class="form-check-label" for="acc_joint"><?php echo ziada_get_string('joint'); ?></label></div>
                    <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="account_type" id="acc_company" value="company"><label class="form-check-label" for="acc_company"><?php echo ziada_get_string('company'); ?></label></div>
                    <div class="form-check form-check-inline"><input class="form-check-input" type="radio" name="account_type" id="acc_minor" value="minor"><label class="form-check-label" for="acc_minor"><?php echo ziada_get_string('minor'); ?></label></div>
                </div>
                <h4 class="form-section-title"><?php echo ziada_get_string('investor_1_info'); ?></h4>
                <div class="row">
                    <div class="col-md-4 form-group"><label for="fname_1"><?php echo ziada_get_string('first_name'); ?></label><input type="text" class="form-control" id="fname_1" name="fname_1" required></div>
                    <div class="col-md-4 form-group"><label for="mname_1"><?php echo ziada_get_string('middle_name'); ?></label><input type="text" class="form-control" id="mname_1" name="mname_1"></div>
                    <div class="col-md-4 form-group"><label for="lname_1"><?php echo ziada_get_string('last_name'); ?></label><input type="text" class="form-control" id="lname_1" name="lname_1" required></div>
                </div>
                <div class="form-group"><label for="primary_user_photo"><?php echo ziada_get_string('photo'); ?></label><input type="file" class="form-control-file" id="primary_user_photo" name="primary_user_photo" accept="image/*"></div>
                <div class="btn-wrapper"><button type="button" class="btn btn-primary next-step"><?php echo ziada_get_string('next'); ?></button></div>
            </div>

            <!-- Other Steps with all fields -->

            <div class="form-step" data-step="5">
                <h4 class="form-section-title"><?php echo ziada_get_string('declaration'); ?></h4>
                <div class="form-group form-check"><input type="checkbox" class="form-check-input" id="declaration" name="declaration" required><label class="form-check-label" for="declaration"><?php echo ziada_get_string('declaration_text'); ?></label></div>
                <div class="btn-wrapper"><button type="button" class="btn btn-secondary prev-step"><?php echo ziada_get_string('prev'); ?></button><button type="submit" class="btn btn-success"><?php echo ziada_get_string('submit'); ?></button></div>
            </div>
        </form>
        <div id="form-messages" class="mt-3"></div>
    </div>
</div>