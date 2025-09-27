<?php
if (!class_exists('WP_List_Table')) {
    require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}
class Ziada_Registrations_List_Table extends WP_List_Table {

    public function __construct() {
        parent::__construct(['singular' => 'Submission', 'plural' => 'Submissions', 'ajax' => false]);
    }

    public function get_columns() {
        return ['cb' => '<input type="checkbox" />', 'fname_1' => 'Name', 'email_1' => 'Email', 'account_type' => 'Account Type', 'created_at' => 'Date'];
    }

    public function get_sortable_columns() {
        return ['fname_1' => ['fname_1', false], 'created_at' => ['created_at', true]];
    }

    protected function get_bulk_actions() {
        return ['bulk-delete' => 'Delete'];
    }

    protected function extra_tablenav($which) {
        if ($which == "top") {
            echo '<div class="alignleft actions">';
            $this->account_type_dropdown();
            submit_button('Filter', 'button', 'filter_action', false, ['id' => 'post-query-submit']);
            echo '</div>';
        }
    }

    private function account_type_dropdown() {
        $selected = !empty($_REQUEST['account_type_filter']) ? $_REQUEST['account_type_filter'] : '';
        echo '<select name="account_type_filter"><option value="">All Types</option>';
        foreach (['individual', 'joint', 'company', 'minor'] as $type) {
            printf('<option value="%s"%s>%s</option>', $type, selected($selected, $type, false), ucfirst($type));
        }
        echo '</select>';
    }

    public function prepare_items() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'ziada_registrations';
        $per_page = 20;
        $this->_column_headers = [$this->get_columns(), [], $this->get_sortable_columns()];

        $where = [];
        $args = [];
        if (!empty($_REQUEST['s'])) {
            $search = '%' . $wpdb->esc_like(sanitize_text_field($_REQUEST['s'])) . '%';
            $where[] = "(fname_1 LIKE %s OR lname_1 LIKE %s OR email_1 LIKE %s)";
            $args[] = $search; $args[] = $search; $args[] = $search;
        }
        if (!empty($_REQUEST['account_type_filter'])) {
            $where[] = "account_type = %s";
            $args[] = sanitize_text_field($_REQUEST['account_type_filter']);
        }
        $where_sql = count($where) > 0 ? ' WHERE ' . implode(' AND ', $where) : '';

        $total_items = $wpdb->get_var($wpdb->prepare("SELECT COUNT(id) FROM $table_name" . $where_sql, $args));
        $this->set_pagination_args(['total_items' => $total_items, 'per_page' => $per_page]);

        $orderby = !empty($_REQUEST['orderby']) && in_array($_REQUEST['orderby'], array_keys($this->get_sortable_columns())) ? $_REQUEST['orderby'] : 'created_at';
        $order = !empty($_REQUEST['order']) && in_array(strtoupper($_REQUEST['order']), ['ASC', 'DESC']) ? $_REQUEST['order'] : 'DESC';

        $offset = ($this->get_pagenum() - 1) * $per_page;
        $this->items = $wpdb->get_results($wpdb->prepare("SELECT id, fname_1, lname_1, email_1, account_type, created_at FROM $table_name" . $where_sql . " ORDER BY $orderby $order LIMIT %d OFFSET %d", array_merge($args, [$per_page, $offset])), ARRAY_A);
    }

    protected function column_default($item, $column_name) { return esc_html($item[$column_name]); }
    protected function column_cb($item) { return sprintf('<input type="checkbox" name="registration[]" value="%d" />', $item['id']); }
    protected function column_fname_1($item) {
        $name = esc_html(trim($item['fname_1'] . ' ' . $item['lname_1']));
        $delete_nonce = wp_create_nonce('ziada_delete_submission');
        $actions = [
            'view' => sprintf('<a href="?page=%s&action=view&registration=%d">View</a>', $_REQUEST['page'], $item['id']),
            'delete' => sprintf('<a href="?page=%s&action=delete&registration=%d&_wpnonce=%s" class="delete-submission">Delete</a>', $_REQUEST['page'], $item['id'], $delete_nonce),
        ];
        return $name . $this->row_actions($actions);
    }
}