<?php
/**
 * Load files needed for theme settings.
 *
 * @package WordPress
 * @subpackage Random Theme
 * @since Random Theme 1.0.0
 */

/*
 * Load files with functions
 */

// Tools
require_once( THEME_DIRECTORY . '/inc/admin/tools.php' );
 // Menu
require_once( THEME_DIRECTORY . '/inc/admin/menu.php' );
// Form builder
require_once( THEME_DIRECTORY . '/inc/admin/form-builder.php' );
// Db
require_once( THEME_DIRECTORY . '/inc/admin/db.php' );
// Form operations
require_once( THEME_DIRECTORY . '/inc/admin/forms.php' );