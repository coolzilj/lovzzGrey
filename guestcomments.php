<?php 
//Do not delete these lines
	if(!empty($_SERVER['SCRIPT_FILENAME'])&&'comments.php'==basename($_SERVER['SCRIPT_FILENAME']))
	die('Please do not load this page directly.Thanks!');
	if( post_password_required()){?>
    	<p class="nocomment">This post is password protected.Enter the password to view comments.</p>
        <?php 
			return;
	}
?>
			<div id="comments" class="clearfix">
            <h2><?php comments_number('No Guestbook Entries','1 Guestbook Entry','% Guestbook Entries');?></h2>
            <?php if (have_comments()): ?>
            <ol class="commentlist">
            	<?php wp_list_comments('avatar_size=71&type=comment');?>
            </ol>
            <div class="pagination clearfix">
                  <p class="older"><?php previous_comments_link('Older comments');?></p>
                  <p class="newer"><?php next_comments_link('Newer comments');?></p>
            </div>
				<?php endif; ?>
                
                <?php if(comments_open()) :?>
            <div id="respond">
                	<h2>说点什么吧！</h2>
                    <form action="<?php echo get_option('siteurl');?>/wp-comments-post.php" method="post" id="commentform">
                    	<fieldset>
                        	<div class="fields">
                            	<label for="author">名字：</label>
                                <input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" />
                                
                                <label for="email">邮件：</label>
                                <input type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" />
                                
                                <label for="url">网址：</label>
                                <input type="text" name="url" id="url" value="<?php echo $comment_author_url; ?>" />
                             </div>
                             <div class="comment">
                             	<textarea name="comment" id="comment" rows="" cols=""></textarea>
                                <input type="submit" class="commentsubmit" value="提交吧" />
                              </div>
                              
                              <?php comment_id_fields(); ?>
                              <?php do_action('comment_form',$post->ID); ?>
                         </fieldset>
                     </form>
                     <p class="cancel"><?php cancel_comment_reply_link('取消回复'); ?></p>
              </div>
              <?php else : ?>
              	<h3>留言本已关闭！</h3>
            <?php endif;?>
          </div><!--Guestbook Entries-->