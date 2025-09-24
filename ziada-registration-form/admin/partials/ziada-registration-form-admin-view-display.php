<?php
/**
 * Provides the detailed view of a single registration submission.
 *
 * This file is included from class-ziada-registration-form-admin.php.
 * It expects the $submission variable to be in scope.
 *
 * @package    Ziada_Reg_Form
 * @subpackage Ziada_Reg_Form/admin/partials
 */

if ( ! defined( 'WPINC' ) ) {
    die;
}

// Helper function to display a section from JSON data
function display_key_value_section($title, $json_data) {
    if (empty($json_data)) return;
    $data = json_decode($json_data, true);
    if (empty($data) || !is_array($data)) return;

    echo '<h3>' . esc_html($title) . '</h3>';
    echo '<table class="form-table">';
    foreach ($data as $key => $value) {
        // Don't display empty values
        if (empty($value)) continue;

        echo '<tr>';
        echo '<th scope="row">' . esc_html(ucwords(str_replace('_', ' ', $key))) . '</th>';
        // Handle array values, e.g. for income source
        if (is_array($value)) {
            echo '<td>' . esc_html(implode(', ', $value)) . '</td>';
        } else {
            echo '<td>' . esc_html($value) . '</td>';
        }
        echo '</tr>';
    }
    echo '</table>';
}

?>
<div class="wrap">
    <h1>View Submission Details</h1>

    <a href="<?php echo esc_url(admin_url('admin.php?page=' . $_GET['page'])); ?>" class="button">&larr; Back to All Submissions</a>

    <?php if (isset($submission) && $submission) : ?>
        <div id="poststuff">
            <div id="post-body" class="metabox-holder columns-2">
                <!-- Main content -->
                <div id="post-body-content">
                    <div class="meta-box-sortables ui-sortable">
                        <div class="postbox">
                            <h2 class="hndle"><span>Primary Applicant Information</span></h2>
                            <div class="inside">
                                <table class="form-table">
                                    <tr><th scope="row">Submission ID</th><td><?php echo esc_html($submission->id); ?></td></tr>
                                    <tr><th scope="row">Date Submitted</th><td><?php echo esc_html($submission->created_at); ?></td></tr>
                                    <tr><th scope="row">Account Type</th><td><?php echo esc_html($submission->account_type); ?></td></tr>
                                    <tr><th scope="row">Full Name</th><td><?php echo esc_html($submission->fname_1 . ' ' . $submission->mname_1 . ' ' . $submission->lname_1); ?></td></tr>
                                    <tr><th scope="row">Date of Birth</th><td><?php echo esc_html($submission->dob_1); ?></td></tr>
                                    <tr><th scope="row">Gender</th><td><?php echo esc_html($submission->gender_1); ?></td></tr>
                                    <tr><th scope="row">Nationality</th><td><?php echo esc_html($submission->nationality_1); ?></td></tr>
                                    <tr><th scope="row">ID Type</th><td><?php echo esc_html($submission->id_type_1); ?></td></tr>
                                    <tr><th scope="row">ID Number</th><td><?php echo esc_html($submission->id_number_1); ?></td></tr>
                                    <tr><th scope="row">Mobile Phone</th><td><?php echo esc_html($submission->mobile_1); ?></td></tr>
                                    <tr><th scope="row">Email Address</th><td><?php echo esc_html($submission->email_1); ?></td></tr>
                                </table>
                            </div>
                        </div>

                        <div class="postbox">
                            <div class="inside">
                                <?php
                                // Display conditional sections
                                display_key_value_section('2nd Investor Information', $submission->investor_2_info);
                                display_key_value_section('Company Information', $submission->company_info);
                                display_key_value_section('Parent/Guardian Information', $submission->guardian_info);

                                // Display other sections
                                display_key_value_section('Contact Information', $submission->contact_info);
                                display_key_value_section('Bank Details', $submission->bank_details);
                                display_key_value_section('Source of Income', $submission->income_source);

                                // Custom display for Nominees
                                $nominees = json_decode($submission->nominees, true);
                                if (!empty($nominees)) {
                                    echo '<h3>Nominees</h3>';
                                    foreach($nominees as $i => $nominee) {
                                        echo '<h4>Nominee ' . ($i + 1) . '</h4>';
                                        echo '<table class="form-table">';
                                        foreach($nominee as $key => $value) {
                                            echo '<tr><th scope="row">' . esc_html(ucwords($key)) . '</th><td>' . esc_html($value) . '</td></tr>';
                                        }
                                        echo '</table>';
                                    }
                                }

                                display_key_value_section('Payment Details', $submission->payment_details);
                                ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <br class="clear">
        </div>
    <?php else : ?>
        <p>Submission not found.</p>
    <?php endif; ?>
</div>
