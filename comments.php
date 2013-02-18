<?php
// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');
/*	if ( post_password_required() ) { ?>
		<p class="nocomments">This post is password protected. Enter the password to view comments.</p>
	<?php
		return;
	}*/
$countComments = 0;
$countPings = 0;
if($post->comment_count > 0) {
	$comments_list = array();
	$pings_list = array();
	$count=1;
	foreach($comments as $comment) {
		if('comment' == get_comment_type()) $comments_list[++$countComments] = $comment;
		else $pings_list[++$countPings] = $comment;
	}
}
?>
<div id="comments">
	<?php if ( have_comments() ) : ?>
			<h2 id="comments-title"><?php comments_number('0', '1', '%' );?> Comments.</h2>
			
			<ol class="commentlist" id="thecomments">
					<?php wp_list_comments('avatar_size=4&type=comment&callback=lovzzGrey_comment'); ?>
			</ol>
			<div class="wp-pagenavi commentnavi"><?php paginate_comments_links(); ?></div>
	<?php else : // 没有评论时显示
	?>
		<?php if ('open' == $post->comment_status) : ?>

			<h2 id="comments-title"><?php comments_number('0', '1', '%' );?> Comments.</h2>
		<?php else : // 评论关闭
		?>

			<h2 id="comments-title" class="nocomments">评论已关闭</h2>
		<?php endif; ?>
	<?php endif; ?>
	<?php if ('open' == $post->comment_status) : ?>
		<div id="respond">
			<h2><?php comment_form_title( 'Leave a Reply', 'Leave a Reply to %s' ); ?></h2>

<?/*			<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
					<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>
			<?php else : ?> */?>
			
			<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
				<?php if ( $user_ID ) : ?>
						<p class="loggedin">已登陆 <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">退出登陆 &raquo;</a></p>
						<div class="clear"></div>
				<?php else : ?>
						<fieldset>
                        	<div class="fields">
                            	<label for="author">名字：</label>
                                <input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" />
                                
                                <label for="email">邮件：</label>
                                <input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" />
                                
                                <label for="url">网址：</label>
                                <input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" />
                             </div> 
				<?php endif; ?>
						<div class="comment">
							<textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4" onkeydown="if(event.ctrlKey&&event.keyCode==13){document.getElementById('submit').click();return false};"></textarea>
							
							<input name="submit" type="submit" class="commentsubmit" id="submit" tabindex="5" value="猛击提交/[ Ctrl + Enter ] " /> <?php comment_id_fields(); ?>
							<!-- <span><a href="http://www.hzlzh.com/comments/feed/" class="feed" rel="nofollow">订阅评论Feed</a></span> -->
						</div>
						<?php do_action('comment_form', $post->ID); ?>
						</fieldset>
			</form>
			<div class="cancel-comment-reply">
				<small><?php cancel_comment_reply_link(); ?></small>
			</div>
			<?php // endif; 需要注册或者还没登陆
			?>
		</div>
	<?php endif; // if you delete this the sky will fall on your head
	?>
	<?php if($countPings > 0) : ?>
		<div class="trackbacks-pingbacks">
			<h3>Trackbacks and Pingbacks:</h3>
			<ul id="pinglist">
				<?php foreach($pings_list as $comment) : 
						if('pingback' == get_comment_type()) $pingtype = 'Pingback';
						else $pingtype = 'Trackback';
				?>
				<li id="comment-<?php echo $comment->comment_ID ?>">
					<?php comment_author_link(); ?> - <?php echo $pingtype; ?> on <?php echo mysql2date('Y/m/d/ H:i', $comment->comment_date); ?>
				</li>
				<?php endforeach; ?>
				<?php $count++; ?>
			</ul>
		</div>
	<?php endif; ?>
</div><!--END COMMENTS-->