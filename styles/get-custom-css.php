<?php
/**
 * Generate custom CSS for theme.
 *
 * @package WordPress
 * @subpackage Random Theme
 * @since Random Theme 1.0.0
 */

// Get custom CSS text
$custom_css = get_custom_css();

// Initalize WP database class
global $wpdb;

// Update data in table with CSS
$wpdb->update( $wpdb->prefix . 'custom_css', /* Custom CSS table name */
               array( 'custom_css' => $custom_css ), /* Key = custom CSS column name in the table above */
               array( 'id' => 1 ),
               array( '%s' ) );

// Display error information
if ( $wpdb->last_error ) {

    echo '<span class="tsf-message error">';
    _e( 'Error: Custom CSS wasn\'t successfully updated.', 'random-theme' ) . $wpdb->last_error;
    echo '</span>';

}

// Generate custom CSS styles
function get_custom_css() {

    // Initialize WP database class
    global $wpdb;

    // Initialize variable for CSS string
    $custom_css = '';

    /*
     * TABLE: page1_subpage2
     */

    // Select data
    $row = $wpdb->get_row( "SELECT margin, border_color, border_radius
                            FROM {$wpdb->prefix}page1_subpage2
                            WHERE id = 1" );

    // If MySQL error
    if ( $wpdb->last_error ) {
        echo 'Error: ' . $wpdb->last_error;
    } else {
        // If MySQL success
        // Set values
        $margin = $row->margin;
        $border_color = $row->border_color;
        $border_radius = $row->border_radius;

        // CSS list of values
        if ( $margin ) {
            $custom_css .= 'body {margin: #' . $margin . ';}';
        }
        if ( $border_color ) {
            $custom_css .= 'body {border-color: ' . $border_color . ';}';
        }
        if ( $border_radius ) {
            $custom_css .= 'body {border-radius: #' . $border_radius . ';}';
        }

    }

    /*
     * TABLE: page2_subpage2
     */

    // Select data
    $row = $wpdb->get_row( "SELECT bg_color, font_size, text_color
                            FROM {$wpdb->prefix}page2_subpage2
                            WHERE id = 1" );

    // If MySQL error
    if ( $wpdb->last_error ) {
        echo 'Error: ' . $wpdb->last_error;
    } else {
        // If MySQL success
        // Set values
        $bg_color = $row->bg_color;
        $font_size = $row->font_size;
        $text_color = $row->text_color;

        // CSS list of values
        if ( $bg_color ) {
            $custom_css .= 'body {background-color: #' . $bg_color . ';}';
        }
        if ( $font_size ) {
            $custom_css .= 'body {font-size: ' . $font_size . ';}';
        }
        if ( $text_color ) {
            $custom_css .= 'body {color: #' . $text_color . ';}';
        }

    }

    return $custom_css;

}

?>