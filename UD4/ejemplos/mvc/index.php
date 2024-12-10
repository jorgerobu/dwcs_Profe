<?php
//Esto es el controlador
include("articles.php");
$articles = Article::getAll();
include("showAllArticles.php");
