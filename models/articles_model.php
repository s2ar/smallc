<?php

class Articles_Model extends Model {

    function __construct() {
        parent::__construct();
    }

    function getArticles() {
        $articlesAll = $this->db->select("SELECT * FROM articles");
        return $articlesAll;
    }

    function getArticle($alias) {

        $res = $this->db->selectRow("SELECT * FROM ?_articles WHERE article_alias = ? LIMIT 1", $alias);
        return $res;
    }

    function getArticlesCat($id) {
        $res = $this->db->select("SELECT * FROM ?_articles WHERE article_cat =?d ORDER BY article_modified DESC ", $id);
        foreach ($res as $row) {
            $articles[] = $row;
        }
        return $articles;
    }

}