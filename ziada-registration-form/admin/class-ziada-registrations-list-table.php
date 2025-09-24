<?php

if ( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

/**
 * Creates a WP_List_Table for Ziada Registration submissions.
 *
 * @package    Ziada_Reg_Form
 * @subpackage Ziada_Reg_Form/admin
 */
class Ziada_Registrations_List_Table extends WP_List_Table {

    /**
     * Constructor.
     */
    public function __construct() {
        parent::__construct( array(
            'singular' => 'Submission',
            'plural'   => 'Submissions',
            'ajax'     => false
        ) );
    }

    /**
     * Get a list of columns.
     *
     * @return array
     */
    public function get_columns() {
        return array(
            'cb'           => '<input type="checkbox" />',
            'fname_1'      => 'Name',
            'email_1'      => 'Email',
            'account_type' => 'Account Type',
            'created_at'   => 'Date Submitted'
        );
    }

    /**
     * Get a list of sortable columns.
     *
     * @return array
     */
    public function get_sortable_columns() {
        return array(
            'fname_1'    => array( 'fname_1', false ),
            'created_at' => array( 'created_at', true ) // True means it's sorted by default
        );
    }

    /**
     * Get a list of bulk actions.
     *
     * @return array
     */
    protected function get_bulk_actions() {
        return array(
            'bulk-delete' => 'Delete'
        );
    }

    /**
     * Prepares the list of items for displaying.
     */
    public function prepare_items() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'ziada_registrations';

        $per_page = 20;
        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();
        $this->_column_headers = array( $columns, $hidden, $sortable );

        // Sorting
        $orderby = ( ! empty( $_REQUEST['orderby'] ) ) ? sanitize_sql_orderby( $_REQUEST['orderby'] ) : 'created_at';
        $order = ( ! empty( $_REQUEST['order'] ) ) ? sanitize_key( $_REQUEST['order'] ) : 'DESC';

        // Pagination
        $current_page = $this->get_pagenum();
        $total_items = $wpdb->get_var( "SELECT COUNT(id) FROM $table_name" );

        $this->set_pagination_args( array(
            'total_items' => $total_items,
            'per_page'    => $per_page
        ) );

        $offset = ( $current_page - 1 ) * $per_page;
        $this->items = $wpdb->get_results(
            $wpdb->prepare(
                "SELECT id, fname_1, mname_1, lname_1, email_1, account_type, created_at FROM $table_name ORDER BY $orderby $order LIMIT %d OFFSET %d",
                $per_page,
                $offset
            ), ARRAY_A
        );
    }

    /**
     * Default column rendering.
     *
     * @param array $item
     * @param string $column_name
     * @return mixed
     */
    protected function column_default( $item, $column_name ) {
        return isset( $item[ $column_name ] ) ? esc_html( $item[ $column_name ] ) : print_r( $item, true );
    }

    /**
     * Renders the 'fname_1' column (Name).
     *
     * @param array $item
     * @return string
     */
    protected function column_fname_1( $item ) {
        $name = esc_html( $item['fname_1'] . ' ' . $item['lname_1'] );

        // Add nonce for the delete action
        $delete_nonce = wp_create_nonce( 'ziada_delete_submission' );
        $delete_link = sprintf(
            '<a href="?page=%s&action=delete&registration=%s&_wpnonce=%s" class="delete-submission">Delete</a>',
            esc_attr( $_REQUEST['page'] ),
            absint( $item['id'] ),
            $delete_nonce
        );

        $actions = array(
            'view' => sprintf('<a href="?page=%s&action=view&registration=%s">View</a>', esc_attr($_REQUEST['page']), absint($item['id'])),
            'delete' => $delete_link,
        );
        return $name . $this->row_actions($actions);
    }

    /**
     * Renders the checkbox column.
     *
     * @param array $item
     * @return string
     */
    protected function column_cb( $item ) {
        return sprintf(
            '<input type="checkbox" name="registration[]" value="%s" />', $item['id']
        );
    }
}
