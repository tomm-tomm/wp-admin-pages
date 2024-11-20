<?php
/**
 * Admin menu for theme.
 *
 * @package WordPress
 * @subpackage Random Theme
 * @since Random Theme 1.0.0
 */

/*
 * Settings for admin first-level and second-level menu
 * NOTE:
 * For the left sidebar menu on the admin page
 */

// @return: menu structure and custom CSS loader for theme admin pages
function rt_admin_settings() {

    // First level menu item
    $menu = add_menu_page( __( 'Theme settings', 'random-theme' ), /* Set the first-level page title */
                           __( 'Theme settings', 'random-theme' ), /* Set the first-level page title */
                           'manage_options',
                           'default',
                           'rt_admin_page_1' ); /* Set the name of the first-level page function and also change it in the code below */

    // Second level menu items
    $submenu_page_1 = add_submenu_page( 'default',
                                        __( 'Page 1', 'random-theme' ), /* Set the second-level page #1 title */
                                        __( 'Page 1', 'random-theme' ), /* Set the second-level page #1 title */
                                        'manage_options',
                                        'default',
                                        'rt_admin_page_1' ); /* Set the name of the second-level page #1 function and also change it in the code below */

    $submenu_page_2 = add_submenu_page( 'default',
                                      __( 'Page 2', 'random-theme' ), /* Set the second-level page #2 title */
                                      __( 'Page 2', 'random-theme' ), /* Set the second-level page #2 title */
                                      'manage_options',
                                      'page2', /* Set the second-level page #2 slug */
                                      'rt_admin_page_2' ); /* Set the name of the second-level page #2 function and also change it in the code below */

    // Call custom CSS for theme pages
    add_action( 'admin_print_styles-' . $menu, 'rt_custom_admin_css' );
    add_action( 'admin_print_styles-' . $submenu_page_1, 'rt_custom_admin_css' );
    add_action( 'admin_print_styles-' . $submenu_page_2, 'rt_custom_admin_css' );

}

add_action( 'admin_menu', 'rt_admin_settings' );

/*
 * Custom CSS for theme admin pages
 */

// @return: enqueue theme admin CSS file
function rt_custom_admin_css() {

    $custom_css_file = get_template_directory_uri() . '/inc/admin/styles/style-admin.css';
    wp_enqueue_style( 'rt-custom-admin-css', $custom_css_file );

}

/*
 * Menu and submenu callback functions for pages
 */

// @return: load page

// Default (page 1) settings
function rt_admin_page_1() {
    ?>

    <h1><?php esc_html_e( 'Page 1', 'random-theme' ); ?></h1>

    <?php
    // Load section
    rt_admin_load_page( 'default' );

}

// Page 2 settings
function rt_admin_page_2() {
    ?>

    <h1><?php esc_html_e( 'Page 2', 'random-theme' ); ?></h1>

    <?php
    // Load section
    rt_admin_load_page( 'page2' );

}

/*
 * Upper page navigation and page loader
 * NOTE:
 * For the upper menu displayed on the page
 */

// @params:
// $page (string) => second-level page slug
// @return: navigation and load requested page
function rt_admin_load_page( $page ) {

    // Initalize WP database class
    global $wpdb;

    // Second-level and third-level menu items
    $section_list = array( 'default' => array( 'subpage1' => 'Subpage 1',
                                               'subpage2' => 'Subpage 2' ),
                           'page2'   => array( 'subpage1' => 'Subpage 1',
                                               'subpage2' => 'Subpage 2' ) );

    // Set sections
    if ( !isset( $_GET[ 'section' ] ) ) {
        $section = array_key_first( $section_list[ $page ] );
    } else {
        $section = $_GET[ 'section' ];
    }

    // Display navigation
    rt_nav_builder( $page, $section, $section_list );

    // Load page
    require_once( 'forms/' . $page . '-' . $section . '.php' );

}

/*
 * Upper navigation builder
 */

// @params:
// $page (string)        => second-level page slug
// $section (string)     => third-level page slug
// $section_list (array) => array with second- and third- level slugs (defined in rt_admin_load_page() function)
// @return: navigation
function rt_nav_builder( $page, $section, $section_list ) {

    // Start menu
    echo '
    <nav class="theme-settings-menu">
        <ul>';

    // Create menu list
    foreach ( $section_list[ $page ] as $key => $value ) {

        if ( $section == $key ) {
            $active = ' class="active"';
        } else {
            $active = '';
        }

        echo '
        <li><a' . $active . ' href="?page=' . $page . '&amp;section=' . $key . '">' . $value . '</a></li>';

    }

    // End menu
    echo '
        </ul>
    </nav>';

}