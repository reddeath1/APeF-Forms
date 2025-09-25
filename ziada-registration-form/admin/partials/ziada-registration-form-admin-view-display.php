<?php
// Helper function to display a section from JSON data
function display_key_value_section($title, $json_data) {
    if (empty($json_data)) return;
    $data = json_decode($json_data, true);
    if (empty($data) || !is_array($data)) return;
    echo '<h3>' . esc_html($title) . '</h3><table class="form-table">';
    foreach ($data as $key => $value) {
        if (empty($value)) continue;
        echo '<tr><th scope="row">' . esc_html(ucwords(str_replace('_', ' ', $key))) . '</th><td>';
        if (is_array($value)) {
            echo esc_html(implode(', ', $value));
        } else {
            echo esc_html($value);
        }
        echo '</td></tr>';
    }
    echo '</table>';
}
?>
<div class="wrap">
    <h1>View Submission #<?php echo $submission->id; ?> <a href="<?php echo esc_url(wp_nonce_url(admin_url('admin.php?page=ziada-reg-form&action=print&registration=' . $submission->id), 'ziada_print_nonce')); ?>" target="_blank" class="page-title-action">Print / PDF</a></h1>
    <a href="<?php echo admin_url('admin.php?page=ziada-reg-form'); ?>" class="button">&larr; Back to Submissions</a>

    <?php if (isset($submission)) : ?>
    <div id="poststuff" style="margin-top: 20px;">
        <div class="postbox">
            <h2 class="hndle"><span>Primary Applicant Information</span></h2>
            <div class="inside">
                <?php if ($submission->primary_user_photo) : ?>
                    <img src="<?php echo esc_url($submission->primary_user_photo); ?>" style="max-width: 150px; height: auto; float: right; margin-left: 15px;">
                <?php endif; ?>
                <table class="form-table">
                    <!-- Rows for all primary applicant fields -->
                </table>
            </div>
        </div>
        <?php
        // Display all other sections using the helper function
        display_key_value_section('2nd Investor Information', $submission->investor_2_info);
        // ... and so on for all other sections
        ?>
    </div>
    <?php endif; ?>
</div>