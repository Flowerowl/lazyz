<div id="search">
<form method="get" id="searchform" action="<?php bloginfo('url'); ?>/">
<input type="text" value="<?php if(isset($s)) { echo $s; } else { echo "Search..."; } ?>" name="s"  />
<div class="clear"></div>
</form>
</div>
