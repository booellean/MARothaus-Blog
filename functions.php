<?php

//==============================================================//
//function to call scripts/css

function MARothaus_scripts_enqueue() {
    
    wp_enqueue_style('customprint', get_template_directory_uri() .'/css/normalize.css', array(), '1.0.0', 'all');
	wp_enqueue_style('customstyle', get_template_directory_uri() .'/css/style.css', array(), '1.0.0', 'all');
	wp_enqueue_style('customprint', get_template_directory_uri() .'/css/print.css', array(), '1.0.0', 'all');
	wp_enqueue_script('customscript', get_template_directory_uri() .'/js/script.js', array(), '1.0.0', true);
	wp_enqueue_script('customform', get_template_directory_uri() .'/js/verify.js', array(), '1.0.0', true);
	wp_enqueue_script('customprint', get_template_directory_uri() .'/js/print.js', array(), '1.0.0', true);
	
}

add_action('wp_enqueue_scripts', 'MARothaus_scripts_enqueue');

function MARothaus_theme_setup() {
	add_theme_support('menus');
	
	register_nav_menu('primary', 'Primary Header Navigation');
	register_nav_menu('secondary', 'Social Media Navigation');
}

add_action('init', 'MARothaus_theme_setup');

add_theme_support('custom-background');
add_theme_support('custom-header');
add_theme_support('post-thumbnails');
add_theme_support('editor-style');
add_theme_support('widgets');


//==============================================================//
//This function is for the avatar-manager plug-in... which doesn't work right now

function custom_avatar_defaults ( $avatar_defaults ) {
	$avatar_url = get_bloginfo( 'template_directory' ) . '/images/avatar-default.png';
	$avatar_defaults[$avatar_url] = __( 'Custom Default Avatar', 'mytextdomain' );

	return $avatar_defaults;
}

add_filter( 'avatar_defaults', 'custom_avatar_defaults' );

//==============================================================//

//if (get_option ('thread_comments')){
//	wp_enqueue_script('commen-reply');
//}

//==============================================================//
//comments function
//code written by GameGrind and modified https://www.youtube.com/watch?v=p2zsIJYBOEg

function custom_comments ($comment, $args, $depth){
	$GLOBALS[' comment '] = $comment; ?>
  <li class="postComment" id="li-comment-<?php comment_ID() ?>">
      <div id="comment-<?php comment_ID(); ?>">
          <div class="postCommentAuthor">
              <?php echo get_avatar($comment, $size='30', $default='<path_to_url>' ); ?>

              <?php echo get_comment_author_link(); ?>
    </div>
          
          <?php if ($comment->comment_approved =='0') : ?>
          <em><?php _e('Your Comment is Awaiting Moderation.') ?> </em>
          <br />
          <?php endif ; ?>
          
          <div class="comment-meta"><a href="<?php echo htmlspecialchars( get_comment_link($comment->comment_ID )) ?>"><?php printf(get_comment_date(), get_comment_time() ) ?> </a> <?php edit_comment_link(__(' (Edit) '), '   ', ' ') ?> </div>                            
          
            <?php comment_text() ?>
          
          <div class="reply">
              <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth'] ))) ?>
              
          </div>
          
          <?php
}

?>