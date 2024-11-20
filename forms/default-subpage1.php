<?php
/**
 * Subpage 1 in Page 1 section in admin theme settings.
 * Loaded in index.php file.
 *
 * 1. Db operations
 * 2. Form
 *
 * @package WordPress
 * @subpackage Random Theme
 * @since Random Theme 1.0.0
 */

/*
 * 1. Db operations
 */

// Set database variables

// Database table
$db_table = $wpdb->prefix . 'default_subpage1';

// Db column name list
// NOTE:
// Column name => column type
// s = string, d = integer, f = float
$db_cols = array( 'column1' => 's',
                  'column2' => 's',
                  'column3' => 's' );

// Do db operations (update table/select data)
$query_values = rt_admin_form_ops( $db_table, $db_cols );

/*
 * 2. Form
 */

// Introductionary text
rt_admin_form_intro( 'This is an introductionary text for Subpage 1 in Page 1 section.' );

// Build form
// NOTE:
// List of functions is in form-builder.php file.
rt_admin_form_start( $page, $section );

rt_admin_form_block_start( 'Block 1' );
rt_admin_form_input_text( 'Column 1', 'column1', $query_values[ 'column1' ][ 0 ] );
rt_admin_form_input_checkbox( 'Column 2', 'column2', $query_values[ 'column2' ][ 0 ] );
rt_admin_form_block_end();

rt_admin_form_block_start( 'Block 2' );
rt_admin_form_textarea( 'Column 3', 'column3', $query_values[ 'column3' ][ 0 ], 10 );
rt_admin_form_block_end();

rt_admin_form_submit( 'Submit' );

rt_admin_form_end();
?>