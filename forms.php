<?php
/**
 * Admin form operations.
 *
 * @package WordPress
 * @subpackage Random Theme
 * @since Random Theme 1.0.0
 */

/*
 * Form operations function
 */

// Call update query after form submit
// Call select query
// @params:
// $db_table (string) => database table name
// $db_cols (string)  => database table cols
// @return: query values
function rt_admin_form_ops( $db_table, $db_cols ) {

    // Update data
    // If form was submitted
    if ( isset( $_POST[ 'submit' ] ) &&
         $_POST[ 'submit' ] == 'Submit' ) {
        rt_admin_form_update_query( $db_table, $db_cols );
    }

    // Get data
    $query_values = rt_admin_form_select_query( $db_table, $db_cols );

    return $query_values;

}