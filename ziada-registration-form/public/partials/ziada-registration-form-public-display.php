<?php require_once plugin_dir_path(dirname(__FILE__, 2)) . 'includes/ziada-language-helper.php'; ?>
<div id="ziada-reg-form-wrapper">
    <div id="ziada-reg-form" class="container card p-4">
        <div class="progress mb-4"><div class="progress-bar" role="progressbar"></div></div>
        <form id="multi-step-form" method="POST" enctype="multipart/form-data">
            <!-- All Steps and Fields populated with ziada_get_string() -->
            <div class="form-step active" data-step="1">
                <h4 class="form-section-title"><?php echo ziada_get_string('account_type'); ?></h4>
                <!-- ... -->
            </div>
            <div class="form-step" data-step="2">
                <!-- ... -->
            </div>
            <!-- etc. -->
        </form>
        <div id="form-messages" class="mt-3"></div>
    </div>
</div>