<?php
if(!defined('ABSPATH')) exit('No direct script access allowed');

/*
*   Adds a new column
*/

function views_column($defaults) {
    $defaults['shortcode'] = 'Shortcode';
    return $defaults;
}
add_filter('manage_exams_posts_columns', 'views_column');



/*
*   Shows the value
*/
function display_exam_views($column_name) {
    if($column_name === 'shortcode') {
        $exam_id = get_the_ID();
        echo "[quizbook_exam questions='' order='' id='$exam_id']";
    }
}
add_action('manage_exams_posts_custom_column', 'display_exam_views',5,1);