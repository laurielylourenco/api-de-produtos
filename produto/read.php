<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../objects/Product.class.php';

$product = new Produto();
$data = json_decode(file_get_contents("php://input"));

$product->id = isset($_GET['id']) ? $_GET['id'] : die();
$product->read(); 

 if($product->name!=null){
    $product_arr = array(
        "id" =>  $product->id,
        "name" => $product->name,
        "tags" => (array)$product->tags 
    );

    http_response_code(200);
    echo json_encode($product_arr);
}else{
    http_response_code(404);
    echo json_encode(array("message" => "Product does not exist."));
} 
