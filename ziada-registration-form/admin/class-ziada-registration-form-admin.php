<?php
/**
 * The admin-specific functionality of the plugin.
 * @link       https://owesis.com
 * @author     Frank Galos
 */
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
        add_menu_page('Ziada', 'Ziada', 'manage_options', $this->plugin_name, array($this, 'display_submissions_list_page'), 'dashicons-list-view', 25);
        add_submenu_page($this->plugin_name, 'Submissions', 'Submissions', 'manage_options', $this->plugin_name, array($this, 'display_submissions_list_page'));
        add_submenu_page($this->plugin_name, 'Settings', 'Settings', 'manage_options', $this->plugin_name . '-settings', array($this, 'display_settings_page'));
        add_submenu_page($this->plugin_name, 'About', 'About', 'manage_options', $this->plugin_name . '-about', array($this, 'display_about_page'));
    }

    public function register_settings() {
        register_setting('ziada_settings_group', 'ziada_form_language', ['sanitize_callback' => 'sanitize_text_field']);
    }

    public function display_settings_page() { include_once 'partials/ziada-registration-form-admin-settings-display.php'; }
    public function display_about_page() { include_once 'partials/ziada-registration-form-admin-about-display.php'; }

    public function display_submissions_list_page() {
        $action = isset($_GET['action']) ? sanitize_key($_GET['action']) : 'list';
        if ('view' === $action) {
            $this->display_single_submission_page();
        } else {
            require_once 'class-ziada-registrations-list-table.php';
            $list_table = new Ziada_Registrations_List_Table();
            $list_table->prepare_items();
            ?>
            <div class="wrap">
                <h1>Submissions <a href="<?php echo esc_url(wp_nonce_url(add_query_arg(['action' => 'export_csv']), 'ziada_export_nonce')); ?>" class="page-title-action">Export to CSV</a></h1>
                <?php if (isset($_GET['message']) && $_GET['message'] == 'deleted') { echo '<div class="notice notice-success is-dismissible"><p>Submission(s) deleted.</p></div>'; } ?>
                <form method="post">
                    <input type="hidden" name="page" value="<?php echo esc_attr($_REQUEST['page']); ?>" />
                    <?php $list_table->search_box('Search', 'submission'); $list_table->display(); ?>
                </form>
            </div>
            <?php
        }
    }

    private function display_single_submission_page() {
        global $wpdb;
        $id = isset($_GET['registration']) ? absint($_GET['registration']) : 0;
        $submission = $wpdb->get_row($wpdb->prepare("SELECT * FROM {$wpdb->prefix}ziada_registrations WHERE id = %d", $id));
        include_once 'partials/ziada-registration-form-admin-view-display.php';
    }

    public function process_actions() {
        $action = $this->current_action();
        if ('delete' === $action) {
            check_admin_referer('ziada_delete_submission');
            if (current_user_can('manage_options')) {
                global $wpdb; $wpdb->delete($wpdb->prefix . 'ziada_registrations', ['id' => absint($_GET['registration'])]);
                wp_safe_redirect(admin_url('admin.php?page=' . $this->plugin_name . '&message=deleted')); exit;
            }
        }
        if ('bulk-delete' === $action) {
            check_admin_referer('bulk-submissions');
            if (current_user_can('manage_options') && !empty($_POST['registration'])) {
                global $wpdb; $ids = array_map('absint', $_POST['registration']);
                $ids_sql = implode(',', $ids);
                $wpdb->query("DELETE FROM {$wpdb->prefix}ziada_registrations WHERE id IN($ids_sql)");
                wp_safe_redirect(admin_url('admin.php?page=' . $this->plugin_name . '&message=deleted')); exit;
            }
        }
    }

    public function process_csv_export() { /* ... CSV export logic ... */ }
    public function handle_print_view() { /* ... Print view logic ... */ }
}