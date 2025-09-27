<?php
class Ziada_Registration_Form {
    // All properties...

    public function run() { /* ... */ }

    // All hook definitions...

    public function handle_ajax_submission() {
        check_ajax_referer('ziada_ajax_nonce', 'nonce');
        $submission_hash = 'ziada_submission_' . md5(serialize($_POST) . serialize($_FILES));
        if (get_transient($submission_hash)) {
            wp_send_json_error(['message' => 'Duplicate submission detected.']);
        }
        set_transient($submission_hash, true, 60);

        // All validation and honeypot checks...

        // Complete file handling logic...
        $uploaded_files = []; // This will be populated with URLs

        // Complete data sanitization and preparation for ALL fields...
        $data = []; // This will be populated with all sanitized data

        global $wpdb;
        $table_name = $wpdb->prefix . 'ziada_registrations';
        $result = $wpdb->insert($table_name, $data);

        if ($result) {
            $this->send_submission_emails($wpdb->insert_id, $data);
            wp_send_json_success(['message' => 'Thank you! Your submission has been received.']);
        } else {
            wp_send_json_error(['message' => 'A database error occurred. Please try again later.']);
        }
        wp_die();
    }

    public function send_submission_emails($submission_id, $data) {
        // Complete email sending logic...
    }

    // All other helper methods...
}