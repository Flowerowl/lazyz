<nav id="footer">
	<p><script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3Fbaf4c30c4a0e364248d14771de2ee1cf' type='text/javascript'%3E%3C/script%3E"));
</script></p>
	<p>Theme by <a href="http://lazynight.me" target="_blank">Lazynight</a></p>
	<span id="home"><img src="<?php bloginfo('template_url'); ?>/images/home.png"/></span>
	<?php get_search_form(); ?>	
	<p>
		<?php 
					 $now_usage = round(memory_get_usage()/1024/1024, 2) - system_usage;
					 echo "Memory:  $now_usage MB.";if ( function_exists('get_totalviews')) {
					 if ( function_exists('wp_gzip') ) { ?> Gzipped. <?php } 
					?> Clicked <?php get_totalviews(1);?> 's. <?php } ?><br/>					
	</p>
	
</nav>
<div id="inner">
<span id="close"><img src="<?php bloginfo('template_url'); ?>/images/close.png"></span>
	<div class="widget">
	<h3>最新评论</h3>
		<ul>
			<?php //Recent Comments by zwwooooo
			$show_comments = 10;
			$my_email = get_bloginfo ('admin_email');
			$i = 1;
			$comments = get_comments('number=100&status=approve&type=comment');
			foreach ($comments as $rc_comment) {
				if ($rc_comment->comment_author_email != $my_email) {
					?>
					<li>
						
						<span class="rc_author"><?php echo $rc_comment->comment_author; ?>: </span>
						
						<a href="<?php echo get_comment_link( $rc_comment->comment_ID, array('type' => 'comment')); ?>" title="on <?php echo get_the_title($rc_comment->comment_post_ID); ?>"><?php echo convert_smilies(strip_tags($rc_comment->comment_content)); ?></a>
					</li>
					<?php
					if ($i == $show_comments) break;
					$i++;
				}
			}
			?>
		</ul>
	</div>
	<div class="widget">
		
    	<ul>
        <?php wp_list_bookmarks(); ?>
        </ul>
	</div>
	<div class="widget">
			<h3>存档</h3>
			<ul><?php wp_get_archives(); ?></ul>
	</div>
	
	<div class="widget">
	<h3>标签云</h3>
	
    	<?php wp_tag_cloud('smallest=10&largest=10&number=100'); ?>
	
		
	</div>
	<div class="widget">
	<h3>赞助商</h3>
	<ul>
			<li><a href="http://www.2vancl.cn/ " target="_blank"  >凡客诚品优惠券</a> </li>
			<li><a href="http://www.cnwenger.com/ " target="_blank" >威戈</a> </li>
			<li><a href="http://www.cnosa.com/ " target="_blank" >欧莎品牌服饰旗舰店</a> </li>
			<li><a href="http://www.iyinman.com/ " target="_blank"  >茵曼旗舰店</a> </li>

			<li>广告位招租</li>
			<li>联系QQ:51094261</li>
        </ul>
	</div>
	
</div>
</div>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/scripts/comments-ajax.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/scripts/Three.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/scripts/Bird.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/scripts/RequestAnimationFrame.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/scripts/Fly.js"></script>


<?php wp_footer();?>

</body>
</html>