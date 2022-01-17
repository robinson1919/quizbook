<?php
/* --------------------------------
    Plugin Name: Quizbook Exams
    Plugin URI: https://github.com/robinson1919/quizbook
    Description: Plugin for editing quizes or questionaries
    Version: 1.0.
    Author: Robinson Batista Madrigal
    Author URI: https://github.com/robinson1919
    License: GPL2
    License URI: https://gnu.org/licenses/gpl-2.0.html
    Text Domain: quizbook
*/

if(!defined('ABSPATH')) exit('No direct script access allowed');

/*
*   Checks that the principal plugin exists
*/
function quizbook_exam_check() {
    if(!function_exists('quizbook_post_type')){
        add_action('admin_notices', 'quizbook_exam_activation_error');
        deactivate_plugins(plugin_basename(__FILE__));
    }
}
add_action('admin_init', 'quizbook_exam_check');

/*
*   Throws an error message if the principal plugin does not exist
*/
function quizbook_exam_activation_error() {
    $class = 'notice notice-error';
    $message = 'There was an error you need to install and activate Quizbook';
    printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), esc_html($message));
}

/*
* Create the Post Types for exams
*/
require_once plugin_dir_path(__FILE__) . 'includes/posttype.php';
register_activation_hook(__FILE__, 'quizbook_exams_rewrite_flush'); 


/*
* Adds Roles y Permissions to Quizbook Exams
*/
require_once plugin_dir_path( __FILE__ ) . 'includes/roles.php';
register_activation_hook( __FILE__, 'quizbook_exams_agregar_capabilities' );
register_deactivation_hook( __FILE__, 'quizbook_exams_remover_capabilities' );