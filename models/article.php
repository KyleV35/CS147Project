<?php

include_once '../models/date.php';

class Article {
    
    private $title;
    private $link;
    private $description;
    private $site_name;
    private $date;
    private $filter;
    
    public function __construct($title,$link,$description,$site_name,$filter,$pub_date) {
        $this->title = $title;
        $this->link = $link;
        $this->description = $description;
        $this->site_name = $site_name;
        $this->filter = $filter;
        $this->date = $this->parse_pub_date($pub_date);
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
    
    public function get_date() {
        return $this->date;
    }
    
    public function get_filter() {
        return $this->filter;
    }
    
    private function parse_pub_date($pub_date) {
        $date_parts_array = explode(" ", $pub_date);
        $day = $date_parts_array[1];
        $month = $date_parts_array[2];
        $year = $date_parts_array[3];
        $time = $date_parts_array[4];
        $time_zone = $date_parts_array[5];
        return new Date($day, $month, $year, $time, $time_zone);
    }
}

    

?>
