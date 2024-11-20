<?php
/**
 * Subpage 2 in Page 1 section in admin theme settings.
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
$db_table = $wpdb->prefix . 'default_subpage2';

// Db column name list
// NOTE:
// Column name => column type
// s = string, d = integer, f = float
$db_cols = array( 'margin'        => 's',
                  'border-color'  => 's',
                  'border-radius' => 's' );

// Do db operations (update table/select data)
$query_values = rt_admin_form_ops( $db_table, $db_cols );

/*
 * 2. Form
 */

// Introductionary text
rt_admin_form_intro( 'This is an introductionary text for Subpage 2 in Page 1 section.' );

// Build form
// NOTE:
// List of functions is in form-builder.php file.
rt_admin_form_start( $page, $section );

rt_admin_form_block_start( 'Margin - CSS settings' );
rt_admin_form_input_text( 'Margin', 'margin', $query_values[ 'margin' ][ 0 ] );
rt_admin_form_block_end();

rt_admin_form_block_start( 'Borders - CSS settings' );
rt_admin_form_input_text( 'Color', 'border_color', $query_values[ 'border_color' ][ 0 ] );
rt_admin_form_input_text( 'Radius', 'border_radius', $query_values[ 'border_radius' ][ 0 ] );
rt_admin_form_block_end();

rt_admin_form_submit( 'Submit' );

rt_admin_form_end();
?>