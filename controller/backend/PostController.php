<?php
//ajouter création des billets et espace admin deux boutons qui redirigent vers ou articles ou comm
namespace controller\backend;

use model\backend\Manager;
use model\frontend\PostManager;
use controller\frontend\MainController;
use model\frontend\CommentManager;

class PostController extends MainController
{
    public  function gestion()
    {
        $articles = getArticleBYDate();

        if ($_SESSION['admin'] == 0) {
           // header("Location: index.php");
        }
        require('view/frontend/template_gestion.php');
    }

    
    
    public function create()
    {
      //  if ($_SESSION['admin'] == 0) {
           // header("Location: index.php");
      //  }
//faire page pour ecrire
        if (isset($_POST['billetvalid'])) {
            if (!empty($_POST['textarea']) and !empty($_POST['titlearea'])) {
                $titlearticle = htmlspecialchars($_POST['titlearea']);
                $textarticle = htmlspecialchars($_POST['textarea']);
                $insertarticle = insertArticle($titlearticle, $textarticle);
                // -> = pour preparer et executer la bdd
                $message = "L'article à bien été posté";
            } else {
                $error = "Veuillez remplir tous les champs";
            }
        }

        require('view/frontend/template_create.php');
    }

    
    public    function updatearticle()
    {
        $IDupdate = htmlspecialchars($_GET['id']);

        $articles = getArticleUp($IDupdate);

        if ($_SESSION['admin'] == 0) {
            header("Location: index.php");
        }

        if (isset($_POST['billetup'])) {
            if (!empty($_POST['titlearea']) and !empty($_POST['textarea'])) {
                $titlearticle = htmlspecialchars($_POST['titlearea']);
                $txt = htmlspecialchars($_POST['textarea']);
                $uparticle = upadteArticle($titlearticle, $txt, $IDupdate);
                header("Location: template_gestion.php");
            } else {
                $error = 'Veuillez remplir tous les champs';
            }
        }

        require('view/frontend/template_updatearticle.php');
    }

    public  function delete()
    {
        $IDdelete = htmlspecialchars($_GET['id']);
        $namearticle = getNameArticle($IDdelete);
        //et supprimer les comm qui vont avec les artcilesen utilisant la jonction
        if ($_SESSION['admin'] == 0) {
            header("Location: index.php");
        }

        if (isset($_POST['valid'])) {
            header("Location: template_gestion.php");
        }

        if (isset($_POST['delete'])) {
            $delete = deleteArticle($IDdelete);
            header("Location: template_gestion.php");
        }

        require('view/frontend/template_delete.php');
    }
}
