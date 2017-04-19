$(document).ready(function() {
	$('.tile-boxes>ul>li').wrapInner('<div class="inner"></div>');

	var $ulGrid = $('.tile-boxes>ul').masonry({
		itemSelector: 'li',
		percentPosition: true
	});

	$ulGrid.imagesLoaded().progress( function() {
		$ulGrid.masonry('layout');
	});

	var $grid = $('.tile-grid').masonry({
		itemSelector: '.grid-item',
		percentPosition: true
	});

	$grid.imagesLoaded().progress( function() {
		$grid.masonry('layout');
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