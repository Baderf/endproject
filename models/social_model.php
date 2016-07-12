<?php

class social_model extends model{

    public function __construct(){

        parent::__construct();
    }


    public function getFacebookFeed($pageID, $appID, $appSecret){

        $accessToken = file_get_contents("https://graph.facebook.com/oauth/access_token?%20client_id=$appID%20&client_secret=$appSecret&grant_type=client_credentials");

        $feed = file_get_contents("https://graph.facebook.com/$pageID/feed?$accessToken");

        return json_decode($feed);
    }

    public function getYoutubeFeed($playlistID, $apiKey){

        $feed = file_get_contents("https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&maxResults=50&playlistId=$playlistID&fields=items%2Fsnippet&key=$apiKey");

        return json_decode($feed);
    }
}