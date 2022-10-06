/*********************
 *
 *	Slider
 *
 **********************/

var imgNum = $("#banner img").length;
var imgW = $("#banner img:first").width();
var imgH = $("#banner img:first").height();
var nowIndex = 0;
var preIndex = imgNum - 1;
var nexIndex = 1;
$("#slider img:last").on("load", function () {
	imgNum = $("#banner img").length;
});
$(window).resize(function () {
	var winW = $(window).width();
	// imgH = $("#banner img:first").height();
	// console.log("winW: " + winW);
	imgH = (winW / 1600) * 600;
	imgW = $("#banner img:first").width();
	imgNum = $("#banner img").length;
	preIndex = imgNum - 1;
	$("#slider").css({ height: imgH });
	$("#banner li").css({ width: winW });
	for (var i = 0; i < imgNum; i++) {
		if (i > nowIndex) {
			$("#slider ul li").eq(i).css({ left: winW });
		} else if (i < nowIndex) {
			$("#slider ul li").eq(i).css({ left: -winW });
		} else {
			$("#slider ul li").eq(i).css({ left: 0 });
		}
	}
	if (nowIndex == 0) {
		$("#slider ul li")
			.eq(imgNum - 1)
			.css({ left: -imgW });
	}
	if (nowIndex == imgNum - 1) {
		$("#slider ul li").eq(0).css({ left: imgW });
	}
	graphPoint(nowIndex);
});

function nxSlide() {
	imgNum = $("#banner img").length;
	imgW = $("#banner img:first").width();
	nowIndex = nexIndex;
	preIndex = nowIndex - 1;
	nexIndex = nowIndex + 1;
	if (preIndex < 0) {
		preIndex = imgNum - 1;
	}
	if (nexIndex == imgNum) {
		nexIndex = 0;
	}

	$("#slider ul li").eq(preIndex).stop().animate({ left: -imgW }, 200);
	$("#slider ul li").eq(nowIndex).stop().animate({ left: 0 }, 200);
	$("#slider ul li").eq(nexIndex).css({ left: imgW });
	graphPoint(nowIndex);
}
function prSlide() {
	imgNum = $("#banner img").length;
	imgW = $("#banner img:first").width();
	nowIndex = preIndex;
	preIndex = nowIndex - 1;
	nexIndex = nowIndex + 1;
	if (preIndex < 0) {
		preIndex = imgNum - 1;
	}
	if (nexIndex == imgNum) {
		nexIndex = 0;
	}
	$("#slider ul li").eq(preIndex).css({ left: -imgW });
	$("#slider ul li").eq(nowIndex).stop().animate({ left: 0 }, 200);
	$("#slider ul li").eq(nexIndex).stop().animate({ left: imgW }, 200);
	graphPoint(nowIndex);
}
function graphPoint(nowIndex) {
	// console.log("gp: " + nowIndex);
	$(".point").removeClass("nowImgPoint");
	$(".point").eq(nowIndex).addClass("nowImgPoint");
}
