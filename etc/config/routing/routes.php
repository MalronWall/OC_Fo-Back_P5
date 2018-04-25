<?php
/************************************************ ROUTES EXEMPLES *************************************************/
//    $router->get('', function () { echo 'Homepage !';});
//    $router->get('/posts', function (){ echo 'Tous les articles';});
//    $router->get('/posts/:slug-:id', "Post#showSlug")->with('slug', '([a-z\-0-9]+)')->with('id', '[0-9]+');
//    $router->get('/posts/:id', "Post#show")->with('id', '[0-9]+');
//    $router->post('/posts/:id', function ($id){ echo 'Afficher l\'article '.$id.' la valeur '.$_POST['name'];});
/*****************************************************************************************************************/

/****** HOME DEFAULT *****/
$router->get('', "Default#home");
/****** POSTS *****/
$router->get('posts', "Post#list");
$router->get('/posts/:id', "Post#listPage")->with('id', '[0-9]+');
$router->get('/posts/:slug', "Post#show")->with('slug', '([a-z\-0-9]+)');
$router->get('/posts/:slug/:id', "Post#showPage")->with('slug', '([a-z\-0-9]+)')->with('id', '[0-9]+');
/****** CONTACT *****/
$router->post('contact', "Contact#contact");
$router->get('contact', "Contact#contact");
/****** LOGIN *****/
$router->get('login', "User#connection");
$router->post('login', "User#connection");
$router->get('login/reset-password', "User#resetPassword");

/****** 404 *****/
//$router->get(':everything', "Error#notFound")->with('everything', '([^\s]+)');
