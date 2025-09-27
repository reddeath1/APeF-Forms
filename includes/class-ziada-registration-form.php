<?php
/**
 * The core plugin class.
 * @link       https://owesis.com
 * @author     Frank Galos
 */
class Ziada_Registration_Form {
    private static $load_assets = false;
    private $plugin_name;
    private $version;

    public function __construct() {
        $this->plugin_name = 'ziada-reg-form';
        $this->version = '1.0.0';
    }

    public function run() {
        $this->load_dependencies();
        $this->define_admin_hooks();
        $this->define_public_hooks();
    }

    private function load_dependencies() {
        require_once plugin_dir_path(__FILE__) . 'ziada-language-helper.php';
        if (is_admin()) {
            require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-ziada-registration-form-admin.php';
        }
    }

    private function define_admin_hooks() {
        if (is_admin()) {
            $plugin_admin = new Ziada_Registration_Form_Admin($this->plugin_name, $this->version);
            add_action('admin_menu', array($plugin_admin, 'add_admin_menu'));
            add_action('admin_init', array($plugin_admin, 'register_settings'));
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
        wp_enqueue_style('bootstrap-css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css', [], '4.5.2');
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . '../css/style.css', ['bootstrap-css'], $this->version);
        wp_enqueue_script('bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js', ['jquery'], '4.5.2', true);
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . '../js/main.js', ['jquery', 'bootstrap-js'], $this->version, true);
        wp_localize_script($this->plugin_name, 'ziada_form_params', ['ajax_url' => admin_url('admin-ajax.php'), 'nonce' => wp_create_nonce('ziada_ajax_nonce')]);
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

        $submission_hash = 'ziada_submission_' . md5(serialize($_POST));
        if (get_transient($submission_hash)) {
            wp_send_json_error(['message' => 'Duplicate submission detected. Please wait a moment before trying again.']);
        }
        set_transient($submission_hash, true, 60);

        if ( ! empty( $_POST['user_website'] ) ) {
            wp_send_json_error(['message' => 'Spam detected.']);
        }
        if (empty($_POST['fname_1']) || empty($_POST['email_1'])) {
             wp_send_json_error(['message' => 'Please fill in all required fields.']);
        }

        // Handle file uploads first
        $uploaded_files = [];
        if (!empty($_FILES)) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
            // Handle primary photo
            if (isset($_FILES['primary_user_photo']) && $_FILES['primary_user_photo']['size'] > 0) {
                $movefile = wp_handle_upload($_FILES['primary_user_photo'], ['test_form' => false]);
                if ($movefile && !isset($movefile['error'])) {
                    $uploaded_files['primary_user_photo'] = $movefile['url'];
                }
            }
            // Handle nominee photos
            if (isset($_FILES['nominee_photos'])) {
                $nominee_files = $_FILES['nominee_photos'];
                foreach ($nominee_files['name'] as $key => $value) {
                    if ($nominee_files['name'][$key]) {
                        $file = ['name' => $nominee_files['name'][$key], 'type' => $nominee_files['type'][$key], 'tmp_name' => $nominee_files['tmp_name'][$key], 'error' => $nominee_files['error'][$key], 'size' => $nominee_files['size'][$key]];
                        $movefile = wp_handle_upload($file, ['test_form' => false]);
                        if ($movefile && !isset($movefile['error'])) {
                            $uploaded_files['nominees'][$key] = $movefile['url'];
                        }
                    }
                }
            }
        }

        // Sanitize and prepare data
        $data = []; // All data will be built here
        // ... (Full data sanitization and preparation logic for all fields)

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

    public function send_submission_emails($submission_id, $data) {
        // Final email logic
    }
}