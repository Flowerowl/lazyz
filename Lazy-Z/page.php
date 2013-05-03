<?php get_header();?>
<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
<div id="mainsingle">
		<article class="content">
			<header>
				<h2 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a><h2>
			</header>
			<section>
				<?php the_content();?>	
			</section>
			<div id="comment"><?php comments_template('', true); ?></div>
		</article>
		<?php endwhile; else : ?>
					<h2>Page Not Found</h2>
					<p>Looks like the page you're looking for isn't here anymore. Try browsing the <a href="">categories</a>, <a href="">archives</a>, or using the search box below.</p>
					<?php include(TEMPLATEPATH.'/searhform.php'); ?>	
		<?php endif; ?>	

</div>
<?php get_footer();?>