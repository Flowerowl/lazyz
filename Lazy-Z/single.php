<?php get_header();?>
<div id="mainsingle">
	<?php while(have_posts()) : the_post(); ?>
	<article class="content">
			<header>
				<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><h2>
			</header>
			
			<section>
				
				<?php the_content();?>
				
			</section>
			<footer>
				<ul class="meta">
					<li><img src="<?php bloginfo('template_url'); ?>/images/date.png"/><?php the_time('y-m-d') ?></li>
					<li><img src="<?php bloginfo('template_url'); ?>/images/comments.png"><?php comments_number('&nbsp;','+1','+%'); ?> </li>
					<li><img src="<?php bloginfo('template_url'); ?>/images/views.png"><?php if(function_exists('the_views')) { the_views(); } ?></li>
					<li><img src="<?php bloginfo('template_url'); ?>/images/tags.png"><?php if(get_the_tags())the_tags('');
				else echo '还没有标签呢'; ?></li>
				</ul>
			</footer>
		<div id="comment"><?php comments_template('', true); ?></div>
		</article>
		<?php endwhile;?>

</div>

<?php get_footer();?>