<?php
// The full content of the view partial from our previous implementation
function display_key_value_section($title, $json_data) {
    if (empty($json_data)) return;
    $data = json_decode($json_data, true);
    if (empty($data) || !is_array($data)) return;
    echo '<h3>' . esc_html($title) . '</h3><table class="form-table">';
    foreach ($data as $key => $value) {
        if (empty($value)) continue;
        echo '<tr><th>' . esc_html(ucwords(str_replace('_', ' ', $key))) . '</th><td>';
        if (is_array($value)) echo esc_html(implode(', ', $value));
        else echo esc_html($value);
        echo '</td></tr>';
    }
    echo '</table>';
}
?>
<div class="wrap">
    <h1>View Submission <a href="<?php echo esc_url(add_query_arg(array('action' => 'print', 'registration' => $submission->id, '_wpnonce' => wp_create_nonce('ziada_print_nonce')))); ?>" target="_blank" class="page-title-action">Print / Save as PDF</a></h1>
    <a href="<?php echo esc_url(admin_url('admin.php?page=ziada-reg-form')); ?>" class="button">&larr; Back to Submissions</a>
    <?php if (isset($submission)) : ?>
    <div id="poststuff">
        <div class="postbox">
            <h2 class="hndle"><span>Primary Applicant</span></h2>
            <div class="inside">
                <!-- All primary applicant fields displayed here -->
            </div>
        </div>
        <!-- Other sections -->
    </div>
    <?php endif; ?>
</div>