<?php
class Ziada_Registration_Form_Admin {
    private $plugin_name;
    private $version;

    public function __construct($plugin_name, $version) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    // All admin methods, including:
    // - add_admin_menu()
    // - register_settings()
    // - display_settings_page()
    // - display_submissions_list_page()
    // - display_single_submission_page()
    // - process_actions() (for delete/bulk-delete)
    // - process_csv_export()
    // - handle_print_view()
}