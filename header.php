<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php wp_title('&laquo;',true,'right');?><?php bloginfo('name');?></title>

<link rel="shortcut icon" href="<?php bloginfo('template_url');?>/images/favicon.ico" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url');?>" type="text/css" media="screen" />

<script type="text/javascript" src="<?php bloginfo('template_url');?>/js/custom.js"></script>

<?php if ( is_singular() ){ ?>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/comments-ajax.js"></script>
<?php } ?>
<?php wp_head();?>
</head>
<body>
<!--[if IE 6]>
	<script type="text/javascript" src="http://letskillie6.googlecode.com/svn/trunk/letskillie6.zh_CN.pack.js"></script>
<![endif]-->
<div id="R_loading">页面加载中...</div>
	<div id="container">
		<div id="header">
        	<h1 id="site-title"><a href="<?php echo get_option('home'); ?>">www.coolzilj.com</a></h1>
            <div id="mainmenu">
            	<ul class="menu">
 					<?php wp_list_pages('title_li=');?>
                    <?php wp_list_categories('show_count=0&title_li=&hide_empty=0');?>
                </ul> 
            </div><!--mainmenu-->
			<?php get_sidebar(); ?>
        </div><!--header-->