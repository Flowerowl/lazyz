<?php get_header();?>
<div id="main">
	<div id="navigator">
		<ul class="trail">
			<li>
				<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
					<?php /* If this is a category */ if (is_category()) { ?>
				<h4 class="query-info">分类：<?php single_cat_title(); ?></h4>
				<?php /* If this is a tag */ } elseif( is_tag() ) { ?>
				<h4 class="query-info">标签：<?php single_tag_title(); ?> </h4>
				<?php /* If this is a daily */ } elseif (is_day()) { ?>
				<h4 class="query-info">归档： <?php the_time('Y年 m月 j日'); ?> </h4>
				<?php /* If this is a monthly */ } elseif (is_month()) { ?>
				<h4 class="query-info">归档： <?php the_time('Y年 m月'); ?> </h4>
				<?php /* If this is a yearly */ } elseif (is_year()) { ?>
				<h4 class="query-info">归档： <?php the_time('Y年'); ?> </h4>
				<?php /* If this is a paged */ } elseif (isset($_GET['paged']) && !empty($_GET['paged']) && !is_search()) { ?>
				<h4 class="query-info">您正在浏览的是以前的文章</h4>
				<?php } ?>
			</li>
			
		</ul>
	</div>
	<?php include(TEMPLATEPATH.'/includes/Lazy-list.php');?>
</div>
	<?php include(TEMPLATEPATH.'/includes/Lazy-navi.php');?>
<?php get_footer();?>