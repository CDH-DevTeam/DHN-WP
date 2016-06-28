$(document).ready(function() {
	$('.tile-boxes>ul>li').wrapInner('<div class="inner"></div>');

	$('.tile-boxes>ul').masonry({
		itemSelector: 'li',
		percentPosition: true
	});

	$('.tile-grid').masonry({
		itemSelector: '.grid-item',
		percentPosition: true
	});

	$('.menu-button').click(function() {
		$('ul.menu').toggleClass('visible');
	});

	$('.tile-grid .grid-item').hover(function() {
		$(this).addClass('hover');
	},
	function() {
		$(this).removeClass('hover');
	})
});