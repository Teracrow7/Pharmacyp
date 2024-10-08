<?php

include '../model/Order.php';

$order = new Order();

if($_POST['funcion']=='searchOrder'){



    $order->searchOrder();
    $json = array();
    foreach ($order->objects as $object){
        $json['data'][]=$object;

    }
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

?>
