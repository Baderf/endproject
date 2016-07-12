<?php

class social extends controller{

    public function __construct(){

        parent::__construct();
    }

    public function index(){

        $pageID = "929491973752635";
        $appID = "1556143658023044";
        $appSecret = "93ed6ec77b752251524f1d1a8723596d";

        $this -> view -> data['facebookFeed'] = $this -> model -> getFacebookFeed($pageID, $appID, $appSecret);
        $this -> view -> render('social/index', $this -> view -> data);
    }

    public function videos(){

        $playlistID = "PLs4hTtftqnlDhtuDiar5Q0G8rtRlbX3BW";
        $apiKey = "AIzaSyA0IcX6ClrEnx7MloC8ZjAiHUJjy1QM4Xs";

        $this -> view -> data['youtubeFeed'] = $this -> model -> getYoutubeFeed($playlistID, $apiKey);
        $this -> view -> render('social/videos', $this -> view -> data);
    }
}