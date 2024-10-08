<?php

include '../model/Lot.php';

$lot = new Lot();

if($_POST['funcion']=='create'){

    $id_product=$_POST['id_product'];
    $supplier=$_POST['supplier'];
    $stock=$_POST['stock'];
    $expiration=$_POST['expiration'];

    $lot->create($id_product,$supplier,$stock,$expiration);
}
if($_POST['funcion']=='edit'){

    $id_lot=$_POST['id'];
    $stock=$_POST['stock'];


    $lot->edit($id_lot,$stock);
}
if ($_POST['funcion'] == 'search') {
    $lot->search();
    $json = array();
    $current_date = new DateTime();

    foreach ($lot->objects as $object) {
        $expiration = new DateTime($object->expiration);
        $dif = $expiration->diff($current_date);

        // Calcular meses y días restantes o vencidos
        $months_remaining = $dif->m + ($dif->y * 12); // Meses totales
        $days_remaining = $dif->days; // Diferencia total en días

        // Si la fecha de expiración ya pasó
        if ($expiration < $current_date) {
            $months_remaining = -$months_remaining;
            $days_remaining = -$days_remaining;
            $state = 'danger';
        } elseif ($months_remaining <= 3) {
            $state = 'warning';
        } else {
            $state = 'light';
        }

        $json[] = array(
            'id' => $object->id_lot,
            'name' => $object->prod_name,
            'concentration' => $object->concentration,
            'extra' => $object->extra,
            'expiration' => $object->expiration,
            'supplier' => $object->proveedor,
            'stock' => $object->stock,
            'type' => $object->type_name,
            'presentation' => $object->pre_name,
            'laboratory' => $object->lab_name,
            'avatar' => '../img/' . $object->logo,
            'months' => $months_remaining,
            'days' => $days_remaining,
            'state' => $state
        );
    }

    echo json_encode($json);
}
if($_POST['funcion']=='delete'){
    $id=$_POST['id'];
    $lot->delete($id);
}



?>
