<?php

include '../model/Order.php';
include_once '../model/Connection.php';
$order = new Order();
session_start();
$seller = $_SESSION['id_user'];

if($_POST['funcion']=='registerOrder'){

    $total = $_POST['total'];
    $name = $_POST['name'];
    $products = json_decode($_POST['json']);
    date_default_timezone_set('America/Mexico_City');
    $datee= date('Y-m-d H:i:s');

    $order->Create($name,$total,$datee,$seller);
    $order->LastOrder();
    foreach ($order->objects as $object){
        $id_sale= $object->last_sell;
        echo $id_sale;
    }

    $connection = null;
    try{
        $db = new Connection();
        $connection = $db->pdo;
        $connection->beginTransaction();
        foreach ($products as $prod){
            $quantity=$prod->quantity;
            while ($quantity!=0){
                    $sql="SELECT * FROM lote where expiration = (SELECT MIN(expiration) FROM lote where lot_id_prod=:id) and lot_id_prod=:id";
                    $query = $connection->prepare($sql);
                    $query->execute(array(':id'=>$prod->id));
                    $lote=$query->fetchAll();
                    foreach ($lote as $lote){
                        if($quantity<$lote->stock){

                            $sql="INSERT INTO detalle_venta(det_quantity,det_expiration,id_det_lot,id_det_product,lote_id_prov,id_det_sale) values ('$quantity','$lote->expiration','$lote->id_lot',
                                  '$prod->id','$lote->lot_id_prov','$id_sale')";
                            $connection->exec($sql);

                            $connection->exec("UPDATE lote SET stock= stock-'$quantity' where id_lot='$lote->id_lot'");
                            $quantity=0;
                        }if($quantity==$lote->stock){
                            $sql="INSERT INTO detalle_venta(det_quantity,det_expiration,id_det_lot,id_det_product,lote_id_prov,id_det_sale) values ('$quantity','$lote->expiration','$lote->id_lot',
                                  '$prod->id','$lote->lot_id_prov','$id_sale')";
                            $connection->exec($sql);
                            $connection->exec("DELETE FROM lote where id_lot='$lote->id_lot'");
                            $quantity=0;
                        }if($quantity>$lote->stock){
                            $sql="INSERT INTO detalle_venta(det_quantity,det_expiration,id_det_lot,id_det_product,lote_id_prov,id_det_sale) values ('$lote->stock','$lote->expiration','$lote->id_lot',
                                  '$prod->id','$lote->lot_id_prov','$id_sale')";
                            $connection->exec($sql);
                            $connection->exec("DELETE FROM lote where id_lot='$lote->id_lot'");
                            $quantity=$quantity-$lote->stock;
                        }
                    }
            }
            $subtotal = $prod->quantity*$prod->price;
            $connection->exec("INSERT INTO venta_producto(quantity,subtotal,product_id_product,sale_id_sale) values('$prod->quantity','$subtotal','$prod->id','$id_sale')");
            $connection->commit();
        }

    } catch (Exception $error){

        $connection->rollBack();
        $order->Delete($id_sale);
        echo $error->getMessage();
    }

}
