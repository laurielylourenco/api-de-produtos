<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
include_once '../objects/Product.class.php';

$product = new Produto();
$data = json_decode(file_get_contents("php://input"));

if(!empty($data->name) && !empty($data->id) && !empty($data->tags) ){
  
    $product->id = $data->id;
    $product->name = $data->name;
    $tagsText = implode(",",$data->tags);
    $product->tags = $tagsText;

    if($product->create()){
        http_response_code(201);
        echo json_encode(array("message" => "Product was created."));
    }else{
        http_response_code(503);
        echo json_encode(array("message" => "Unable to create product."));
    }
}else{
    http_response_code(400);
    echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
}