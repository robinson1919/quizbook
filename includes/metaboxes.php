<?php

if(!defined('ABSPATH')) exit('No direct script access allowed');

function quizbook_exam_add_metaboxes() {
    add_meta_box('quizbook_meta_box', 'Questions Exam', 'quizbook_exam_metaboxes', 'exams', 'normal', 'high', $callback_args = null );
}
add_action('add_meta_boxes', 'quizbook_exam_add_metaboxes');


function quizbook_exam_metaboxes($post) { 
    wp_nonce_field(basename(__FILE__), 'quizbook_exam_nonce');
?>

    <table class="form-table">
        <tr>
            <th class="row-title" colspan="2">
                <h2>Select the answers that will include this exam</h2>
            </th>
        </tr>
        
        
        <tr>
            <th class="row-title">
                <label>Choose from the list.</label>
            </th>
            <td>
                <?php
                    $args = array(
                        'post_type' => 'quizes',
                        'posts_per_page' => -1
                    );
                    $questions = get_posts($args);
                    
                    if($questions):  

                        $selected = maybe_unserialize(get_post_meta($post->ID, 'quizbook_exam', true));?>
                       
                        <select data-placeholder="Choose the questions..." class="chosen-select large-text" multiple tabindex="4" name="quizbook_exam[]">
                            <option value=""></option>
                            <?php foreach($questions as $question): 
                                
                                if($selected){?>
                                    <option <?php echo in_array($question->ID, $selected) ? 'selected' : ''; ?> value="<?php echo $question->ID; ?>"><?php echo $question->post_title; ?></option>
                                <?php }else{ ?>
                                    <option value="<?php echo $question->ID; ?>"><?php echo $question->post_title; ?></option>
                                <?php } ?>
                            
                            <?php endforeach; ?>
                        </select>

                <?php else:
                    echo "<p>Before start, please add questions to Quizes.</p>";
                endif; wp_reset_postdata()?>
            </td>
        </tr> 
    </table>
<?php
}



function quizbook_exam_save_metaboxes($post_id, $post, $update) {
    

    if(!isset($_POST['quizbook_exam_nonce']) || !wp_verify_nonce( $_POST['quizbook_exam_nonce'], basename(__FILE__)  ) )
        return $post_id;
    
    if(!current_user_can('edit_post', $post_id))
        return $post_id;
    
    if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
        return $post_id;
    
    
    $answers = '';
    $array_answers = array();
    
    if(isset($_POST['quizbook_exam'])) {
        $answers =  $_POST['quizbook_exam'] ;
        
        foreach($answers as $answer):
            $array_answers[] = sanitize_text_field($answer);
        endforeach;
    }
    update_post_meta($post_id, 'quizbook_exam', maybe_serialize( $array_answers ) );
}
    
    add_action('save_post', 'quizbook_exam_save_metaboxes', 10, 3);