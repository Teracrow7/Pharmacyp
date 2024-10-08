<?php

include '../model/Presentation.php';

$presentation = new Presentation();

if($_POST['funcion']=='create'){

    $name = $_POST['namePre'];

    $presentation->create($name);

}
if($_POST['funcion']=='edit'){

    $name = $_POST['namePre'];
    $id_edited = $_POST['id_edited'];
    $presentation->edit($name,$id_edited);

}
if($_POST['funcion']=='search'){


    $presentation->search();
    $json=array();

    foreach ($presentation->objects as $object){
        $json[] =array(
            'id'=>$object->id_filing,
            'name'=>$object->name
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;

}

if ($_POST['funcion'] == 'delete') {
    $id = $_POST['id'];
    $presentation->delete($id);
}
if ($_POST['funcion'] == 'fillpresen') {


    $presentation->fillTipos();
    $json = array();
    foreach ($presentation->objects as $object){
        $json[]=array(
            'id'=>$object->id_filing,
            'name'=>$object->name
        );
    }
    $jsonstring= json_encode($json);
    echo $jsonstring;
}

?>


