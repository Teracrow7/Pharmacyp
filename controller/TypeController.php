<?php

include '../model/Typee.php';

$type = new Typee();

if($_POST['funcion']=='create'){

    $name = $_POST['nameType'];

    $type->create($name);

}
if($_POST['funcion']=='edit'){

    $name = $_POST['nameType'];
    $id_edited = $_POST['id_edited'];
    $type->edit($name,$id_edited);

}
if($_POST['funcion']=='search'){


    $type->search();
    $json=array();

    foreach ($type->objects as $object){
        $json[] =array(
            'id'=>$object->id_type_prod,
            'name'=>$object->name
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;

}

if ($_POST['funcion'] == 'delete') {
    $id = $_POST['id'];
    $type->delete($id);
}
if ($_POST['funcion'] == 'filltipos') {


    $type->fillTipos();
    $json = array();
    foreach ($type->objects as $object){
        $json[]=array(
            'id'=>$object->id_type_prod,
            'name'=>$object->name
        );
    }
    $jsonstring= json_encode($json);
    echo $jsonstring;
}

?>

