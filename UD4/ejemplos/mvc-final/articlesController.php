<?php
//Modelo
include('articles.php');
include('articlesListView.php');
class ArticlesController{

    public function showAll(){
        $data = Article::getAll();
        //Vista
        $view = new ArticlesListView();
        $view->show($data);
    }
    
}