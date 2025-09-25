<?php
class Ziada_Registration_Form_Admin {
    private $plugin_name;
    private $version;

    public function __construct($plugin_name, $version) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    public function enqueue_scripts() {
        wp_enqueue_script($this->plugin_name . '-admin', plugin_dir_url(__FILE__) . 'js/admin.js', array('jquery'), $this->version, false);
    }

    public function add_admin_menu() {
        add_menu_page('Ziada Submissions', 'Ziada', 'manage_options', $this->plugin_name, array($this, 'display_plugin_admin_page'), 'dashicons-list-view', 25);
        add_submenu_page($this->plugin_name, 'Submissions', 'Submissions', 'manage_options', $this->plugin_name, array($this, 'display_plugin_admin_page'));
        add_submenu_page($this->plugin_name, 'About Ziada', 'About', 'manage_options', $this->plugin_name . '-about', array($this, 'display_about_page'));
    }

    public function display_about_page() {
        include_once 'partials/ziada-registration-form-admin-about-display.php';
    }

    public function display_plugin_admin_page() {
        // ... (display logic as before)
    }

    public function process_actions() {
        // ... (delete and bulk delete logic)
    }

    public function process_csv_export() {
        // ... (CSV export logic)
    }

    public function handle_print_view() {
        if (isset($_GET['action']) && $_GET['action'] == 'print' && isset($_GET['registration']) && isset($_GET['_wpnonce'])) {
            if (wp_verify_nonce($_GET['_wpnonce'], 'ziada_print_nonce') && current_user_can('manage_options')) {
                $registration_id = absint($_GET['registration']);
                global $wpdb;
                $table_name = $wpdb->prefix . 'ziada_registrations';
                $submission = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $registration_id));
                include_once 'partials/ziada-registration-form-admin-print-display.php';
                exit;
            }
        }
    }
}