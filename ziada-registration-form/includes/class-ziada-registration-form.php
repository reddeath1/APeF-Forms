<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://owesis.com
 * @since      1.0.0
 *
 * @package    Ziada_Reg_Form
 * @subpackage Ziada_Reg_Form/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Ziada_Reg_Form
 * @subpackage Ziada_Reg_Form/includes
 * @author     Frank Galos
 */
class Ziada_Registration_Form {

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      Ziada_Registration_Form_Loader    $loader    Maintains and registers all hooks for the plugin.
     */
    protected $loader;

    /**
     * The unique identifier of this plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $plugin_name    The string used to uniquely identify this plugin.
     */
    protected $plugin_name;

    /**
     * The current version of the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      string    $version    The current version of the plugin.
     */
    protected $version;

    /**
     * A flag to check if the shortcode is present on the page.
     *
     * @since    1.0.0
     * @access   private
     * @var      boolean
     */
    private static $load_assets = false;

    /**
     * Define the core functionality of the plugin.
     *
     * Set the plugin name and the plugin version that can be used throughout the plugin.
     * Load the dependencies, define the locale, and set the hooks for the admin area and
     * the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function __construct() {
        if ( defined( 'ZIADA_REG_FORM_VERSION' ) ) {
            $this->version = ZIADA_REG_FORM_VERSION;
        } else {
            $this->version = '1.0.0';
        }
        $this->plugin_name = 'ziada-reg-form';

        $this->load_dependencies();
        if ( is_admin() ) {
            $this->define_admin_hooks();
        }
        $this->define_public_hooks();

    }

    /**
     * Load the required dependencies for this plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function load_dependencies() {
        require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-ziada-registration-form-admin.php';
    }

    /**
     * Register all of the hooks related to the admin area functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_admin_hooks() {
        $plugin_admin = new Ziada_Registration_Form_Admin( $this->get_plugin_name(), $this->get_version() );
        add_action( 'admin_menu', array( $plugin_admin, 'add_admin_menu' ) );
        add_action( 'admin_enqueue_scripts', array( $plugin_admin, 'enqueue_scripts' ) );
        add_action( 'admin_init', array( $plugin_admin, 'process_csv_export' ) );
    }

    /**
     * Register all of the hooks related to the public-facing functionality
     * of the plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function define_public_hooks() {
        add_action( 'wp', array( $this, 'check_for_shortcode' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );
        add_shortcode( 'ziada_registration_form', array( $this, 'display_shortcode' ) );

        // add_action( 'admin_post_nopriv_ziada_form_submit', array( $this, 'handle_form_submission' ) );
        // add_action( 'admin_post_ziada_form_submit', array( $this, 'handle_form_submission' ) );

        add_action( 'wp_ajax_nopriv_ziada_form_submit', array( $this, 'handle_ajax_submission' ) );
        add_action( 'wp_ajax_ziada_form_submit', array( $this, 'handle_ajax_submission' ) );
    }

    /**
     * Enqueues scripts and styles for the public-facing side of the site.
     *
     * @since 1.0.0
     */
    public function enqueue_assets() {
        // Only load assets if the shortcode is present.
        if (!self::$load_assets) {
            return;
        }

        // Bootstrap CSS
        wp_enqueue_style(
            'bootstrap-css',
            'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css',
            array(),
            '4.5.2'
        );

        // Plugin's custom CSS
        wp_enqueue_style(
            $this->plugin_name,
            plugin_dir_url( __FILE__ ) . '../css/style.css',
            array( 'bootstrap-css' ),
            $this->version
        );

        // Bootstrap JS
        wp_enqueue_script(
            'bootstrap-js',
            'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js',
            array( 'jquery' ),
            '4.5.2',
            true
        );

        // Plugin's custom JS
        wp_enqueue_script(
            $this->plugin_name,
            plugin_dir_url( __FILE__ ) . '../js/main.js',
            array( 'jquery', 'bootstrap-js' ),
            $this->version,
            true
        );

        // Localize the script with new data
        $localization_array = array(
            'ajax_url' => admin_url( 'admin-ajax.php' ),
            'nonce'    => wp_create_nonce( 'ziada_ajax_nonce' )
        );
        wp_localize_script( $this->plugin_name, 'ziada_form_params', $localization_array );
    }

    /**
     * Renders the [ziada_registration_form] shortcode.
     *
     * @since 1.0.0
     * @return string The form HTML.
     */
    public function display_shortcode() {
        // Set the flag to true because the shortcode is being rendered.
        self::$load_assets = true;

        // Enqueue assets here as a fallback for themes that don't use the_content filter properly.
        $this->enqueue_assets();

        ob_start();
        include_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/partials/ziada-registration-form-public-display.php';
        return ob_get_clean();
    }

    /**
     * Check if the shortcode is present on the current page/post.
     *
     * @since 1.0.0
     */
    public function check_for_shortcode() {
        global $post;
        if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'ziada_registration_form')) {
            self::$load_assets = true;
        }
    }

    /**
     * Handles the form submission.
     *
     * @since 1.0.0
     */
    public function handle_ajax_submission() {
        // Check honeypot field
        if ( ! empty( $_POST['user_website'] ) ) {
            wp_send_json_error( array('message' => 'Spam detected.') );
        }

        // Verify nonce
        if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'ziada_ajax_nonce' ) ) {
            wp_send_json_error( array('message' => 'Security check failed.') );
        }

        // Server-side validation (basic example)
        if ( empty( $_POST['fname_1'] ) || empty( $_POST['email_1'] ) ) {
             wp_send_json_error( array('message' => 'Please fill in all required fields.') );
        }

        global $wpdb;
        $table_name = $wpdb->prefix . 'ziada_registrations';

        // Sanitize and prepare data
        $data = array(
            'created_at' => current_time( 'mysql' ),
            'account_type' => sanitize_text_field( $_POST['account_type'] ),
            'fname_1' => sanitize_text_field( $_POST['fname_1'] ),
            'mname_1' => sanitize_text_field( $_POST['mname_1'] ),
            'lname_1' => sanitize_text_field( $_POST['lname_1'] ),
            'dob_1' => sanitize_text_field( $_POST['dob_1'] ),
            'gender_1' => sanitize_text_field( $_POST['gender_1'] ),
            'nationality_1' => sanitize_text_field( $_POST['nationality_1'] ),
            'id_type_1' => sanitize_text_field( $_POST['id_type_1'] ),
            'id_number_1' => sanitize_text_field( $_POST['id_number_1'] ),
            'mobile_1' => sanitize_text_field( $_POST['mobile_1'] ),
            'email_1' => sanitize_email( $_POST['email_1'] ),
            'declaration_signed' => isset( $_POST['declaration'] ) ? 1 : 0,
        );

        // Add conditional data based on account type
        $account_type = $data['account_type'];
        $data['investor_2_info'] = null;
        $data['company_info'] = null;
        $data['guardian_info'] = null;

        if ($account_type === 'joint' && !empty($_POST['fname_2'])) {
            $investor_2_data = array(
                'fname_2' => sanitize_text_field($_POST['fname_2']),
                'mname_2' => sanitize_text_field($_POST['mname_2']),
                'lname_2' => sanitize_text_field($_POST['lname_2']),
                'dob_2' => sanitize_text_field($_POST['dob_2']),
                'gender_2' => sanitize_text_field($_POST['gender_2']),
                'nationality_2' => sanitize_text_field($_POST['nationality_2']),
                'id_type_2' => sanitize_text_field($_POST['id_type_2']),
                'id_number_2' => sanitize_text_field($_POST['id_number_2']),
                'mobile_2' => sanitize_text_field($_POST['mobile_2']),
                'email_2' => sanitize_email($_POST['email_2']),
            );
            $data['investor_2_info'] = wp_json_encode($investor_2_data);
        } elseif ($account_type === 'company' && !empty($_POST['company_name'])) {
            $company_data = array(
                'company_name' => sanitize_text_field($_POST['company_name']),
                'company_reg_no' => sanitize_text_field($_POST['company_reg_no']),
                'company_reg_cert' => sanitize_text_field($_POST['company_reg_cert']),
                'company_country' => sanitize_text_field($_POST['company_country']),
                'company_type' => sanitize_text_field($_POST['company_type']),
                'company_phone' => sanitize_text_field($_POST['company_phone']),
                'company_email' => sanitize_email($_POST['company_email']),
            );
            $data['company_info'] = wp_json_encode($company_data);
        } elseif ($account_type === 'minor' && !empty($_POST['guardian_fname'])) {
            $guardian_data = array(
                'guardian_fname' => sanitize_text_field($_POST['guardian_fname']),
                'guardian_mname' => sanitize_text_field($_POST['guardian_mname']),
                'guardian_lname' => sanitize_text_field($_POST['guardian_lname']),
            );
            $data['guardian_info'] = wp_json_encode($guardian_data);
        }

        // Add other sections
        $data['contact_info'] = wp_json_encode(array(
            'postal_address' => sanitize_text_field($_POST['postal_address']),
            'physical_address' => sanitize_text_field($_POST['physical_address']),
            'house_no' => sanitize_text_field($_POST['house_no']),
            'district' => sanitize_text_field($_POST['district']),
            'region' => sanitize_text_field($_POST['region']),
            'country' => sanitize_text_field($_POST['country']),
        ));
        $data['bank_details'] = wp_json_encode(array(
            'bank_name' => sanitize_text_field($_POST['bank_name']),
            'bank_branch' => sanitize_text_field($_POST['bank_branch']),
            'bank_acc_name' => sanitize_text_field($_POST['bank_acc_name']),
            'bank_acc_no' => sanitize_text_field($_POST['bank_acc_no']),
        ));
        $data['income_source'] = isset($_POST['income_source']) ? wp_json_encode(array_map('sanitize_text_field', $_POST['income_source'])) : null;

        // Nominees are more complex
        $nominees = array();
        if (isset($_POST['nominee_name']) && is_array($_POST['nominee_name'])) {
            foreach ($_POST['nominee_name'] as $key => $name) {
                if (!empty($name)) {
                    $nominees[] = array(
                        'name' => sanitize_text_field($name),
                        'dob' => sanitize_text_field($_POST['nominee_dob'][$key]),
                        'ownership' => sanitize_text_field($_POST['nominee_ownership'][$key]),
                        'relation' => sanitize_text_field($_POST['nominee_relation'][$key]),
                    );
                }
            }
        }
        $data['nominees'] = wp_json_encode($nominees);

        $data['payment_details'] = wp_json_encode(array(
            'amount_figures' => sanitize_text_field($_POST['payment_amount_figures']),
            'amount_words' => sanitize_text_field($_POST['payment_amount_words']),
            'units' => sanitize_text_field($_POST['payment_units']),
        ));


        // Insert data
        $result = $wpdb->insert( $table_name, $data );
        $new_submission_id = $wpdb->insert_id;

        // Redirect after submission
        if ( $result ) {
            // Send email notifications
            $this->send_submission_emails($new_submission_id, $data);
            wp_send_json_success( array('message' => 'Thank you for your submission!') );
        } else {
            // Handle DB error
            wp_send_json_error( array('message' => 'There was an error processing your submission. Please try again.') );
        }
    }

    /**
     * Sends email notifications for a new submission.
     *
     * @since 1.0.0
     * @param int   $submission_id The ID of the new submission.
     * @param array $data          The submitted form data.
     */
    public function send_submission_emails( $submission_id, $data ) {
        $headers = array('Content-Type: text/html; charset=UTF-8');

        // Admin Notification
        $admin_email = get_option('admin_email');
        $admin_subject = '[Ziada] New Submission Received: ' . esc_html($data['fname_1'] . ' ' . $data['lname_1']);
        $view_link = admin_url('admin.php?page=' . $this->plugin_name . '&action=view&registration=' . $submission_id);

        $admin_message = 'A new submission has been received.<br><br>';
        $admin_message .= '<h3>Applicant Summary</h3>';
        $admin_message .= '<ul>';
        $admin_message .= '<li><strong>Name:</strong> ' . esc_html($data['fname_1'] . ' ' . $data['lname_1']) . '</li>';
        $admin_message .= '<li><strong>Email:</strong> ' . esc_html($data['email_1']) . '</li>';
        $admin_message .= '<li><strong>Phone:</strong> ' . esc_html($data['mobile_1']) . '</li>';
        $admin_message .= '<li><strong>Account Type:</strong> ' . esc_html($data['account_type']) . '</li>';
        $admin_message .= '</ul>';

        // Add conditional info summary
        if ($data['account_type'] === 'joint' && !empty($data['investor_2_info'])) {
            $investor2 = json_decode($data['investor_2_info']);
            $admin_message .= '<strong>2nd Investor:</strong> ' . esc_html($investor2->fname_2 . ' ' . $investor2->lname_2) . '<br>';
        } elseif ($data['account_type'] === 'company' && !empty($data['company_info'])) {
             $company = json_decode($data['company_info']);
             $admin_message .= '<strong>Company Name:</strong> ' . esc_html($company->company_name) . '<br>';
        }

        $admin_message .= '<br>You can view the full submission details here: <a href="' . esc_url($view_link) . '">' . esc_url($view_link) . '</a>';

        wp_mail($admin_email, $admin_subject, $admin_message, $headers);

        // User Confirmation
        $user_email = $data['email_1'];
        if ( ! empty( $user_email ) && is_email( $user_email ) ) {
            $user_subject = 'Your submission to Ziada has been received';
            $user_message = 'Dear ' . esc_html($data['fname_1']) . ',<br><br>';
            $user_message .= 'Thank you for your submission. We have received your information and will process it shortly.<br><br>';
            $user_message .= 'Regards,<br>The Ziada Team';

            wp_mail($user_email, $user_subject, $user_message, $headers);
        }
    }

    /**
     * Run the loader to execute all of the hooks with WordPress.
     *
     * @since    1.0.0
     */
    public function run() {
        // The loader will be executed here once implemented.
    }

    /**
     * The name of the plugin used to uniquely identify it within the context of
     * WordPress and to define internationalization functionality.
     *
     * @since     1.0.0
     * @return    string    The name of the plugin.
     */
    public function get_plugin_name() {
        return $this->plugin_name;
    }

    /**
     * Retrieve the version number of the plugin.
     *
     * @since     1.0.0
     * @return    string    The version number of the plugin.
     */
    public function get_version() {
        return $this->version;
    }

}
