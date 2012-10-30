<?php

class Site {
 
    private $siteID;
    private $site_name;
    
    function __construct($siteID,$site_name) {
        $this->siteID = $siteID;
        $this->site_name = $site_name;
    }
    
    function get_siteID() {
        return $this->siteID;
    }
    
    function get_site_name() {
        return $this->site_name;
    }
}
?>
