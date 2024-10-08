<?php
include_once '../model/User.php';
$user = new User();
session_start();
$id_user=$_SESSION['id_user'];
$userType=$_SESSION['type_user'];

if($_POST['funcion']=='search_user'){
    $json=array();

    $user->ObtainData($_POST['data']);

    foreach ($user->objects as $object){

        $json[]=array(

            'name'=>$object->username,
            'lastname'=>$object->user_lastname,
            'age'=>$object->age,
            'type'=>$object->name_type,
            'phone'=>$object->user_phone,
            'address'=>$object->user_address,
            'email'=>$object->user_email,
            'extra_info'=>$object->user_extra_info

        );

    }

    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}
if($_POST['funcion']=='saveData'){
    $json=array();
    $id_user =$_POST['id_user'];

    $user->ObtainData($id_user);

    foreach ($user->objects as $object){

        $json[]=array(

            'phone'=>$object->user_phone,
            'address'=>$object->user_address,
            'email'=>$object->user_email,
            'extra_info'=>$object->user_extra_info

        );

    }

    $jsonstring = json_encode($json[0]);
    echo $jsonstring;
}
if($_POST['funcion']=='edit_user'){


    $id_user =$_POST['id_user'];
    $phone =$_POST['phone'];
    $address =$_POST['address'];
    $email =$_POST['email'];
    $extraInfo =$_POST['extraInfo'];


    $user->edit($id_user,$phone,$address,$email,$extraInfo);


    echo 'edited';





}

if($_POST['funcion']=='search_userData'){
    $json=array();

    $user->search();

    foreach ($user->objects as $object){

        $json[]=array(
            'id'=>$object->id_user,
            'name'=>$object->username,
            'lastname'=>$object->user_lastname,
            'age'=>$object->age,
            'type'=>$object->name_type,
            'phone'=>$object->user_phone,
            'address'=>$object->user_address,
            'email'=>$object->user_email,
            'extra_info'=>$object->user_extra_info,
            'typee'=>$object->type_user

        );

    }

    $jsonstring = json_encode($json);
    echo $jsonstring;
}
if($_POST['funcion']=='create_user'){

    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $age = $_POST['age'];
    $pass = $_POST['pass'];
    $type=2;

    $user->create($name,$lastname,$age,$pass,$type);

}

if($_POST['funcion']=='ascend'){

   $pass=$_POST['pass'];
    $id_ascend=$_POST['id_user'];
    $user->ascend($pass,$id_ascend,$id_user);


}
if($_POST['funcion']=='descend'){

    $pass=$_POST['pass'];
    $id_descend=$_POST['id_user'];
    $user->descend($pass,$id_descend,$id_user);

}
if($_POST['funcion']=='delete_user'){

    $pass=$_POST['pass'];
    $id_deleted=$_POST['id_user'];
    $user->delete_user($pass,$id_deleted,$id_user);

}
if($_POST['funcion']=='userType'){

 echo $userType;

}

?>
