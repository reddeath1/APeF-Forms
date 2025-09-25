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
        add_submenu_page($this->plugin_name, 'About', 'About', 'manage_options', $this->plugin_name . '-about', array($this, 'display_about_page'));
    }

    public function display_about_page() {
        include_once 'partials/ziada-registration-form-admin-about-display.php';
    }

    public function display_plugin_admin_page() {
        if (isset($_GET['message'])) {
            add_action('admin_notices', function() { echo '<div class="notice notice-success is-dismissible"><p>Action completed successfully.</p></div>'; });
        }
        $action = isset($_GET['action']) ? sanitize_key($_GET['action']) : 'list';
        if ('view' === $action) {
            $this->display_single_submission_page();
        } else {
            $this->display_submissions_list_page();
        }
    }

    private function display_submissions_list_page() {
        require_once 'class-ziada-registrations-list-table.php';
        $list_table = new Ziada_Registrations_List_Table();
        $list_table->prepare_items();
        ?>
        <div class="wrap">
            <h1>Submissions <a href="<?php echo esc_url(wp_nonce_url(admin_url('admin.php?page=' . $this->plugin_name . '&action=export_csv'), 'ziada_export_nonce')); ?>" class="page-title-action">Export to CSV</a></h1>
            <form method="post">
                <?php
                $list_table->search_box('Search', 'submission');
                $list_table->display();
                ?>
            </form>
        </div>
        <?php
    }

    private function display_single_submission_page() {
        $registration_id = isset($_GET['registration']) ? absint($_GET['registration']) : 0;
        global $wpdb;
        $table_name = $wpdb->prefix . 'ziada_registrations';
        $submission = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table_name WHERE id = %d", $registration_id));
        include_once 'partials/ziada-registration-form-admin-view-display.php';
    }

    public function process_actions() {
        // Single delete
        if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['_wpnonce'])) {
            if (wp_verify_nonce($_GET['_wpnonce'], 'ziada_delete_submission') && current_user_can('manage_options')) {
                global $wpdb; $wpdb->delete($wpdb->prefix . 'ziada_registrations', array('id' => absint($_GET['registration'])));
                wp_safe_redirect(admin_url('admin.php?page=' . $this->plugin_name . '&message=deleted')); exit;
            }
        }
        // Bulk delete
        if ((isset($_POST['action']) && $_POST['action'] == 'bulk-delete') || (isset($_POST['action2']) && $_POST['action2'] == 'bulk-delete')) {
            if (isset($_POST['_wpnonce']) && wp_verify_nonce($_POST['_wpnonce'], 'bulk-submissions') && current_user_can('manage_options')) {
                global $wpdb; $ids = array_map('absint', $_POST['registration']);
                if (!empty($ids)) {
                    $ids_sql = implode(',', $ids);
                    $wpdb->query("DELETE FROM {$wpdb->prefix}ziada_registrations WHERE id IN($ids_sql)");
                    wp_safe_redirect(admin_url('admin.php?page=' . $this->plugin_name . '&message=deleted')); exit;
                }
            }
        }
    }

    public function process_csv_export() {
        // ... (CSV export logic)
    }

    public function handle_print_view() {
        // ... (Print view logic)
    }
}