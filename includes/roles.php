<?php
/*
* Adds Capabilities
*/

function quizbook_exam_agregar_capabilities() {

    $roles = array( 'administrator', 'editor', 'quizbook' );

    foreach( $roles as $the_role ) {
        $role = get_role( $the_role );
        $role->add_cap( 'read_exams' );
        $role->add_cap( 'edit_exams' );
        $role->add_cap( 'publish_exams' );
        $role->add_cap( 'edit_published_exams' );
                $role->add_cap( 'edit_others_exams' );
    }

    $manager_roles = array( 'administrator', 'editor' );

    foreach( $manager_roles as $the_role ) {
        $role = get_role( $the_role );
        $role->add_cap( 'read_private_exams' );
        $role->add_cap( 'edit_others_exams' );
        $role->add_cap( 'edit_private_exams' );
        $role->add_cap( 'delete_exams' );
        $role->add_cap( 'delete_published_exams' );
        $role->add_cap( 'delete_private_exams' );
        $role->add_cap( 'delete_others_exams' );
    }

}

/**
* Remove Task-level capabilities to Administrator, Editor, and Task Logger.
*/
function quizbook_exam_remover_capabilities() {

    $manager_roles = array( 'administrator', 'editor' );

    foreach( $manager_roles as $the_role ) {
        $role = get_role( $the_role );
        $role->remove_cap( 'read_exams' );
        $role->remove_cap( 'edit_exams' );
        $role->remove_cap( 'publish_exams' );
        $role->remove_cap( 'edit_published_exams' );
        $role->remove_cap( 'read_private_exams' );
        $role->remove_cap( 'edit_others_exams' );
        $role->remove_cap( 'edit_private_exams' );
        $role->remove_cap( 'delete_exams' );
        $role->remove_cap( 'delete_published_exams' );
        $role->remove_cap( 'delete_private_exams' );
        $role->remove_cap( 'delete_others_exams' );
    }

}