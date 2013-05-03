var zw=5000; 
$(document).ready(function(){ 
$("#inner").css("display","none");
$("#home").bind("click",Fadeout); //为btnFadein绑定click时间 
$("#close").bind("click",Fadein); //为btnFadeout绑定click时间
$(".pagenavi a").live("click", function(){
        $(this).addClass("loading").append('<img src="http://lazynight.me/loading.gif">');
        $.ajax({
			type: "POST",
            url: $(this).attr("href") + "#posts",
            success: function(data){
				$("#posts").width(zw+=6000);
                result = $(data).find("#posts .text");
                nextHref = $(data).find(".pagenavi a").attr("href");
                // 渐显新内容
                $("#posts").append(result.fadeIn(300));
                $(".pagenavi a").removeClass("loading").text("LOAD MORE");
                if ( nextHref != undefined ) {
                    $(".pagenavi a").attr("href", nextHref);
                } else {
                    $(".pagenavi").remove();
                }
            }
        });
        return false;
    });
}) 
function Fadein(){ 
$("#inner").slideUp("slow"); //滑入 
} 
function Fadeout(){ 
$("#inner").slideDown("slow"); //滑出 
} 
$(function(){$("#site h1 a").hover(function(){$("#qr").fadeIn('fast');},function(){$("#qr").fadeOut('fast');});})

function scrollToLeftOrRight(){
var nScroll = $('#main');
var nScrollWidth = nScroll[0].scrollWidth;
var nScrollNowWidth = nScroll.width();
var nScrollNowPlace = nScroll.scrollLeft();
if((nScrollNowWidth/2 + nScrollNowPlace) <= nScrollWidth/2){ //小于二分之一
nScroll.animate({scrollLeft:nScrollWidth - nScrollNowWidth},900);
}else{
nScroll.animate({scrollLeft:0},900);
}
//nScroll.animate({scrollLeft:$(this).offset().right - 100}, 400);
}
document.ondblclick = scrollToLeftOrRight
var x=0;
document.onmousewheel=function(e){
	e=e||window.event;
	if(e.wheelDelta<0||e.detail<0)
	{
		//if($("#main").scrollLeft()<5000)
		//{
			x+=500;
			$("#main").animate({scrollLeft:x},0);
		//}
	}
	if(e.wheelDelta>0||e.detail>0)
	{
		if($("#main").scrollLeft()>0)
		{
			x-=500;
			$("#main").animate({scrollLeft:x},0);
		}
	}
}




