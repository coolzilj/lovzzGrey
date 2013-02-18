<?php
/*
Template Name: Guestbook
*/
?>
<?php get_header();?>
<div id="main">
	<?php if (have_posts()) : ?>
	<?php while(have_posts()) : the_post();?>
    <div <?php post_class();?>>
    	<div class="content">
			<?php the_content('');?>
		</div>
    </div>

    <?php comments_template('/guestcomments.php'); ?>
 
    <?php endwhile; ?>
    
    <?php else : ?>
    <div class="post">
    	<h2>404</h2>
        <p>看来客官你走错地方了，你进来了不该进来的地方。</p>
        <p><a href="<?php echo get_option('home'); ?>">回到首页</a></p>
    </div>
	<?php endif; ?>
</div>
<?php get_footer(); ?>