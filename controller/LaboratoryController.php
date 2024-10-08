<?php

include '../model/Laboratory.php';

$laboratory = new Laboratory();

if($_POST['funcion']=='create'){

    $name = $_POST['nameLab'];
    $avatar='labDefault.png';
    $laboratory->create($name,$avatar);

}
if($_POST['funcion']=='edit'){

    $name = $_POST['nameLab'];
    $id_edited = $_POST['id_edited'];
    $laboratory->edit($name,$id_edited);

}
if($_POST['funcion']=='search'){


    $laboratory->search();
    $json=array();

    foreach ($laboratory->objects as $object){
        $json[] =array(
            'id'=>$object->id_laboratory,
            'name'=>$object->name,
            'avatar'=>'../img/'.$object->avatar
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;

}

if ($_POST['funcion'] == 'delete') {
    $id = $_POST['id'];
    $laboratory->delete($id);
}
if ($_POST['funcion'] == 'fillLabs') {


    $laboratory->fillLabs();
    $json = array();
    foreach ($laboratory->objects as $object){
        $json[]=array(
            'id'=>$object->id_laboratory,
             'name'=>$object->name
        );
    }
    $jsonstring= json_encode($json);
    echo $jsonstring;
}


?>
