<?php

include_once "../models/article.php";
include_once "../models/site.php";

class RSS_Feed {
    
    private $rssID;
    private $siteID;
    private $filter;
    private $url;
    private $article_list;
    private $siteName;
    
    public function __construct($rssID,$siteID,$filter,$url) {
        $this->rssID = $rssID;
        $this->siteID = $siteID;
        $this->filter = $filter;
        $this->url = $url;
    }
    
    private function read_rss() {
        $url = trim($this->url);
        try {
            $rss_feed = simplexml_load_file($url);
            $article_title_array = array();
        
            foreach ($rss_feed->channel->item as $article) {
                $filtered_description = strip_tags($article->description);
                $site_name = $this->get_site_name();
                $filter = $this->filter;
                $article = new Article($article->title, $article->link, $filtered_description, 
                    $site_name,$filter,$article->pubDate);
                array_push($article_title_array, $article);
            }
            return $article_title_array;
        } catch (Exception $e) {
            echo "Error parsing RSS Feed for ".$this->get_site_name()."-".$this->filter;
            return array();
        }
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
    
    public function get_site_name() {
        if ($this->siteName == null) {
            $site = get_site_for_siteID($this->siteID);
            $this->siteName = $site->get_site_name();
        }
        return $this->siteName;
    }
    
    
}
?>
