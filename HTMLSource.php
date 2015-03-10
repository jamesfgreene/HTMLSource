<?php

class HTMLSource {
	private $content;
	private $highlightTag;
	private $url;
	private $elementCounts;

	public function __construct($url, $highlightTag) {
		$this->setUrl($url);
		$this->setHighlightTag($highlightTag);
				
		$this->setContentAndElementCountsFromUrl();
	}

	// Highlight a specific HTML tag (and close tag) within the HTML source
	private function getContentWithHighlightedTag($content, $tag='div') {
		$openTagMatchString = "\&lt;".$tag."(.*?)\&gt;"; 
		$pattern = array('/\&lt;'.$tag.'(.*?)\&gt;/s', '/\&lt;\/'.$tag.'\&gt;/s');
		$replacement = '<font color="#FF0000">$0</font>';
		$content = preg_replace($pattern, $replacement, $content);
		
		return $content;
	}

	public function setContentAndElementCountsFromUrl() {
		$url = $this->getUrl();
		if (isset($url)) {
			$content				= file_get_contents($url);
			$htmlEntitiesContent	= htmlentities($content);
			$highlightTag			= $this->getHighlightTag();

			if (isset($highlightTag)) {
				$htmlEntitiesContent = $this->getContentWithHighlightedTag($htmlEntitiesContent, $this->getHighlightTag());
			}
	
			$this->setContent($htmlEntitiesContent);

			// Turn off PHP warnings that will happen depending on the format/makeup of the HTML source.
			libxml_use_internal_errors(true);

			$dom = new DOMDocument();
			$dom->loadHTML($content);
			$elements = $dom->getElementsByTagName('*');
			$elementCounts = array();
			foreach($elements as $element) {
				$elementCounts[$element->tagName]++;
			}

			$this->setElementCounts($elementCounts);
		}		
	}


	public function getUrl() {
		return $this->url;
	}

	public function setUrl($url) {
		$this->url = $url;
	}

	public function getHighlightTag() {
		return $this->highlightTag;
	}

	public function setHighlightTag($highlightTag) {
		$this->highlightTag = $highlightTag;
	}

	public function getContent() {
		return $this->content;
	}

	public function setContent($content) {
		$this->content = $content;
	}

	public function getElementCounts() {
		return $this->elementCounts;
	}

	public function setElementCounts($elementCounts) {
		$this->elementCounts = $elementCounts;
	}
}
?>