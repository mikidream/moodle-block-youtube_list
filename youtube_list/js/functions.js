// JavaScript Document
function showVideo(url) {
	$('#video_youtube').html('<object width="260" height="238"><param name="movie" value="' + url + 
							 '"></param><param name="wmode" value="transparent"></param><embed src="' + url + 
							 '" type="application/x-shockwave-flash" wmode="transparent" width="265" height="238"></embed></object>');
	$('#video_youtube').show();
}