<?php
/**
 * Admin additional tools.
 *
 * @package WordPress
 * @subpackage Random Theme
 * @since Random Theme 1.0.0
 */

/*
 * Admin file uploader
 */

// @return: enqueue script for file upload in admin
function rt_admin_file_uploader() {

    if ( isset( $_GET[ 'page' ] ) ) {

        // For WP media uploader scripts
        if ( !did_action( 'wp_enqueue_media' ) ) {
            wp_enqueue_media();
        }

        wp_enqueue_script(
            'admin-file-uploader',
            THEME_DIRECTORY_URI . '/js/admin-file-uploader.js',
            array( 'jquery' )
        );

    }

}

add_action( 'admin_enqueue_scripts', 'rt_admin_file_uploader' );