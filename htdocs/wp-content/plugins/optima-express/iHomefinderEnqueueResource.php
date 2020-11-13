<?php

class iHomefinderEnqueueResource {
	
	private static $instance;
	private $httpHeaders = array();
	private $httpStatusCode;
	private $header = array();
	private $footer = array();
	private $metaTags = array();

	private function __construct() {
	}
	
	public static function getInstance() {
		if(!isset(self::$instance)) {
			self::$instance = new self();
		}
		return self::$instance;
	}
	
	public function enqueue() {
		wp_enqueue_script("jquery");
		wp_enqueue_script("jquery-ui-core");
		wp_enqueue_script("jquery-ui-tabs");
		wp_enqueue_script("jquery-ui-dialog");
		wp_enqueue_script("jquery-ui-datepicker");
		wp_enqueue_script("jquery-ui-autocomplete", "", array("jquery-ui-widget", "jquery-ui-position"), "1.8.6");
		$remoteRequest = new iHomefinderRequestor();
		$remoteRequest
			->addParameter("requestType", "resources")
			->setCacheExpiration(60*60)
		;
		$remoteResponse = $remoteRequest->remoteGetRequest();
		if($remoteResponse->hasCss()) {
			$items = $remoteResponse->getCss();
			foreach($items as $item) {
				$handle = $item->name;
				$src = $item->url;
				$footer = false;
				if((string) $item->position === "footer") {
					$footer = true;
				}
				wp_enqueue_style($handle, $src, null, null, $footer);
			}
		}
		if($remoteResponse->hasJs()) {
			$items = $remoteResponse->getJs();
			foreach($items as $item) {
				$handle = $item->name;
				$src = $item->url;
				$footer = false;
				if((string) $item->position === "footer") {
					$footer = true;
				}
				wp_enqueue_script($handle, $src, array("jquery"), null, $footer);
			}
		}
	}
	
	public function addToHeader($value) {
		$this->header[] = $value;
	}
	
	public function getHeader() {
		echo get_option(iHomefinderConstants::CSS_OVERRIDE_OPTION, null);
		foreach($this->header as $value) {
			echo $value;
		}
	}
	
	public function addToFooter($value) {
		$this->footer[] = $value;
	}
	
	public function getFooter() {
		foreach($this->footer as $value) {
			echo $value;
		}
	}
	
	public function addToMetaTags($value) {
		$this->metaTags[] = $value;
	}
	
	public function getMetaTags() {
		foreach($this->metaTags as $value) {
			echo $value;
		}
	}
	
	public function addHttpHeader($httpHeader) {
		$this->httpHeaders[] = $httpHeader;
	}
	
	public function outputHttpHeaders() {
		if(!headers_sent()) {
			foreach($this->httpHeaders as $value) {
				header($value, true);
			}			
		}
	}
	
	public function setHttpStatusCode($httpStatusCode) {
		$this->httpStatusCode = $httpStatusCode;
	}
	
	public function outputHttpsStatus() {
		if($this->httpStatusCode !== null && !is_404()) {
			status_header($this->httpStatusCode);		
		}
		
	}
	
}