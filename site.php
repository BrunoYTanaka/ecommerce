
<?php 
/*Rotas relacionadas site*/

use \Hcode\Page;
use \Hcode\Model\Products;
use \Hcode\Model\Category;

$app->get('/', function() {

	$products = Products::listAll();

	$page = new Page();

	$page->setTpl("index",array(
		"products" => Products::checkList($products)
	));

});


/*Listar as categorias no html de forma dinâmica*/
$app->get("/categories/:idcategory",function($idcategory){

	$category = new Category();

	$category->get((int)$idcategory);

	$page = new Page();

	$page->setTpl("category",array(
		"category" => $category->getValues(),
		"products" => Products::checkList($category->getProducts())
	));
});

?>