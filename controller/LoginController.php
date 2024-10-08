<?php
include_once '../model/User.php';
session_start();
$user = $_POST['user'];
$pass = $_POST['pass'];
$username = new User();

if (!empty($_SESSION['type_user'])) {
	 switch ($_SESSION['type_user']) {
	 	case 1:
	 		header('Location: ../vista/adm_Catalogue.php');
	 		break;

	 	case 2:
	 		header('Location: ../vista/adm_Catalogue.php');
	 		break;
		 case 3:
			 header('Location: ../vista/adm_Catalogue.php');
			 break;
	 }

}
else{
	$username->Loguearse($user,$pass);
if (!empty($username->objects)) {
	foreach ($username->objects as $object) {
	
		$_SESSION['id_user']=$object->id_user;
		$_SESSION['type_user']=$object->type_user;
		$_SESSION['username']=$object->username;
	}
	 switch ($_SESSION['type_user']) {
	 	case 1:
	 		header('Location: ../vista/adm_Catalogue.php');
	 		break;

	 	case 2:
	 		header('Location: ../vista/adm_Catalogue.php');
	 		break;
	 }
}
else{

	header('Location: ../Index.php');
	}
}
?>

