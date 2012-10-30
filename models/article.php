<?php

class Article {
    
    private $title;
    private $link;
    private $description;
    
    public function __construct($title,$link,$description) {
        $this->title = $title;
        $this->link = $link;
        $this->description = $description;
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
    
}

?>
