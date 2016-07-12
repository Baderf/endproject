<?php

class news extends controller {

    public function __construct(){

        parent::__construct();
    }

    public function index(){

        $newsListe = $this -> model -> getAllNews();
        $this -> view -> render("news/index");
    }

    public function show( $id = null){

        $newsArtikel = $this -> model -> getNewsById();
        $this -> view -> render("news/show");
    }

    public function getallnews(){

        $filters = array(
            'limit'   => ( isset($_GET['limit']) ) ? $_GET['limit'] : null,
            'startid' => ( isset($_GET['startid']) ) ? $_GET['startid'] : null,
            'content' => ( isset($_GET['content']) ) ? $_GET['content'] : 'all'
        );

        header('Content-Type: text/json');
        echo $this -> model -> getAllNews( $filters );
    }

    public function getnewsbyid( $id = null){

        if( $id !== null){
            header('Content-Type: text/json');
            echo $this -> model -> getNewsById($id);
        }else{
            echo 'Bitte eine ID angeben';
        }
    }

    public function getnewsbyslug( $slug = null){

        if( $slug !== null ){
            header('Content-Type: text/json');
            echo $this -> model -> getNewsBySlug($slug);
        }else{
            echo "Bitte einen slug angeben";
        }
    }

}
