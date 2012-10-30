<?php

class Article {
    
    private $title;
    private $link;
    private $description;
    private $site_name;
    
    public function __construct($title,$link,$description,$site_name) {
        $this->title = $title;
        $this->link = $link;
        $this->description = $description;
        $this->site_name = $site_name;
    }
    
    public function get_title() {
        return $this->title;
    }
    
    public function get_link() {
        return $this->link;
    }
    
    public function get_description() {
        return $this->description;
    }
    
    public function get_site_name() {
        return $this->site_name;
    }
}

?>
