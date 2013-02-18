<div id="sidebar">
	<ul>
	<?php if(!function_exists('dynamic_sidebar') || !dynamic_sidebar()): ?>
		<li>
			<div id="new_posts" class="widget">
				<h2>最新鲜的文章</h2>
				<ul>
				<?php wp_get_archives('title_li=&type=postbypost&limit=5'); ?>
				</ul>
			</div>
		</li>
		<li>
			<div id="most_comm_posts" class="widget">
				<h2>被唠叨最多文章</h2>
				<ul>
				   <?php if(function_exists('most_comm_posts')) most_comm_posts(1000,5); ?>
				   
				</ul>
			</div>
		</li>
		<li>
			<div id="most_read_posts" class="widget">
				<h2>被围观最多文章</h2>
					<?php if (function_exists('get_most_viewed')): ?>
					   <ul>
						  <?php get_most_viewed('post',5); ?>
					   </ul>
					<?php endif; ?>
			</div>
		</li>
		<li>
			<div id="friends" class="widget">
				<h2>朋友们</h2>
				<ul>
					<?php wp_list_bookmarks('orderby=id&categorize=0&show_description=1$show_images=1&title_li='); ?>
				</ul>
			</div>
		</li>
		<li>
			<div id="admin" class="widget">
				<h2>管理</h2>
				<a href="<?php echo wp_login_url( $redirect ); ?>">登录</a>  
			</div>
		</li>
	<?php endif; ?>
	</ul>
</div>