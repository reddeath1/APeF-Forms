<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://example.com/
 * @since      1.0.0
 *
 * @package    Ziada_Reg_Form
 * @subpackage Ziada_Reg_Form/admin
 */
class Ziada_Registration_Form_Admin {

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of this plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct( $plugin_name, $version ) {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() {
        wp_enqueue_script( $this->plugin_name . '-admin', plugin_dir_url( __FILE__ ) . 'js/admin.js', array( 'jquery' ), $this->version, false );
    }

    /**
     * Register the administration menu for this plugin into the WordPress Dashboard menu.
     *
     * @since    1.0.0
     */
    public function add_admin_menu() {
        add_menu_page(
            'Ziada',
            'Ziada',
            'manage_options',
            $this->plugin_name,
            array( $this, 'display_plugin_admin_page' ),
            'dashicons-list-view',
            25
        );
    }

    /**
     * Render the settings page for this plugin.
     *
     * @since    1.0.0
     */
    public function display_plugin_admin_page() {
        // This needs to be at the top to process actions before rendering the page
        $this->process_actions();

        // Display admin notices
        if ( isset( $_GET['message'] ) && $_GET['message'] == 'deleted' ) {
             add_action( 'admin_notices', function() {
                echo '<div class="notice notice-success is-dismissible"><p>Submission(s) deleted successfully.</p></div>';
            });
        }

        $action = isset( $_GET['action'] ) ? sanitize_key( $_GET['action'] ) : 'list';
        $registration_id = isset( $_GET['registration'] ) ? absint( $_GET['registration'] ) : 0;

        // Create the partials directory if it doesn't exist
        $partials_dir = plugin_dir_path( __FILE__ ) . 'partials';
        if ( ! file_exists( $partials_dir ) ) {
            wp_mkdir_p( $partials_dir );
        }

        if ( 'view' === $action && $registration_id > 0 ) {
            global $wpdb;
            $table_name = $wpdb->prefix . 'ziada_registrations';
            $submission = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $table_name WHERE id = %d", $registration_id ) );

            include_once 'partials/ziada-registration-form-admin-view-display.php';
        } else {
            require_once 'class-ziada-registrations-list-table.php';

            $list_table = new Ziada_Registrations_List_Table();
            $list_table->prepare_items();
            ?>
            <div class="wrap">
                <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
                <form method="post">
                    <?php
                    $list_table->display();
                    ?>
                </form>
            </div>
            <?php
        }
    }

    /**
     * Process actions like delete and bulk delete.
     *
     * @since 1.0.0
     */
    public function process_actions() {
        // Single delete action
        if ( isset( $_GET['action'] ) && $_GET['action'] == 'delete' && isset( $_GET['registration'] ) && isset( $_GET['_wpnonce'] ) ) {
            if ( wp_verify_nonce( $_GET['_wpnonce'], 'ziada_delete_submission' ) && current_user_can( 'manage_options' ) ) {
                global $wpdb;
                $table_name = $wpdb->prefix . 'ziada_registrations';
                $wpdb->delete( $table_name, array( 'id' => absint( $_GET['registration'] ) ) );

                wp_safe_redirect( admin_url( 'admin.php?page=' . $this->plugin_name . '&message=deleted' ) );
                exit;
            }
        }

        // Bulk delete action
        if ( ( isset( $_POST['action'] ) && $_POST['action'] == 'bulk-delete' ) || ( isset( $_POST['action2'] ) && $_POST['action2'] == 'bulk-delete' ) ) {
            if ( isset( $_POST['_wpnonce'] ) && wp_verify_nonce( $_POST['_wpnonce'], 'bulk-submissions' ) && current_user_can( 'manage_options' ) ) {
                global $wpdb;
                $table_name = $wpdb->prefix . 'ziada_registrations';
                $delete_ids = array_map( 'absint', $_POST['registration'] );

                if ( ! empty( $delete_ids ) ) {
                    $ids_sql = implode( ',', $delete_ids );
                    $wpdb->query( "DELETE FROM $table_name WHERE id IN($ids_sql)" );
                    wp_safe_redirect( admin_url( 'admin.php?page=' . $this->plugin_name . '&message=deleted' ) );
                    exit;
                }
            }
        }
    }
}
