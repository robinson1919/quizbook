<?php
if(!defined('ABSPATH')) exit('No direct script access allowed');

add_action( 'init', 'quizbook_exam_post_type' );

function quizbook_exam_post_type() {
	$labels = array(
		'name'               => _x( 'Exams', 'post type general name', '' ),
		'singular_name'      => _x( 'Exam', 'post type singular name', '' ),
		'menu_name'          => _x( 'Exams', 'admin menu', '' ),
		'name_admin_bar'     => _x( 'Examen', 'add new on admin bar', '' ),
		'add_new'            => _x( 'Add Nuevo', 'book', '' ),
		'add_new_item'       => __( 'Add New Examen', '' ),
		'new_item'           => __( 'New Examen', '' ),
		'edit_item'          => __( 'Edit Examen', '' ),
		'view_item'          => __( 'View Examen', '' ),
		'all_items'          => __( 'All Exams', '' ),
		'search_items'       => __( 'Search Exams', '' ),
		'parent_item_colon'  => __( 'Parent Exams:', '' ),
		'not_found'          => __( 'There is not exams yet.', '' ),
		'not_found_in_trash' => __( 'There is not exams in the trash.', '' )
	);

	$args = array(
		'labels'             => $labels,
        'description'        => __( 'Adds the possibility of creating exams for your quizes', '' ),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'exams' ),
		// 'capability_type'    => array('exam', 'exams'),
		'capability_type'    => 'post',
        'menu_position'      => 7,
        'menu_icon'          => 'dashicons-welcome-write-blog',
		'has_archive'        => true,
		'hierarchical'       => false,
        'supports'           => array( 'title', 'author', 'editor'),
        'map_meta_cap'       => true,
	);

	register_post_type( 'exams', $args );
}

add_Action( 'init', 'quizbook_exam_post_type');


/**
 * Flush rewrite rules on activation.
 */
function quizbook_exam_rewrite_flush() {
	quizbook_exam_post_type();
	flush_rewrite_rules();
}