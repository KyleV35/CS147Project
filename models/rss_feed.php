<?php

include_once "../models/article.php";

class RSS_Feed {
    
    private $rssID;
    private $siteID;
    private $filter;
    private $url;
    private $article_list;
    
    public function __construct($rssID,$siteID,$filter,$url) {
        $this->rssID = $rssID;
        $this->siteID = $siteID;
        $this->filter = $filter;
        $this->url = $url;
    }
    
    private function read_rss() {
        $url = $this->url;
        $rss_feed = simplexml_load_file($url);
        $article_title_array = array();
        
        foreach ($rss_feed->channel->item as $article) {
            $filtered_description = strip_tags($article->description);
            $article = new Article($article->title, $article->link, $filtered_description);
            array_push($article_title_array, $article);
        }
        return $article_title_array;  
    }
    
    public function get_rssID() {
        return $this->rssID;
    }
    
    public function get_siteID() {
        return $this->siteID;
    }
    
    public function get_filter() {
        return $this->filter;
    }
    
    public function get_url() {
        return $this->url;
    }
    
    public function get_article_list() {
        if ($this->article_list == null) {
            $this->article_list = $this->read_rss();
        }
        return $this->article_list;
    }
    
    
}
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
