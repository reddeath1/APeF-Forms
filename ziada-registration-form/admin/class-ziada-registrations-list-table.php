<?php
if (!class_exists('WP_List_Table')) {
    require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}
class Ziada_Registrations_List_Table extends WP_List_Table {

    public function __construct() {
        parent::__construct(array(
            'singular' => 'Submission',
            'plural'   => 'Submissions',
            'ajax'     => false
        ));
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
            'fname_1'    => array('fname_1', false),
            'created_at' => array('created_at', true)
        );
    }

    protected function get_bulk_actions() {
        return array('bulk-delete' => 'Delete');
    }

    protected function extra_tablenav($which) {
        if ($which == "top") {
            echo '<div class="alignleft actions">';
            $this->account_type_dropdown();
            submit_button('Filter', 'button', 'filter_action', false);
            echo '</div>';
        }
    }

    private function account_type_dropdown() {
        $selected = isset($_REQUEST['account_type_filter']) ? $_REQUEST['account_type_filter'] : '';
        echo '<select name="account_type_filter">';
        echo '<option value="">All Account Types</option>';
        $types = array('individual', 'joint', 'company', 'minor');
        foreach ($types as $type) {
            printf('<option value="%s"%s>%s</option>', $type, selected($selected, $type, false), ucfirst($type));
        }
        echo '</select>';
    }

    public function prepare_items() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'ziada_registrations';
        $per_page = 20;
        $this->_column_headers = array($this->get_columns(), array(), $this->get_sortable_columns());

        $where_clauses = array();
        $query_args = array();

        if (!empty($_REQUEST['s'])) {
            $search = '%' . $wpdb->esc_like(sanitize_text_field($_REQUEST['s'])) . '%';
            $where_clauses[] = "(fname_1 LIKE %s OR lname_1 LIKE %s OR email_1 LIKE %s)";
            $query_args[] = $search;
            $query_args[] = $search;
            $query_args[] = $search;
        }

        if (!empty($_REQUEST['account_type_filter'])) {
            $where_clauses[] = "account_type = %s";
            $query_args[] = sanitize_text_field($_REQUEST['account_type_filter']);
        }

        $where_sql = count($where_clauses) > 0 ? ' WHERE ' . implode(' AND ', $where_clauses) : '';

        $total_items = $wpdb->get_var($wpdb->prepare("SELECT COUNT(id) FROM $table_name" . $where_sql, $query_args));
        $this->set_pagination_args(array('total_items' => $total_items, 'per_page' => $per_page));

        $orderby = !empty($_REQUEST['orderby']) ? sanitize_sql_orderby($_REQUEST['orderby']) : 'created_at';
        $order = !empty($_REQUEST['order']) ? sanitize_key($_REQUEST['order']) : 'DESC';
        $current_page = $this->get_pagenum();
        $offset = ($current_page - 1) * $per_page;

        $select_sql = "SELECT id, fname_1, lname_1, email_1, account_type, created_at FROM $table_name" . $where_sql . " ORDER BY $orderby $order LIMIT %d OFFSET %d";
        $this->items = $wpdb->get_results($wpdb->prepare($select_sql, array_merge($query_args, array($per_page, $offset))), ARRAY_A);
    }

    protected function column_default($item, $column_name) { return esc_html($item[$column_name]); }
    protected function column_cb($item) { return sprintf('<input type="checkbox" name="registration[]" value="%s" />', $item['id']); }
    protected function column_fname_1($item) {
        $name = esc_html($item['fname_1'] . ' ' . $item['lname_1']);
        $delete_nonce = wp_create_nonce('ziada_delete_submission');
        $actions = array(
            'view' => sprintf('<a href="?page=%s&action=view&registration=%s">View</a>', $_REQUEST['page'], $item['id']),
            'delete' => sprintf('<a href="?page=%s&action=delete&registration=%s&_wpnonce=%s" class="delete-submission">Delete</a>', $_REQUEST['page'], $item['id'], $delete_nonce),
        );
        return $name . $this->row_actions($actions);
    }
}