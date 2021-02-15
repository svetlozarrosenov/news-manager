$('.news__actions').on('click', '.paging__next', function(e){
	e.preventDefault();

	let $nextPage = $(this).attr('href');
	let $spinner = $(".spinner");

	$.ajax({
		type: "GET",
		url: $nextPage,
		beforeSend: function(msg){
			$spinner.show();
		},
		success: function(response){
			let $oldPageNews = $('.news .news-container');
			let nextPageNews = $(response).find('.news-container .news-item');

			let $oldPagePagging = $('.news .news__actions');
			let $nextPagePagging = $(response).find('.paging');
			
			$oldPageNews.append(nextPageNews);

			$oldPagePagging.html($nextPagePagging);

			$spinner.hide();
		}
    });	
});