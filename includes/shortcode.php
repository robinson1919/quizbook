<?php
if(!defined('ABSPATH')) exit('No direct script access allowed');

/*
* Adds a Shortcode, use: [quizbook]
*/

function quizbook_exam_shortcode( $atts ) {
/*
*  Checks the id of the shortcode E.g.: [quizbook_examen questions="" order="" id=""]
*/
    $post_id =  (int) $atts['id'];
    
    $questions = get_post_meta($post_id, 'quizbook_exam', true );
    
    $questions_id = maybe_unserialize($questions);
    
    $args = array(
        'post_type' => 'quizes',
        'post__in' => $questions_id,
        'posts_per_page' => $atts['questions'],
        'orderby' =>  $atts['order']
    );
    $quizbook = new WP_Query($args); ?>
    <form name="quizbook_send" id="quizbook_send">
        <div id="quizbook" class="quizbook">
            <ul>
            <?php while($quizbook->have_posts()): $quizbook->the_post(); ?>
                <li data-question="<?php echo get_the_ID(); ?>">
                    <h3><?php the_title(); ?></h3>
                    <?php the_content(); ?>
                    
                    <?php $options = get_post_meta(get_the_ID()); 

                        foreach($options as $key => $option):
                            $result = quizbook_filter_questions($key);
                            unset($result['qb_correct']);
                            $numero = explode('_', $key);
                            
                            if($result === 0) { ?>
                                <div id="<?php echo get_the_ID() . ":" . $numero[2]; ?>" class="answer">
                                    <?php echo $option[0]; ?>
                                </div>
                            <?php } 
                        endforeach;
                    ?>                   
                </li>

            <?php endwhile; ?>
            </ul>
        </div> <!--#quizbook-->
        
        <input type="submit" value="Send" id="quizbook_btn_submit">
        
        <div id="quizbook_result"></div>
    </form><!--form-->
    <?php wp_reset_postdata();
    
}
add_shortcode( 'quizbook_exam', 'quizbook_exam_shortcode' );