<?php
/**
 * Admin form builder.
 *
 * @package WordPress
 * @subpackage Random Theme
 * @since Random Theme 1.0.0
 */

/*
 * Start form
 */

// @params:
// $page (string)    => second-level page name
// $section (string) => third-level page name
// @return: start form HTML code
function rt_admin_form_start( $page, $section ) {

    echo '
    <div class="theme-settings-form">
        <form action="?page=' . $page . '&amp;section=' . $section . '" method="post">';

}

/*
 * End form
 */

// @return: end form HTML code
function rt_admin_form_end() {

    echo '
        </form>
    </div>';

}

/*
 * Start new block
 */

// @params:
// $title (string) => block title
// @return: start block HTML code
function rt_admin_form_block_start( $title ) {

    echo '
    <div class="tsf-block">
        <h2>' . $title . '</h2>';

}

/*
 * End block
 */

// @return: end block HTML code
function rt_admin_form_block_end() {

    echo '
    </div>';

}

/*
 * Text input
 */

// @params:
// $label_name (string)  => label name
// $input_name (string)  => input name
// $input_value (string) => input value
// $smaller (int)        => for smaller width of input (value: 1)
// @return: text input HTML code
function rt_admin_form_input_text( $label_name, $input_name, $input_value = NULL, $smaller = NULL ) {

    // Set smaller class value
    if ( $smaller ) {
        $smaller = ' smaller';
    } else {
        $smaller = '';
    }

    // Input
    echo '
    <div class="tsf-row">
        <div class="tsf-label">
            <label for="' . $input_name . '">' . $label_name . '</label>
        </div>
        <div class="tsf-input' . $smaller . '">
            <input id="' . $input_name . '" name="' . $input_name . '" type="text" value="' . $input_value . '">
        </div>
    </div>';

}

/*
 * Checkbox input
 */

// @params:
// $label_name (string) => label name
// $name (string)       => checkbox name
// $value (string)      => checkbox value
// @return: checkbox input HTML code
function rt_admin_form_input_checkbox( $label_name, $name, $value = NULL ) {

    // Set checked value
    if ( $value != '' ) {
        $checked = ' checked';
    } else {
        $checked = '';
    }

    // Checkbox
    echo '
    <div class="tsf-row">
        <div class="tsf-label">
            <label for="' . $name . '">' . $label_name . '</label>
        </div>
        <div class="tsf-input">
            <input id="' . $name . '" name="' . $name . '" type="checkbox"' . $checked . '>
        </div>
    </div>';

}

/*
 * Hidden input
 */

// @params:
// $input_name (string)  => input name
// $input_value (string) => input value
// @return: hidden input HTML code
function rt_admin_form_input_hidden( $input_name, $input_value ) {

    echo '<input name="' . $input_name . '" type="hidden" value="' . $input_value . '">';

}

/*
 * Link for input
 */

// @params:
// $link (string) => anchor link
// $text (string) => anchor text
// @return: link HTML code
function rt_admin_form_input_link( $link, $text ) {

    echo '<a href="?' . $link . '">' . $text . '</a>';

}

/*
 * File input
 */

// @params:
// $label_name (string) => label name
// $input_name (string) => input name
// $image_name (string) => image name
// $image_id (int)      => image ID
// @return: file input HTML code
function rt_admin_form_input_image( $label_name, $input_name, $image_name = NULL, $image_id = NULL ) {

    // File input
    echo '
    <div class="tsf-row">
        <div class="tsf-label">
            <label for="' . $input_name . '">' . $label_name . '</label>
        </div>
        <div class="tsf-input">';

    // Get file uploader HTML code
    rt_admin_form_file_uploader( $input_name, $image_name, $image_id );

    echo '
        </div>
    </div>';

}

/*
 * Set file uploader HTML
 */

// @params:
// $input_name (string) => input name
// $image_name (string) => image name
// $image_id (int)      => image ID
// @return: file uploader HTML code
function rt_admin_form_file_uploader( $input_name, $image_name, $image_id ) {

    /* --- If image is in db --- */
    if ( $image_id ) :
    ?>
        <a id="<?php echo $input_name; ?>" href="#" class="file-upload">
            <?php
            // Set image URL
            if ( $image_name ) {
                $uploads_dir_url = wp_get_upload_dir();
                $image_url = $uploads_dir_url[ 'url' ] . '/' . $image_name;
            } else {
                $image_url = '';
            }

            // Display image
            ?>
            <img src="<?php echo $image_url; ?>">
        </a>

        <?php
        // Display inputs
        ?>

        <a href="#" class="file-remove"><?php echo _e( 'Zmazať obrázok' ); ?></a>
        <input type="hidden" name="<?php echo $input_name; ?>_id" value="<?php echo $image_id; ?>">
        <input type="hidden" name="<?php echo $input_name; ?>" value="<?php echo $image_name; ?>">

    <?php
        /* --- If image is not in db --- */
        /* Display inputs */ else : ?>
        <a href="#" class="button file-upload"><?php echo _e( 'Nahrať obrázok' ); ?></a>
        <a href="#" class="file-remove" style="display: none;"><?php echo _e( 'Zmazať obrázok' ); ?></a>
        <input type="hidden" name="<?php echo $input_name; ?>_id" value="">
        <input type="hidden" name="<?php echo $input_name; ?>" value="">

    <?php endif;

}

/*
 * Show image in file uploader
 */

// @params:
// $image_name (string) => image name
// @return: image HTML code
function rt_admin_form_show_image( $image_name ) {

    $uploads_dir_url = wp_get_upload_dir();

    echo '
    <img src="' . $uploads_dir_url[ 'url' ] . '/' . $image_name . '" alt="' . $image_name . '">';

}

/*
 * Select box
 */

// @params:
// $label_name (string)         => label name
// $select_name (string)        => select name
// $select_values_array (array) => array with values for select
// $selected_value (string)     => selected value
// @return: select box HTML code
function rt_admin_form_select( $label_name, $select_name, $select_values_array, $selected_value = NULL ) {

    echo '
    <div class="tsf-row">
        <div class="tsf-label">
            <label for="' . $select_name . '">' . $label_name . '</label>
        </div>
        <div class="tsf-input">
            <select id="' . $select_name . '" name="' . $select_name . '">
                <option value="">---</option>';

            foreach ( $select_values_array as $key => $value ) {

                if ( $value == $selected_value ) {
                    $selected = ' selected';
                } else {
                    $selected = '';
                }

                echo '
                <option value="' . $value . '"' . $selected . '>' . $key . '</option>';

            }

    echo '
            </select>
        </div>
    </div>';

}

/*
 * Get the list of the WP pages for the selectbox
 */
function page_list_for_select() {

    // Initialize wpdb
    global $wpdb;

    // Declare array for pages
    $pages_array = array();

    // Select all pages
    $result = $wpdb->get_results( "SELECT post_name, post_title
                                   FROM {$wpdb->prefix}posts
                                   WHERE post_type = 'page' AND
                                         post_name != ''
                                   ORDER BY post_title" );

    // If MySQL error
    if ( $wpdb->last_error ) {
        _e( 'Error', 'akademia-journal' ) . ': ' . $wpdb->last_error;
    } else {
        // MySQL is ok

        // For each position
        foreach ( $result as $page ) {

            // Set options array
            $pages_array[ $page->post_title ] = $page->post_name;

        }

    }

    return $pages_array;

}

/*
 * Textarea
 */

// @params:
// $label_name (string) => label name
// $name (string)       => textarea name
// $value (string)      => textarea value
// $rows (int)          => textarea rows
// @return: textarea HTML code
function rt_admin_form_textarea( $label_name, $name, $value = NULL, $rows = NULL ) {

    // Default textarea rows number
    $rows_default = 3;

    if ( !isset( $rows ) ) {
        $rows = $rows_default;
    }

    // Textarea
    echo '
    <div class="tsf-row">
        <div class="tsf-label">
            <label for="' . $name . '">' . $label_name . '</label>
        </div>
        <div class="tsf-input">
            <textarea id="' . $name . '" name="' . $name . '" rows="' . $rows . '">' . $value . '</textarea>
        </div>
    </div>';

}

/*
 * Submit button
 */

// @params:
// $input_value (string) => input value
// $smaller_space (int)  => smaller margin and padding (value: 1)
// @return: submit button HTML code
function rt_admin_form_submit( $input_value, $smaller_space = NULL ) {

    // Set smaller place class
    if ( $smaller_space ) {
        $additional_class = ' smaller-space';
    } else {
        $additional_class = '';
    }

    echo '
    <div class="tsf-submit' . $additional_class . '">
        <input name="submit" type="submit" value="' . $input_value . '">
    </div>';

}

/*
 * Introduction text
 */

// @params:
// $text (string)           => text
// $additional_css (string) => additional style
// @return: text HTML code
function rt_admin_form_intro( $text, $additional_css = NULL ) {

    echo '
    <div class="tsf-intro ' . $additional_css . '">
        ' . $text . '
    </div>';

}

/*
 * Text with note
 */

// @params:
// $text (string)           => text with note
// $additional_css (string) => additional style
// @return: text HTML code
function rt_admin_form_note( $text, $additional_css = NULL ) {

    echo '
    <div class="tsf-note-row ' . $additional_css . '">
        ' . $text . '
    </div>';

}