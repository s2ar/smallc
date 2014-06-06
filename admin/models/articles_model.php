<?php

class Articles_Model extends Model {

    function __construct() {
        parent::__construct();
       
    }
   
    function getArticlesAll(){          
        $articles=array();
        $res = $this->db->select("SELECT * FROM articles ORDER BY article_modified DESC ");
        
        foreach ($res as $row) {            
            $articles[]=(array('article_id'         =>$row['article_id'],
                               'article_title'      =>$row['article_title'],
                               'article_content'    =>$row['article_content'],
                               'article_alias'      =>$row['article_alias']                
                ));
        } 
        return  $articles; 
    }
    
    function getArticle($id){
        $res = $this->db->selectRow("SELECT * FROM articles WHERE article_id = ?", $id);        
        return $res;
    }
    
    function getArticlesCat($id){        
        $res = $this->db->select("SELECT * FROM ?_articles WHERE article_cat =?d ORDER BY article_modified DESC ", $id);        
        foreach ($res as $row) {            
            $articles[]=$row;
        }        
        return  $articles; 
    }
    
    function editArticle($data) {      
//        var_dump($data);
//        die();
          $article_id = $this->db->query('UPDATE ?_articles SET ?a, article_modified = NOW()  WHERE article_id=?',
                                        $data, $data["article_id"]);   
        return $article_id;
         
    }
    
    function addArticle($data) { 
        $article_id = $this->db->query('INSERT INTO ?_articles SET ?a , article_created = NOW(), article_modified = NOW() ', $data);   
        return $article_id;          
    }
    
     function delArticle($id){      
        $res = $this->db->query('DELETE FROM ?_articles WHERE article_id=?', $id);   
//        var_dump($id);
//        die();
        return $res;
    }
    

    

}