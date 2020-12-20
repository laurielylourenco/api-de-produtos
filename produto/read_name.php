<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../objects/Product.class.php';

$product = new Produto();
$data = json_decode(file_get_contents("php://input"));

$name = isset($_GET['name']) ? $_GET['name'] : die();

$row = $product->read_name($name);

 if (!empty($row)) {
  foreach ($row as  $value) {
    
    $product_arr = array(
      "id" =>  $value['id'],
      "name" =>  $value['name'],
      "tags" => (array)$value['tags']
    );

    http_response_code(200);
    echo json_encode($product_arr); 
    
  }
 }else{
    http_response_code(405);
    echo json_encode("Dado e nao existe");
 }
   


