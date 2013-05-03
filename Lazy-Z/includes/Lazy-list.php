<section id="posts">
<?php if(have_posts()) : while(have_posts()) : the_post(); ?>

		<article class="text">
			<header>
				<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			</header>
			<section>
				<?php the_excerpt();?>	
			</section>
			<footer>
				<ul class="meta">
					<li><img src="<?php bloginfo('template_url'); ?>/images/date.png"/><?php the_time('Y-m-d'); ?>-<?php the_time('G:i'); ?></li>
					<li><img src="<?php bloginfo('template_url'); ?>/images/comments.png"><?php comments_number('&nbsp;','+1','+%'); ?> </li>
					<li><img src="<?php bloginfo('template_url'); ?>/images/views.png"><?php if(function_exists('the_views')) { the_views(); } ?></li>
					<li><img src="<?php bloginfo('template_url'); ?>/images/tags.png"><?php if(get_the_tags())the_tags('');
				else echo '还没有标签呢'; ?></li>
				</ul>
			</footer>
		</article>
		<?php endwhile; else : ?>
					<div id="searchpost">
					<h2>Page Not Found</h2>
					<p>Looks like the page you're looking for isn't here anymore. Try browsing other posts, or using the search box below.</p>
					</div>
		<?php endif; ?>
		
</section>