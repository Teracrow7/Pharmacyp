<?php

include_once '../model/SaleProduct.php';

$saleProduct = new SaleProduct();


if($_POST['funcion']=='watch'){


 $id= $_POST['id'];
    $saleProduct->searchSale($id);
    $json = array();
    foreach ($saleProduct->objects as $object){
        $json[]=$object;

    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

?>
