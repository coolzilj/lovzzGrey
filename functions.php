<?php
/************************************************************************************
 * Custom Functions *
 ************************************************************************************/
function post_copyright(){
          if(is_single()){
                    global $post,$authordata;
?>
<div id="copyright">
<?php echo get_avatar($authordata->ID,'55');?>
	<div>
		<p>作者：<a href="<?php echo $authordata->user_url; ?>" title="<?php echo $authordata->display_name;?>"><?php echo $authordata->display_name;?></a><br />
		原文链接：<a href="<?php echo get_permalink($post->ID);?>" title="<?php echo $post->post_title; ?>"><?php echo $post->post_title; ?></a><br />
		版权声明：自由转载-非商用-非衍生-保持署名 | <a href="http://creativecommons.org/licenses/by-nc-nd/3.0/deed.zh">Creative Commons BY-NC-ND 3.0</a></p>
	</div>
</div>
<?php
          }
}
add_filter('the_content','post_copyright_content');
function post_copyright_content($text){
          ob_start();
          post_copyright();
          $post_copyright_content = ob_get_contents();
          ob_end_clean();
          return $text.$post_copyright_content;
}
?>
<?php
function most_comm_posts($days=7, $nums=5) { //$days参数限制时间值，单位为‘天’，默认是7天；$nums是要显示文章数量
	global $wpdb;
	$today = date("Y-m-d H:i:s"); 
	$daysago = date( "Y-m-d H:i:s", strtotime($today) - ($days * 24 * 60 * 60) );  
	$result = $wpdb->get_results("SELECT comment_count, ID, post_title, post_date FROM $wpdb->posts WHERE post_date BETWEEN '$daysago' AND '$today' ORDER BY comment_count DESC LIMIT 0 , $nums");
	$output = '';
	if(empty($result)) {
		$output = '<li>None data.</li>';
	} else {
		foreach ($result as $topten) {
			$postid = $topten->ID;
			$title = $topten->post_title;
			$commentcount = $topten->comment_count;
			if ($commentcount != 0) {
				$output .= '<li><a href="'.get_permalink($postid).'" title="'.$title.'">'.$title.'</a> '.$commentcount.'条评论</li>';
			}
		}
	}
	echo $output;
}
?>
<?php if(function_exists('register_sidebar')) register_sidebar(); ?>
<?php add_custom_background(); ?>
<?php  function lovzzGrey_comment($comment, $args, $depth) {
	   $GLOBALS['comment'] = $comment; 
	   //主评论计数器初始化 begin – by zwwooooo
		global $commentcount;
		if(!$commentcount) { //初始化楼层计数器
		$page = get_query_var(‘cpage’)-1;
		$cpp=get_option(‘comments_per_page’);//获取每页评论数
		$commentcount = $cpp * $page;
		} ?>

	   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
		 <div id="comment-<?php comment_ID(); ?>">
		  <div class="comment-author vcard">
			 <?php echo get_avatar($comment,$size='48',$default='<path_to_url>' ); ?>
			 <?php printf(__('<cite class="fn">%s</cite> <span class="says">says:</span>'), get_comment_author_link()) ?>
			 
		  </div>
		  <?php if ($comment->comment_approved == '0') : ?>
			 <em><?php _e('你的评论正在等待审查.') ?></em>
			 <br />
		  <?php endif; ?>

		  <div class="comment-meta commentmetadata"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('(Edit)'),'  ','') ?></div>
		  
		  <div class="mailtocommenter_button">
			<span class="floor"><?php if(!$parent_id = $comment->comment_parent) {printf('%1$s楼', ++$commentcount);} ?></span>
			<?php if(function_exists('mailtocommenter_button')) mailtocommenter_button();?>
		  </div>

		  <?php comment_text() ?>
		  
		  <div class="reply">
			 <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		  </div>
		 </div>
<?php
        }
?>
<?php 
/************************************************************************************
 * 特色图片设置功能 *
 ************************************************************************************/
add_theme_support("post-thumbnails");
?>
<?php 
/************************************************************************************
 * 评论链接重写 *
 ************************************************************************************/
function add_redirect_comment_link($text = ''){
	$text=str_replace('href="', 'href="'.get_option('home').'/?r=', $text);
	$text=str_replace("href='", "href='".get_option('home')."/?r=", $text);
	return $text;
}
function redirect_comment_link(){
	$redirect = $_GET['r'];
	if($redirect){
		if(strpos($_SERVER['HTTP_REFERER'],get_option('home')) !== false){
			header("Location: $redirect");
			exit;
		}
		else {
			header("Location: ".bloginfo('url')."/");
			exit;
		}
	}
}
add_action('init', 'redirect_comment_link');
add_filter('get_comment_author_link', 'add_redirect_comment_link', 5);
add_filter('comment_text', 'add_redirect_comment_link', 99);
?>