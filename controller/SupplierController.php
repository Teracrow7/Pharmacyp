<?php
include '../model/Supplier.php';

$supplier = new Supplier();

if($_POST['funcion']=='create'){

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $avatar='supplierDefault.png';

    $supplier->create($name,$phone,$email,$address,$avatar);

}
if($_POST['funcion']=='edit'){

    $id =$_POST['id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];


    $supplier->edit($id,$name,$phone,$email,$address);

}
if($_POST['funcion']=='search'){


    $supplier->search();

    $json=array();

    foreach ($supplier->objects as $object){
        $json[] =array(
            'id'=>$object->id_supplier,
            'name'=>$object->name,
            'email'=>$object->email,
            'phone'=>$object->phone,
            'address'=>$object->address,
            'avatar'=>'../img/'.$object->avatar
        );
    }
    $jsonstring = json_encode($json);
    echo $jsonstring;

}
if($_POST['funcion']=='delete'){

    $id = $_POST['id'];

    $supplier->delete($id);
}
if ($_POST['funcion'] == 'fillSuppliers') {


    $supplier->fillLabs();
    $json = array();
    foreach ($supplier->objects as $object){
        $json[]=array(
            'id'=>$object->id_supplier,
            'name'=>$object->name
        );
    }
    $jsonstring= json_encode($json);
    echo $jsonstring;
}


?>
