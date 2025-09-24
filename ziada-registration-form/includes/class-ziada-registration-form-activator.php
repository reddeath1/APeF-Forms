<?php

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Ziada_Reg_Form
 * @subpackage Ziada_Reg_Form/includes
 */
class Ziada_Registration_Form_Activator {

    /**
     * The `activate` method is called on plugin activation.
     * It creates the custom database table to store form submissions.
     *
     * @since    1.0.0
     */
    public static function activate() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'ziada_registrations';
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            created_at datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
            account_type varchar(55) DEFAULT '' NOT NULL,

            -- Investor 1 Fields
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

            -- Conditional Fields (JSON encoded or separate columns)
            -- For simplicity, we'll store complex/variable data as TEXT.
            -- A more normalized approach might use separate tables.
            investor_2_info text DEFAULT NULL, -- JSON for Section B
            company_info text DEFAULT NULL,    -- JSON for Section C
            guardian_info text DEFAULT NULL,   -- JSON for Section D

            -- Contact & Bank
            contact_info text DEFAULT NULL,    -- JSON for Section E
            bank_details text DEFAULT NULL,    -- JSON for Section F

            -- Financials & Nominees
            income_source text DEFAULT NULL,   -- JSON for Section G
            nominees text DEFAULT NULL,        -- JSON for Section H
            nominee_guardian text DEFAULT NULL,-- JSON for Nominee Guardian info

            -- Payment & Declaration
            payment_details text DEFAULT NULL, -- JSON for Section J
            declaration_signed tinyint(1) NOT NULL DEFAULT 0,

            PRIMARY KEY  (id)
        ) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
    }
}
