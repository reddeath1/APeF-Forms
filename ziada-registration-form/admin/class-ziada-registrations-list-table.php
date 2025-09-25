<?php
// The full, final code for the WP_List_Table class
if ( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}
class Ziada_Registrations_List_Table extends WP_List_Table {

    public function __construct() {
        parent::__construct( array(
            'singular' => 'Submission',
            'plural'   => 'Submissions',
            'ajax'     => false
        ) );
    }

    public function get_columns() {
        return array(
            'cb'           => '<input type="checkbox" />',
            'fname_1'      => 'Name',
            'email_1'      => 'Email',
            'account_type' => 'Account Type',
            'created_at'   => 'Date'
        );
    }

    public function get_sortable_columns() {
        return array(
            'fname_1'    => array( 'fname_1', false ),
            'created_at' => array( 'created_at', true )
        );
    }

    protected function get_bulk_actions() {
        return array('bulk-delete' => 'Delete');
    }

    protected function extra_tablenav($which) {
        if ($which == "top") {
            ?>
            <div class="alignleft actions">
                <select name="account_type_filter">
                    <option value="">All Types</option>
                    <option value="individual" <?php selected(isset($_REQUEST['account_type_filter']) ? $_REQUEST['account_type_filter'] : '', 'individual'); ?>>Individual</option>
                    <option value="joint" <?php selected(isset($_REQUEST['account_type_filter']) ? $_REQUEST['account_type_filter'] : '', 'joint'); ?>>Joint</option>
                    <option value="company" <?php selected(isset($_REQUEST['account_type_filter']) ? $_REQUEST['account_type_filter'] : '', 'company'); ?>>Company</option>
                    <option value="minor" <?php selected(isset($_REQUEST['account_type_filter']) ? $_REQUEST['account_type_filter'] : '', 'minor'); ?>>Minor</option>
                </select>
                <?php submit_button('Filter', 'button', 'filter_action', false); ?>
            </div>
            <?php
        }
    }

    public function prepare_items() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'ziada_registrations';
        $per_page = 20;

        $this->_column_headers = array($this->get_columns(), array(), $this->get_sortable_columns());

        $where_clauses = array();
        $query_args = array();

        if (!empty($_REQUEST['s'])) {
            $search = sanitize_text_field($_REQUEST['s']);
            $where_clauses[] = "(fname_1 LIKE %s OR lname_1 LIKE %s OR email_1 LIKE %s)";
            $like_term = '%' . $wpdb->esc_like($search) . '%';
            $query_args[] = $like_term;
            $query_args[] = $like_term;
            $query_args[] = $like_term;
        }

        if (!empty($_REQUEST['account_type_filter'])) {
            $filter = sanitize_text_field($_REQUEST['account_type_filter']);
            $where_clauses[] = "account_type = %s";
            $query_args[] = $filter;
        }

        $where_sql = count($where_clauses) > 0 ? ' WHERE ' . implode(' AND ', $where_clauses) : '';

        $count_sql = "SELECT COUNT(id) FROM $table_name" . $where_sql;
        $total_items = $wpdb->get_var($wpdb->prepare($count_sql, $query_args));

        $this->set_pagination_args(array(
            'total_items' => $total_items,
            'per_page'    => $per_page
        ));

        $orderby = !empty($_REQUEST['orderby']) ? sanitize_sql_orderby($_REQUEST['orderby']) : 'created_at';
        $order = !empty($_REQUEST['order']) ? sanitize_key($_REQUEST['order']) : 'DESC';
        $current_page = $this->get_pagenum();
        $offset = ($current_page - 1) * $per_page;

        $select_sql = "SELECT id, fname_1, lname_1, email_1, account_type, created_at FROM $table_name" . $where_sql . " ORDER BY $orderby $order LIMIT %d OFFSET %d";
        $this->items = $wpdb->get_results($wpdb->prepare($select_sql, array_merge($query_args, array($per_page, $offset))), ARRAY_A);
    }

    protected function column_default( $item, $column_name ) {
        return esc_html( $item[ $column_name ] );
    }

    protected function column_cb( $item ) {
        return sprintf('<input type="checkbox" name="registration[]" value="%s" />', $item['id']);
    }

    protected function column_fname_1( $item ) {
        $name = esc_html( $item['fname_1'] . ' ' . $item['lname_1'] );
        $delete_nonce = wp_create_nonce( 'ziada_delete_submission' );
        $actions = array(
            'view' => sprintf('<a href="?page=%s&action=view&registration=%s">View</a>', esc_attr($_REQUEST['page']), absint($item['id'])),
            'delete' => sprintf('<a href="?page=%s&action=delete&registration=%s&_wpnonce=%s" class="delete-submission">Delete</a>', esc_attr($_REQUEST['page']), absint($item['id']), $delete_nonce),
        );
        return $name . $this->row_actions($actions);
    }
}