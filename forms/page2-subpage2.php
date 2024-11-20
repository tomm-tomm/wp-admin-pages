<?php
/**
 * Subpage 2 in Page 2 section in admin theme settings.
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
$db_table = $wpdb->prefix . 'page2_subpage2';

// Db column name list
// NOTE:
// Column name => column type
// s = string, d = integer, f = float
$db_cols = array( 'bg_color'      => 's',
                  'font_size'     => 's',
                  'text_color'    => 's',
                  'logo_image'    => 's',
                  'logo_image_id' => 'd',);

// Do db operations (update table/select data)
$query_values = rt_admin_form_ops( $db_table, $db_cols );

/*
 * 2. Form
 */

// Introductionary text
rt_admin_form_intro( 'This is an introductionary text for Subpage 2 in Page 2 section.' );

// Build form
// NOTE:
// List of functions is in form-builder.php file.
rt_admin_form_start( $page, $section );

rt_admin_form_block_start( 'Background - CSS settings' );
rt_admin_form_input_text( 'Background color', 'bg_color', $query_values[ 'bg_color' ][ 0 ] );
rt_admin_form_block_end();

rt_admin_form_block_start( 'Text - CSS settings' );
rt_admin_form_input_text( 'Font size', 'font_size', $query_values[ 'font_size' ][ 0 ] );
rt_admin_form_input_text( 'Text color', 'text_color', $query_values[ 'text_color' ][ 0 ] );
rt_admin_form_block_end();

rt_admin_form_block_start( 'Logo image' );
rt_admin_form_input_image( 'Logo image', 'logo_image', $query_values[ 'logo_image' ][ 0 ], $query_values[ 'logo_image_id' ][ 0 ] );
rt_admin_form_input_text( 'Logo title', 'logo_title', $query_values[ 'logo_title' ][ 0 ] );
rt_admin_form_block_end();

rt_admin_form_submit( 'Submit' );

rt_admin_form_end();
?>