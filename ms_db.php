<?php
/*Database Plugin*/

function ms_install_table() {
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $manage_table = $wpdb->prefix . "mbSystem";
        $sql = 'CREATE TABLE ' . $manage_table . '(
            id int(10) NOT NULL AUTO_INCREMENT,
            name tinytext NOT NULL,
            age int NOT NULL,
            gender text NOT NULL, 
            PRIMARY KEY  (id)
          )'. $charset_collate .';';

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );

    add_option('mbSystem_database_version', 1.0);
}

