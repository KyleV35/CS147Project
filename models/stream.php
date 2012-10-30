<?php

class Stream
{
    private $stream_name;
    private $userID;
    private $streamID;
    
    function __construct($stream_name,$userID,$streamID) {
        $this->stream_name = $stream_name;
        $this->userID = $userID;
        $this->streamID = $streamID;
    }
    
    function get_stream_name() {
        return $this->stream_name;
    }
    
    function get_userID() {
        return $this->userID;
    }
    
    function get_streamID() {
        return $this->streamID;
    }
}
?>
