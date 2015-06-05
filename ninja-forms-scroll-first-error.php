<?php
/**
 * Plugin Name: Ninja Forms - Scroll to First Error
 * Author: Kyle B. Johnson
 * Description: Scroll to First Error
 * Version: 0.0.1
 */


/** ------------------------------ */


/**
 * Scroll to First Error
 */

function ninja_forms_scroll_js() {
    global $ninja_forms_processing;

    // If there are ninja-forms form errors
    if( isset($ninja_forms_processing) && $all_errors = $ninja_forms_processing->get_all_errors() ) {

        if ( is_array( $all_errors ) ) {

            // Get First Error
            $first_error = array_values($all_errors)[0];

            // Build Form ID from ninja-forms naming convention
            $field_id = "ninja_forms_field_" . $first_error['location'];

            // Output Inline Script
            ?><script>
                window.location.href = "#<?php echo $field_id; ?>";
                setTimeout(function(){
                    window.scrollBy(0, -100);
                }, 1);

            </script><?php

        }

    }
}

// Add to Page after Form, when other ninja-forms scripts enqueue
add_action( 'ninja_forms_display_js', 'ninja_forms_scroll_js' );
