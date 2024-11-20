<?php
/**
 * Admin form db operations.
 *
 * @package WordPress
 * @subpackage Random Theme
 * @since Random Theme 1.0.0
 */

/*
 * Do select query and get data
 */

// @params:
// $db_table (string) => database table name
// $db_cols (string)  => database table cols
// @return: select query values
function rt_admin_form_select_query( $db_table, $db_cols ) {

    // Set columns for select query
    foreach ( $db_cols as $key => $value ) {

        if ( isset( $db_select_cols ) ) {
            $db_select_cols .= ', ' . $key;
        } else {
            $db_select_cols = $key;
        }

    }

    // Initalize WP database class
    global $wpdb;

    // Do select query
    $row = $wpdb->get_row( "SELECT $db_select_cols
                            FROM $db_table
                            WHERE id = 1" );

    // If MySQL error
    if ( $wpdb->last_error ) {
        _e( 'Error:', 'random-theme' ) . $wpdb->last_error;
    } else {
        // If MySQL success
        // Set values
        foreach ( $db_cols as $key => $value ) {

            // Initialize array for query values
            $query_values[ $key ] = array();

            // Set same variable name as a table column name
            ${ $key } = $row->$key;

            array_push( $query_values[ $key ], ${ $key } );

        }

    }

    return $query_values;

}

/*
 * Do update query and get data
 */

// @params:
// $db_table (string) => db table name
// $db_cols (string)  => db table cols
// @return: update query values
function rt_admin_form_update_query( $db_table, $db_cols ) {

    // Initialize arrays for columns and values/formats
    $db_update_colvals = array();
    $db_update_formats = array();

    // Current date
    $now = date( 'Y-m-d H:i:s' );

    foreach ( $db_cols as $key => $value ) {

        // Set columns and values for update query
        // Exception for non-POST vars
        if ( $key == 'changed_at' ) {
            $col_val = $now;
        } else {
            // For POST vars

            // If $key was sent
            // NOTE:
            // F.e. checkboxes are not sent when they are empty
            if ( isset( $_POST[ $key ] ) ) {
                $col_val = stripslashes( $_POST[ $key ] );
            } else {
                $col_val = '';
            }
        }

        $db_update_colvals[ $key ] = $col_val;

        // Set the value formats for update query
        array_push( $db_update_formats, '%' . $value );

    }

    // Initalize WP database class
    global $wpdb;

    // Update data
    $wpdb->update( $db_table,
                   $db_update_colvals,
                   array( 'id' => 1 ),
                   $db_update_formats );

    // Display information
    if ( $wpdb->last_error ) {

        // Error
        echo '<span class="tsf-message error">';
        _e( 'Data wasn\'t successfully updated.', 'random-theme' ) . ': ' . $wpdb->last_error;
        echo '</span>';

    } else {

        // Success
        echo '<span class="tsf-message success">';
        _e( 'Data was successfully updated.', 'random-theme' );
        echo '</span>';

        // Generate custom CSS
        require_once( 'styles/get-custom-css.php' ); // Leave this uncommented for generating custom CSS

    }

}