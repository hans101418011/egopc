// Techer
// var nowIndex = 0;
// $(window).resize(function () {
// 	var imgH = $("#banner ul li img").height();
// 	$("#banner").css({ height: imgH });
// 	$("#banner ul li")
// 		.css({ left: $("#banner ul li").width() })
// 		.eq(nowIndex)
// 		.css({ left: 0 });
// });
// function nextSlide() {
// 	outImg = $("#banner ul li").eq(nowIndex);
// 	nowIndex++;
// 	if (nowIndex > $("#banner ul li").length - 1) {
// 		nowIndex = 0;
// 	}
// 	$("#banner ul li").eq(nowIndex).animate({ left: 0 }, 1000);
// 	outImg.animate({ left: -$("#banner ul li").width() }, 1000, function () {
// 		$(this).css({ left: $("#banner ul li").width() });
// 	});
// }
// setInterval(nextSlide, 3000);
/*********************
 *
 *
 *
 **********************/

var imgNum = $("#banner img").length;
var imgW = $("#banner img:last").width();
var imgH = $("#banner img:last").height();
var nowIndex = 0;
var preIndex = imgNum - 1;
var nexIndex = 1;
$("#slider img:last").on("load", function () {
	imgNum = $("#banner img").length;
});
$(window).resize(function () {
	var winW = $(window).width();
	imgH = $("#banner img:last").height();
	imgW = $("#banner img:last").width();
	preIndex = imgNum - 1;
	// console.log(preIndex + ", " + nowIndex + ", " + nexIndex);
	// console.log("=================================");
	$("#slider").css({ height: imgH });
	$("#banner li").css({ width: winW });
	// $("#slider").css({ width: imgNum * imgW });

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
});
//

function nxSlide() {
	imgNum = $("#banner img").length;
	imgW = $("#banner img:last").width();
	nowIndex = nexIndex;
	preIndex = nowIndex - 1;
	nexIndex = nowIndex + 1;
	if (preIndex < 0) {
		preIndex = imgNum - 1;
	}
	if (nexIndex == imgNum) {
		nexIndex = 0;
	}
	$("#slider ul li").eq(nowIndex).css({ left: 0 });
	$("#slider ul li").eq(preIndex).css({ left: -imgW });
	$("#slider ul li").eq(nexIndex).css({ left: imgW });
	console.log(preIndex + ", " + nowIndex + ", " + nexIndex);
	console.log("imgNum: " + imgNum);
}
function prSlide() {
	imgNum = $("#banner img").length;
	imgW = $("#banner img:last").width();
	nowIndex = preIndex;
	preIndex = nowIndex - 1;
	nexIndex = nowIndex + 1;
	if (preIndex < 0) {
		preIndex = imgNum - 1;
	}
	if (nexIndex == imgNum) {
		nexIndex = 0;
	}
	$("#slider ul li").eq(nowIndex).css({ left: 0 });
	$("#slider ul li").eq(preIndex).css({ left: -imgW });
	$("#slider ul li").eq(nexIndex).css({ left: imgW });
	console.log(preIndex + ", " + nowIndex + ", " + nexIndex);
	console.log("imgNum: " + imgNum);
}
