<?php 

/*Rotas relacionadas as categorias*/

use \Hcode\Page;
use \Hcode\PageAdmin;
use \Hcode\Model\User;
use \Hcode\Model\Category;

$app->get("/admin/categories",function (){

	User::verifyLogin();

	$categories = Category::listAll();

	$page = new PageAdmin();

	$page->setTpl("categories",[
		"categories" =>$categories
	]);


});

/*Página de criar nova categoria*/
$app->get("/admin/categories/create",function (){

	User::verifyLogin();

	$page = new PageAdmin();

	$page->setTpl("categories-create");


});

/*Criar nova categoria*/

$app->post("/admin/categories/create",function (){

	User::verifyLogin();

	$category = new Category();

	$category->setData($_POST);

	$category->save();

	header("Location: /admin/categories");

	exit;
});


/*Deletar uma categoria*/
$app->get("/admin/categories/:idcategory/delete",function($idcategory){

	User::verifyLogin();

	$category = new Category();

	$category->get((int)$idcategory);

	$category->delete();

	header("Location: /admin/categories");
	exit;
});


/*Editar categoria via get*/
$app->get("/admin/categories/:idcategory",function ($idcategory){

	User::verifyLogin();

	$category = new Category();

	$category->get((int)$idcategory);

	$page = new PageAdmin();

	$page->setTpl("categories-update",array(
		"category" => $category->getValues()
	));

	exit;

});

/*Editar categoria via post*/
$app->post("/admin/categories/:idcategory",function ($idcategory){

	User::verifyLogin();

	$category = new Category();

	$category->get((int)$idcategory);

	$category->setData($_POST);

	$category->save();

	header("Location: /admin/categories");


	exit;

});

/*Listar as categorias no html de forma dinâmica*/
$app->get("/categories/:idcategory",function($idcategory){

	$category = new Category();

	$category->get((int)$idcategory);

	$page = new Page();

	$page->setTpl("category",array(
		"category"=>$category->getValues(),
		"products" => []
	));


});






 ?>