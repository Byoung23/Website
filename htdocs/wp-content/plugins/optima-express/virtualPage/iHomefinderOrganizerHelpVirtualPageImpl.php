<?php

class iHomefinderOrganizerHelpVirtualPageImpl extends iHomefinderAbstractPropertyOrganizerVirtualPage {
	
	public function getTitle() {
		return "Organizer Help";
	}
	
	public function getPermalink() {
		return "property-organizer-help";
	}
	
	public function getContent() {
		$this->remoteRequest
			->addParameter("requestType", "property-organizer-help")
		;
		$this->remoteResponse = $this->remoteRequest->remoteGetRequest();
	}
	
}