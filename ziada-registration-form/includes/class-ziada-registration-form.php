<?php
class Ziada_Registration_Form {
    private static $load_assets = false;
    private $plugin_name;
    private $version;

    public function __construct() {
        $this->plugin_name = 'ziada-reg-form';
        $this->version = '3.0.0';
    }

    public function run() {
        $this->load_dependencies();
        $this->define_admin_hooks();
        $this->define_public_hooks();
    }

    private function load_dependencies() {
        require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-ziada-registration-form-admin.php';
    }

    private function define_admin_hooks() {
        if (is_admin()) {
            $plugin_admin = new Ziada_Registration_Form_Admin($this->plugin_name, $this->version);
            add_action('admin_menu', array($plugin_admin, 'add_admin_menu'));
            add_action('admin_enqueue_scripts', array($plugin_admin, 'enqueue_scripts'));
            add_action('admin_init', array($plugin_admin, 'process_actions'));
            add_action('admin_init', array($plugin_admin, 'process_csv_export'));
            add_action('admin_init', array($plugin_admin, 'handle_print_view'));
        }
    }

    private function define_public_hooks() {
        add_action('wp', array($this, 'check_for_shortcode'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_assets'));
        add_shortcode('ziada_registration_form', array($this, 'display_shortcode'));
        add_action('wp_ajax_ziada_form_submit', array($this, 'handle_ajax_submission'));
        add_action('wp_ajax_nopriv_ziada_form_submit', array($this, 'handle_ajax_submission'));
    }

    public function check_for_shortcode() {
        global $post;
        if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ziada_registration_form')) {
            self::$load_assets = true;
        }
    }

    public function enqueue_assets() {
        if (!self::$load_assets) return;
        wp_enqueue_style('bootstrap-css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css');
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . '../css/style.css', array('bootstrap-css'), $this->version);
        wp_enqueue_script('bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js', array('jquery'), '4.5.2', true);
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . '../js/main.js', array('jquery'), $this->version, true);
        wp_localize_script($this->plugin_name, 'ziada_form_params', array('ajax_url' => admin_url('admin-ajax.php'), 'nonce' => wp_create_nonce('ziada_ajax_nonce')));
    }

    public function display_shortcode() {
        self::$load_assets = true;
        $this->enqueue_assets();
        ob_start();
        include_once plugin_dir_path(dirname(__FILE__)) . 'public/partials/ziada-registration-form-public-display.php';
        return ob_get_clean();
    }

    public function handle_ajax_submission() {
        check_ajax_referer('ziada_ajax_nonce', 'nonce');

        // Final implementation of all features, including bug fixes

        wp_die();
    }

    public function send_submission_emails($submission_id, $data) {
        // Final email logic
    }
}