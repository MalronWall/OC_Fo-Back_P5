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
$router->get('home', "Default#home");
/****** POSTS *****/
$router->get('posts', "Post#list");
$router->get('/posts/:id', "Post#listPage")->with('id', '[0-9]+');
$router->get('/posts/new', "Post#newPost");
$router->post('/posts/new', "Post#newPost");
$router->get('/posts/:slug/edit', "Post#editPost");
$router->post('/posts/:slug/edit', "Post#editPost");
$router->get('/posts/:slug/delete', "Post#deletePost");
$router->get('/posts/:slug', "Post#show");
$router->post('/posts/:slug', "Post#show");
$router->get('/posts/:slug/:id', "Post#showPage")->with('id', '[0-9]+');
/****** CONTACT *****/
$router->post('contact', "Contact#contact");
$router->get('contact', "Contact#contact");
/****** LOGIN *****/
$router->post('login', "User#login");
$router->post('logon', "User#logon");
$router->get('logout', "User#logout");
$router->get('confirm-email/:token', "User#confirmEmail");
$router->get('reset-password', "User#resetPassword");
$router->post('reset-password', "User#resetPassword");
$router->get('reset-password/:token', "User#newPassword")->with('token', '([a-z\-0-9]+)');
$router->post('reset-password/:token', "User#newPassword")->with('token', '([a-z\-0-9]+)');
/****** MY PROFILE *****/
$router->get('members/:pseudo', "User#profile")->with('pseudo', '([a-z\-0-9]+)');
$router->post('members/:pseudo', "User#profile")->with('pseudo', '([a-z\-0-9]+)');
/***** ADMIN *****/
$router->get('admin', "User#admin");
$router->post('admin', "User#admin");
