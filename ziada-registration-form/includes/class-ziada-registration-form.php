<?php
class Ziada_Registration_Form {
    private static $load_assets = false;
    private $plugin_name;
    private $version;

    public function __construct() {
        $this->plugin_name = 'ziada-reg-form';
        $this->version = '4.0.0';
    }

    public function run() {
        $this->load_dependencies();
        $this->define_admin_hooks();
        $this->define_public_hooks();
    }

    private function load_dependencies() {
        require_once plugin_dir_path(__FILE__) . 'ziada-language-helper.php';
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-ziada-registration-form-admin.php';
    }

    private function define_admin_hooks() {
        if (is_admin()) {
            $plugin_admin = new Ziada_Registration_Form_Admin($this->plugin_name, $this->version);
            add_action('admin_menu', array($plugin_admin, 'add_admin_menu'));
            add_action('admin_init', array($plugin_admin, 'register_settings'));
            // ... all other admin hooks
        }
    }

    private function define_public_hooks() {
        add_action('wp', array($this, 'check_for_shortcode'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_assets'));
        add_shortcode('ziada_registration_form', array($this, 'display_shortcode'));
        add_action('wp_ajax_ziada_form_submit', array($this, 'handle_ajax_submission'));
        add_action('wp_ajax_nopriv_ziada_form_submit', array($this, 'handle_ajax_submission'));
    }

    public function handle_ajax_submission() {
        check_ajax_referer('ziada_ajax_nonce', 'nonce');

        // Fix for duplicate entry bug
        $submission_hash = 'ziada_submission_' . md5(serialize($_POST));
        if (get_transient($submission_hash)) {
            wp_send_json_error(['message' => 'Duplicate submission detected.']);
        }
        set_transient($submission_hash, true, 60);

        // All data sanitization and processing, including bank details fix and photo uploads
        // ...

        global $wpdb;
        $table_name = $wpdb->prefix . 'ziada_registrations';
        $result = $wpdb->insert($table_name, $data);

        if ($result) {
            $this->send_submission_emails($wpdb->insert_id, $data);
            wp_send_json_success(['message' => 'Thank you! Your submission has been received.']);
        } else {
            wp_send_json_error(['message' => 'A database error occurred. Please try again.']);
        }

        wp_die();
    }

    // ... all other methods like enqueue_assets, display_shortcode, send_submission_emails
}