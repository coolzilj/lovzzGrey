<?php get_header();?>
<div id="main">
<?php if (have_posts()) : ?>
	<?php while(have_posts()) : the_post();?>
	
	<div class="content">
		<div class="post">
			<div class="post_data">
				<h2 class="title"><?php the_title();?></h2>
				<h3>
						<span>日期：<?php the_time('Y年n月j日');?></span>
						<span>评论次数：<?php comments_popup_link('No Comments »', '1 Comment »', '% Comments »'); ?></span>
						<span>浏览次数：<?php if(function_exists('the_views')) { the_views(); } ?></span>
						<span><?php edit_post_link(); ?></span>
				</h3>
			</div>
			<?php the_content('');?>
		</div>
    </div>
    <?php endwhile; ?>
<?php endif; ?>
</div>
<?php get_footer(); ?>