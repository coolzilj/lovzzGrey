<?php get_header();?>
<div id="main">
	<?php if (have_posts()) : ?>
	<?php while(have_posts()) : the_post();?>
	
    <div <?php post_class();?>>
    	<div class="content">
			<div class="post_data">
				<h2 class="title"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h2>
				<h3>
					<span>日期：<?php the_time('Y年n月j日');?></span>
					<span>评论次数：<?php comments_popup_link('No Comments »', '1 Comment »', '% Comments »'); ?></span>
					<span>浏览次数：<?php if(function_exists('the_views')) { the_views(); } ?></span>
					<span><?php edit_post_link(); ?></span>
				</h3>
			</div>
			<?php if(has_post_thumbnail()) : ?>
			<?php the_post_thumbnail(); ?>
			<?php endif; ?>
			<?php the_content('');?>
		</div>
    </div>

    <?php comments_template(); ?>
 
    <?php endwhile; ?>
    
    <?php else : ?>
    <div class="post">
    	<h2>404</h2>
        <p>看来客官你走错地方了，你进来了不该进来的地方。</p>
        <p><a href="<?php echo get_option('home'); ?>">回到首页</a></p>
    </div>
	<?php endif; ?>
</div><!-- end main -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>