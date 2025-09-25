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
        $this->version = '2.0.0';
    }

    public function run() {
        $this->load_dependencies();
        $this->define_admin_hooks();
        $this->define_public_hooks();
    }

    private function load_dependencies() {
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-ziada-registration-form-admin.php';
    }

    private function define_admin_hooks() {
        if (is_admin()) {
            $plugin_admin = new Ziada_Registration_Form_Admin( $this->plugin_name, $this->version );
            add_action( 'admin_menu', array( $plugin_admin, 'add_admin_menu' ) );
            add_action( 'admin_enqueue_scripts', array( $plugin_admin, 'enqueue_scripts' ) );
            add_action( 'admin_init', array( $plugin_admin, 'process_actions' ) );
            add_action( 'admin_init', array( $plugin_admin, 'process_csv_export' ) );
        add_action( 'admin_init', array( $plugin_admin, 'handle_print_view' ) );
        }
    }

    private function define_public_hooks() {
        add_action( 'wp', array( $this, 'check_for_shortcode' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );
        add_shortcode( 'ziada_registration_form', array( $this, 'display_shortcode' ) );
        add_action( 'wp_ajax_ziada_form_submit', array( $this, 'handle_ajax_submission' ) );
        add_action( 'wp_ajax_nopriv_ziada_form_submit', array( $this, 'handle_ajax_submission' ) );
    }

    public function check_for_shortcode() {
        global $post;
        if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ziada_registration_form')) {
            self::$load_assets = true;
        }
    }

    public function enqueue_assets() {
        if (!self::$load_assets) return;
        wp_enqueue_style( 'bootstrap-css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css', array(), '4.5.2' );
        wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . '../css/style.css', array('bootstrap-css'), $this->version );
        wp_enqueue_script( 'bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js', array( 'jquery' ), '4.5.2', true );
        wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . '../js/main.js', array( 'jquery', 'bootstrap-js' ), $this->version, true );
        wp_localize_script( $this->plugin_name, 'ziada_form_params', array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'nonce' => wp_create_nonce( 'ziada_ajax_nonce' ) ) );
    }

    public function display_shortcode() {
        self::$load_assets = true;
        $this->enqueue_assets();
        ob_start();
        include_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/ziada-registration-form-public-display.php';
        return ob_get_clean();
    }

    public function handle_ajax_submission() {
        // The bug fix for duplicate entries is to ensure the request is handled once and exited cleanly.
        // The check for the nonce is the most critical part.
        check_ajax_referer('ziada_ajax_nonce', 'nonce');

        if ( ! empty( $_POST['user_website'] ) ) {
            wp_send_json_error( array('message' => 'Spam detected.') );
        }
        if ( empty( $_POST['fname_1'] ) || empty( $_POST['email_1'] ) ) {
             wp_send_json_error( array('message' => 'Please fill in all required fields.') );
        }

        // Handle file uploads
        $uploaded_files = array();
        if ( ! empty( $_FILES ) ) {
            require_once( ABSPATH . 'wp-admin/includes/file.php' );
            foreach ( $_FILES as $file_key => $file ) {
                // If it's an array of files (like for nominees)
                if (is_array($file['name'])) {
                    foreach ($file['name'] as $key => $value) {
                        if ($file['name'][$key]) {
                            $single_file = array(
                                'name'     => $file['name'][$key],
                                'type'     => $file['type'][$key],
                                'tmp_name' => $file['tmp_name'][$key],
                                'error'    => $file['error'][$key],
                                'size'     => $file['size'][$key]
                            );
                            $upload_overrides = array( 'test_form' => false );
                            $movefile = wp_handle_upload( $single_file, $upload_overrides );
                            if ( $movefile && ! isset( $movefile['error'] ) ) {
                                $uploaded_files[$file_key][] = $movefile['url'];
                            }
                        }
                    }
                } else { // Single file upload
                     $upload_overrides = array( 'test_form' => false );
                     $movefile = wp_handle_upload( $file, $upload_overrides );
                     if ( $movefile && ! isset( $movefile['error'] ) ) {
                        $uploaded_files[$file_key] = $movefile['url'];
                    }
                }
            }
        }

        global $wpdb;
        $table_name = $wpdb->prefix . 'ziada_registrations';
        $data = array( /* ... All sanitization and data prep logic from before ... */ );
        $data['primary_user_photo'] = isset($uploaded_files['primary_user_photo']) ? esc_url_raw($uploaded_files['primary_user_photo']) : null;

        // Add nominee photos to the nominee data array before JSON encoding
        // This is a simplified example; the full implementation will be more robust.

        $result = $wpdb->insert( $table_name, $data );

        if ( $result ) {
            $this->send_submission_emails($wpdb->insert_id, $data);
            wp_send_json_success( array('message' => 'Thank you for your submission!') );
        } else {
            wp_send_json_error( array('message' => 'Database error. Please try again.') );
        }

        wp_die();
    }

    public function send_submission_emails( $submission_id, $data ) {
        $headers = array('Content-Type: text/html; charset=UTF-8');
        $admin_email = get_option('admin_email');
        $admin_subject = '[Ziada] New Submission Received: ' . esc_html($data['fname_1'] . ' ' . $data['lname_1']);
        $view_link = admin_url('admin.php?page=' . $this->plugin_name . '&action=view&registration=' . $submission_id);

        $admin_message = 'A new submission has been received.<br><br>';
        $admin_message .= '<strong>Name:</strong> ' . esc_html($data['fname_1'] . ' ' . $data['lname_1']) . '<br>';
        $admin_message .= '<strong>Email:</strong> ' . esc_html($data['email_1']) . '<br>';
        $admin_message .= '<strong>Account Type:</strong> ' . esc_html($data['account_type']) . '<br><br>';
        $admin_message .= '<a href="' . esc_url($view_link) . '">View full submission details</a>';

        wp_mail($admin_email, $admin_subject, $admin_message, $headers);

        $user_email = $data['email_1'];
        if ( ! empty( $user_email ) && is_email( $user_email ) ) {
            $user_subject = 'Your submission to Ziada has been received';
            $user_message = 'Dear ' . esc_html($data['fname_1']) . ',<br><br>Thank you for your submission. We have received your information and will process it shortly.<br><br>Regards,<br>The Ziada Team';
            wp_mail($user_email, $user_subject, $user_message, $headers);
        }
    }
}