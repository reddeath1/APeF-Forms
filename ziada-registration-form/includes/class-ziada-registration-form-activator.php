<?php
/**
 * Fired during plugin activation.
 * @link       https://owesis.com
 * @author     Frank Galos
 */
class Ziada_Registration_Form_Activator {
    public static function activate() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'ziada_registrations';
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            created_at datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
            account_type varchar(55) DEFAULT '' NOT NULL,
            fname_1 varchar(100) NOT NULL,
            mname_1 varchar(100) DEFAULT NULL,
            lname_1 varchar(100) NOT NULL,
            dob_1 date DEFAULT NULL,
            gender_1 varchar(10) DEFAULT NULL,
            nationality_1 varchar(100) DEFAULT NULL,
            id_type_1 varchar(55) DEFAULT NULL,
            id_number_1 varchar(100) DEFAULT NULL,
            mobile_1 varchar(55) DEFAULT NULL,
            email_1 varchar(100) DEFAULT NULL,
            primary_user_photo text DEFAULT NULL,
            investor_2_info text DEFAULT NULL,
            company_info text DEFAULT NULL,
            guardian_info text DEFAULT NULL,
            contact_info text DEFAULT NULL,
            bank_details text DEFAULT NULL,
            income_source text DEFAULT NULL,
            nominees text DEFAULT NULL,
            nominee_guardian text DEFAULT NULL,
            payment_details text DEFAULT NULL,
            declaration_signed tinyint(1) NOT NULL DEFAULT 0,
            PRIMARY KEY  (id)
        ) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
    }
}