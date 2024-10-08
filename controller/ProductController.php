<?php

include '../model/Product.php';

$product = new Product();

if($_POST['funcion']=='create'){

    $name = $_POST['name'];
    $concentration = $_POST['concentration'];
    $extra = $_POST['extra'];
    $price = $_POST['price'];
    $laboratory = $_POST['laboratory'];
    $type = $_POST['type'];
    $presentation = $_POST['presentation'];

    $avatar='medImg.png';
    $product->create($name,$concentration,$extra,$price,$laboratory,$type,$presentation,$avatar);

}
if($_POST['funcion']=='edit'){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $concentration = $_POST['concentration'];
    $extra = $_POST['extra'];
    $price = $_POST['price'];
    $laboratory = $_POST['laboratory'];
    $type = $_POST['type'];
    $presentation = $_POST['presentation'];


    $product->edit($id,$name,$concentration,$extra,$price,$laboratory,$type,$presentation);

}

if ($_POST['funcion']=='search'){
    $product->search();
    $json = array();

    foreach ($product->objects as $object){

        $product->obtainStock($object->id_product);
        foreach ($product->objects as $obj){
            $total = $obj->total;
        }
        $json[]=array(
          'id'=>$object->id_product,
            'name'=>$object->name,
            'concentration'=>$object->concentration,
            'extra'=>$object->extra,
            'price'=>$object->price,
            'stock'=>$total,
            'type'=>$object->type,
            'presentation'=>$object->presentation,
            'laboratory'=>$object->laboratory,
            'id_type'=>$object->prod_type,
            'id_presentation'=>$object->prod_presentation,
            'id_laboratory'=>$object->prod_lab,
            'avatar'=>'../img/'.$object->avatar,
        );
    }

    $jsonstring = json_encode($json);
    echo $jsonstring;

}

if ($_POST['funcion']=='delete'){

    $id=$_POST['id'];
    $product->delete($id);
}
if ($_POST['funcion']=='checkStock'){

   $error=0;
   $products=json_decode($_POST['products']);
   foreach ($products as $object){
       $product->obtainStock($object->id);
       foreach ($product->objects as $obj){
           $total = $obj->total;

       }
       if($total>=$object->quantity && $object->quantity>0){
           $error=$error+0;
       }
       else{
           $error=$error+1;
       }
   }
   echo $error;
}

?>
