// JavaScript Document
function showVideo(url) {
	$('#video_youtube').html('<object width="200" height="180"><param name="movie" value="' + url + 
							 '"></param><param name="wmode" value="transparent"></param><embed src="' + url + 
							 '" type="application/x-shockwave-flash" wmode="transparent" width="200" height="180"></embed></object>');
	$('#video_youtube').show();
}