<?php
class block_youtube_list extends block_base {
	
	function init() {
		$this->title = get_string('formaltitle', 'block_youtube_list');
		$this->version = 2009051100;
	}
	
    function preferred_width() {
        return 210;
    }

	function instance_allow_config() {
		return true;
	}
	
	function get_content() {
		global $CFG;
		if (isset($this->config) && isset($this->config->block_youtube_list_jquery) && $this->config->block_youtube_list_jquery == '0') {
			require_js(array($CFG->wwwroot.'/blocks/youtube_list/js/functions.js'), 1);
		} else {
			require_js(array($CFG->wwwroot.'/blocks/youtube_list/js/jquery-1.3.2.min.js', $CFG->wwwroot.'/blocks/youtube_list/js/functions.js'), 1);
		}
		$this->content = new stdClass;
		$this->content->text = '<a name="video_youtube_player" id="video_youtube_player"></a>';
		$doc = new DOMDocument();
		$doc->load($this->config->block_youtube_list_url);
		$arrFeeds = array();
		$i=0;
		foreach ($doc->getElementsByTagName('entry') as $node) {
			if($i == 0) {
				$this->content->text .= '<div id="video_youtube" align="center" style="margin:0px; padding-bottom:5px;">'.
					'<object width="200" height="180"><param name="movie" value="' . str_replace(array('/watch/', '/watch?v='), 
					'/v/', $node->getElementsByTagName('link')->item(0)->getAttribute('href')) . 
					'"></param><param name="wmode" value="transparent"></param><embed src="' . 
					str_replace(array('/watch/', '/watch?v='), '/v/' , $node->getElementsByTagName('link')->item(0)->getAttribute('href')) . 
					'" type="application/x-shockwave-flash" wmode="transparent" width="200" height="180"></embed></object>'.'</div>';
			}
			$itemRSS = array ( 
				'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
				'link' => $node->getElementsByTagName('link')->item(0)->getAttribute('href')
				);
			array_push($arrFeeds, $itemRSS);
			$i++;
		}
		
		$this->content->text .= "<select name=\"youtube_videos\" onchange=\"javascript:showVideo(this.value)\" style=\"width: 205px;\">";
		
		foreach ($arrFeeds as $entry) {
			$this->content->text .= "<option value='".str_replace(array('/watch/', '/watch?v='), '/v/' , $entry["link"])."'>".$entry["title"]."</option>";
		}
		
		$this->content->text .= "</select>";
		return $this->content;
	}
}
?>