<?php

class news_model extends model
{

    public function __construct()
    {

        parent::__construct();
    }

    public function getAllNews($filters = null)
    {

        // ich habe filter
        switch ($filters['content']) {
            case 'all':
                $tables = '*';
                break;
            case 'headline':
                $tables = 'id, slug, title';
                break;
            case 'img':
                $tables = 'id, slug, img';
                break;
            case 'content':
                $tables = 'id, slug, content';
                break;
        }

        $sql = "SELECT $tables FROM news";

        if (isset($filters['startid'])) {
            $sql .= " WHERE id >= {$filters['startid']}";
        }

        if (isset($filters['limit'])) {
            $sql .= " LIMIT {$filters['limit']}";
        }

        $res = $this->db->query($sql);

        $newsList = array();

        while ($row = $res->fetch_assoc()) {
            array_push($newsList, $row);
        }

        $newsList = json_encode($newsList);
        return $newsList;
    }

    public function getNewsById($id = null)
    {

        $res = $this -> db -> query("SELECT * FROM news WHERE id = $id LIMIT 1");

        if( $res -> num_rows == 1 ){

            $newsArticle = $res -> fetch_assoc();
            return json_encode($newsArticle);
        }
    }

    public function getNewsBySlug($slug = null)
    {
        $res = $this -> db -> query("SELECT * FROM news WHERE slug = '$slug' LIMIT 1");

        if( $res -> num_rows == 1 ){
            $newsArticle = $res -> fetch_assoc();
            return json_encode($newsArticle);
        }
    }

    public function insertNews($data = array())
    {

    }

    public function updateNews($id = null, $rows = array(), $values = array())
    {

    }

    public function deleteNews($id = null)
    {

    }
}