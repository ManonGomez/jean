<?php
namespace ManonBlog\Model\Frontend;

use model\backend\Manager;
//require_once('model/Manager.php');

class PostManager extends Manager
{

    public function getArticle($IDarticle)
    {
        $bdd = $this->dbConnect();
        $article = $bdd->prepare("SELECT * FROM articles WHERE Id = ?");
        $article->execute(array($IDarticle));
        return $article;
    }

    public function getArticles()
    {

        $bdd = $this->dbConnect();
        $articles = $bdd->query('SELECT * FROM articles ORDER BY dateArticle ASC');
        return $articles;
    }
}
