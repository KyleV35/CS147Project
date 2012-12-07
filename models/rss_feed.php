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
        $url = trim($this->url);
        try {
            libxml_use_internal_errors();
            $rss_feed = @simplexml_load_file($url,"SimpleXMLElement",LIBXML_NOWARNING);
            if (is_null($rss_feed->channel)) {
                throw new Exception();
            }
            $article_title_array = array();
        
<<<<<<< HEAD
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
            echo "<p class=\"red_text\">We had trouble getting data for the feed:  ".$this->get_site_name()."-".$this->filter."</p>";
            return array();
=======
        foreach ($rss_feed->channel->item as $article) {
            $filtered_description = strip_tags($article->description);
            $article = new Article($article->title, $article->link, $filtered_description);
            array_push($article_title_array, $article);
>>>>>>> parent of f9ebca2... Minor visual redesign
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
    
    
}
?>
