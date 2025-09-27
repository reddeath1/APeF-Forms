<?php
function ziada_display_details_section($title, $data) {
    if (empty($data)) return;
    if (is_string($data)) $data = json_decode($data, true);
    if (empty($data) || !is_array($data)) return;

    echo '<div class="postbox"><h2 class="hndle"><span>' . esc_html($title) . '</span></h2><div class="inside"><table class="form-table">';
    foreach ($data as $key => $value) {
        if (empty($value) || strpos($key, 'photo') !== false) continue;
        echo '<tr><th scope="row">' . esc_html(ucwords(str_replace('_', ' ', $key))) . '</th><td>';
        echo is_array($value) ? esc_html(implode(', ', $value)) : esc_html($value);
        echo '</td></tr>';
    }
    echo '</table></div></div>';
}
?>
<div class="wrap">
    <h1>View Submission #<?php echo esc_html($submission->id); ?> <a href="<?php echo esc_url(wp_nonce_url(admin_url('admin.php?page=' . $_REQUEST['page'] . '&action=print&registration=' . $submission->id), 'ziada_print_nonce')); ?>" target="_blank" class="page-title-action">Print / PDF</a></h1>
    <a href="<?php echo esc_url(admin_url('admin.php?page=' . $_REQUEST['page'])); ?>" class="button">&larr; Back to Submissions</a>

    <?php if (isset($submission)) : ?>
    <div id="poststuff" style="margin-top: 20px;">
        <div id="post-body" class="metabox-holder columns-2">
            <div id="post-body-content">
                <div class="postbox">
                    <h2 class="hndle"><span>Primary Applicant Information</span></h2>
                    <div class="inside">
                        <?php if (!empty($submission->primary_user_photo)) : ?>
                            <img src="<?php echo esc_url($submission->primary_user_photo); ?>" style="max-width: 150px; height: auto; float: right; margin: 0 0 10px 15px; border: 1px solid #ddd; padding: 4px;">
                        <?php endif; ?>
                        <table class="form-table">
                            <!-- All primary applicant fields -->
                        </table>
                    </div>
                </div>
                <?php
                ziada_display_details_section("2nd Investor Information", $submission->investor_2_info);
                ziada_display_details_section("Company Information", $submission->company_info);
                ziada_display_details_section("Parent/Guardian Information", $submission->guardian_info);
                ziada_display_details_section("Contact Information", $submission->contact_info);
                ziada_display_details_section("Bank Details", $submission->bank_details);
                ziada_display_details_section("Source of Income", $submission->income_source);
                ziada_display_details_section("Payment Details", $submission->payment_details);
                // Custom display for nominees with photos
                ?>
            </div>
            <div id="postbox-container-1" class="postbox-container">
                <!-- Sidebar can go here if needed -->
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>