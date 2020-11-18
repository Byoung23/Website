<?php
class tdp_ihfFeaturedListings {
	public $uid				= '';									// user ID for account 
	public $sid 			= '';									// password for account  
	public $propertyType 	= 'SFR,CND,LL,COM,RI,FRM,MH,RNT'; 		// property type  
	public $getActive		= 1;									// Boolean Value, Set to 1 to get active listings  
	public $getPendingSold	= 1;									// Boolean value, set to 0 to not get Pending/Sold listings
	public $ihfClient		= '';									// Holds the raw xml
	
	public function __construct($args = array()) {
	
		$this->uid					= $args['uid'];
		$this->sid					= $args['sid'];
		$this->propertyType 		= $args['propertyType'];
		$this->getActive 			= $args['getActive'];
		$this->getPendingSold 		= $args['getPendingSold'];
		$this->ihfClient = new SoapClient('https://secure.idxre.com/ihws/FeaturedPropWebService.cfc?wsdl');
	
	} 
	
	public function getProperties(){
		$xml = $this->ihfClient->getProps($this->uid, $this->sid, $this->propertyType, $this->getActive, $this->getPendingSold);
		$propertyObject = new SimpleXMLElement($xml,LIBXML_NOCDATA);
		
		if (isset($propertyObject->fail)) { return 0; };
		//continue if not failed
		$propertyArray = array();
		foreach($propertyObject->featured_prop as $fp){
			$propertyArray[] = (array)$fp;
		}
		return $propertyArray;
	}
	
	public function getProperty($args = array()){
		$xml = $this->ihfClient->getPropDetail($this->uid, $this->sid, $args['listingNumber'], $args['mlsID'], $this->propertyType);
		return $propertyObject = new SimpleXMLElement($xml,LIBXML_NOCDATA);
		if (isset($propertyObject->fail)) { return 0; };
		//continue if not failed
		$propertyArray = array();
		foreach($propertyObject->featured_prop as $fp){
			$propertyArray[] = (array)$fp;
		}
		return $propertyArray;
	
	}
	

}
?>