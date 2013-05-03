<!DOCTYPE HTML>
<head>
<meta charset="UTF-8"/>
<?php if (is_home()||is_search()||is_tag()||is_page()||is_404()){
$u_description = get_option('bzd_description');$u_keywords = get_option('bzd_keywords');
$keywords = $u_keywords;
$description = $u_description;
} 
elseif (is_category()){
$keywords = single_cat_title('', false);
$description = get_bloginfo('name') . " - 有关'" . single_cat_title('', false) . "'的文章";
}
elseif (is_single()){
if ($post->post_excerpt) {
	$description = $post->post_excerpt;
} else {
	$description = mb_strimwidth(strip_tags($post->post_content),0,200);
}
$keywords = "";
$tags = wp_get_post_tags($post->ID);
foreach ($tags as $tag ) {
	$keywords = $keywords . $tag->name . ", ";
}}
else {
$keywords = trim( wp_title('', false) );
$description = get_bloginfo('name') . " " . trim( wp_title('', false) );
}
?>
<meta name="description" content="<?php echo $description?>" />
<meta name="keywords" content="<?php echo $keywords?>" />
<title><?php wp_title(' - ', true, 'right'); bloginfo('name'); if (!is_single () && !is_404()) echo " - ", bloginfo('description'); if ($paged > 1) echo ' - Page ', $paged; ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="icon" href="<?php bloginfo('template_url'); ?>/images/favicon.ico" type="image/x-ico" />
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" media="screen" />
<?php wp_head(); ?>
<!--[if lt IE 9]>
		<script src="<?php echo get_bloginfo('template_directory');?>/scripts/html5.js"></script>
<![endif]-->
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/scripts/jquery-1.6.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/scripts/Lazy-Z.js"></script>
</head>
<body>
<nav id="top-bar">
<div id="comer"><script type="text/javascript">eval(function(p,a,c,k,e,d){e=function(c){return c};if(!''.replace(/^/,String)){while(c--){d[c]=k[c]||c}k=[function(e){return d[e]}];e=function(){return'\\w+'};c=1};while(c--){if(k[c]){p=p.replace(new RegExp('\\b'+e(c)+'\\b','g'),k[c])}}return p}('6(2.0){2.0=7(2.0)+1;5.4("欢迎您第 <3>"+2.0+"</3> 次回访本站.")}8{2.0=1;5.4("欢迎您的初访，新朋友。")}',9,9,'pagecount||localStorage|span|write|document|if|Number|else'.split('|'),0,{}));</script>
</div>
<div class="header_nav">
		<div id="qr" ><img src="<?php bloginfo('template_url'); ?>/images/Lazy-Code.gif"></div>
		<?php wp_nav_menu( array('theme_location' => 'header_nav') ); ?>		
</div>
</nav>
<div id="container">
	<header id="site">
	<!-- JiaThis Button BEGIN -->

		<h1><a href="<?php bloginfo('url'); ?>/"><?php bloginfo('name'); ?></a></h1>
		<section id="description">
		<p><?php  bloginfo('description'); ?></p>
			
			<div id="avatar">
				<img src="<?php bloginfo('template_url'); ?>/images/sinking.jpg"/>
			</div>
			<p><?php the_author_description(); ?></p>
			<div id="follow">
				<a href="http://feed.feedsky.com/lazynight" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/rss2.png"/></a>	
				<a href="http://weibo.com/u/1959230741" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/sina.png"/></a>	
				<a href="http://www.songtaste.com/user/1201428/" target="_blank"><img src="<?php bloginfo('template_url'); ?>/images/ST.png"/></a>	
			</div>
			<h3>关于夜阑</h3>
			<div id="about">
				夜阑是一个个人博客,成立于2011年2月2日，喜交编程之友，欢迎骚扰，欢迎批评。站长QQ：51094261
			</div>
				<div id="ckepop">
				<a class="jiathis_button_qzone"></a>
				<a class="jiathis_button_tsina"></a>
				<a class="jiathis_button_tqq"></a>
				<a class="jiathis_button_renren"></a>
				<a class="jiathis_button_kaixin001"></a>
				<a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank"></a>
				<a class="jiathis_counter_style"></a>
			</div>
			<script type="text/javascript" src="http://v2.jiathis.com/code/jia.js" charset="utf-8"></script>
			<!-- JiaThis Button END -->
		</section>
	</header>