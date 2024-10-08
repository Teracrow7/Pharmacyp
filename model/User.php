<?php
include_once 'Connection.php';

class User {
    var $objects;
    private $access;

    public function __construct() {
        $db = new Connection();
        $this->access = $db->pdo;
    }

    function Loguearse($user, $pass) {
        $sql = "SELECT * FROM usuario 
                INNER JOIN tipo_usuario ON type_user = id_type_user 
                WHERE username = :user AND password_user = :pass";
        $query = $this->access->prepare($sql);
        $query->execute(array(':user' => $user, ':pass' => $pass));
        $this->objects = $query->fetchAll();
        return $this->objects;
    }

    function ObtainData($id) {
        $sql = "
        SELECT * FROM usuario 
    JOIN tipo_usuario ON usuario.type_user = tipo_usuario.id_type_user 
    WHERE usuario.id_user = :id
        ";
        $query = $this->access->prepare($sql);
        $query->execute(array(':id' => $id));
        $this->objects = $query->fetchAll();
        return $this->objects;
    }

    function edit($id, $phone, $address, $email, $extraInfo)
    {
        $sql = "
    UPDATE usuario SET user_phone = :phone, user_address = :address, user_email = :email, user_extra_info = :extraInfo WHERE id_user = :id
    ";
        $query = $this->access->prepare($sql);
        $query->execute(array(
            ':id' => $id,
            ':phone' => $phone,
            ':address' => $address,
            ':email' => $email,
            ':extraInfo' => $extraInfo
        ));
    }

    function search()
    {
        if(!empty($_POST['queryData'])){

            $queryData = $_POST['queryData'];
            $sql="SELECT * FROM usuario join tipo_usuario on type_user=id_type_user where username LIKE :queryData";
            $query = $this->access->prepare($sql);
            $query->execute(array(':queryData'=>"%$queryData%"));
            $this->objects=$query->fetchAll();
            return$this->objects;

        }else{

            $sql="SELECT * FROM usuario join tipo_usuario on type_user=id_type_user where username NOT LIKE '' ORDER BY id_user LIMIT 25";
            $query = $this->access->prepare($sql);
            $query->execute();
            $this->objects=$query->fetchAll();
            return$this->objects;
        }
    }

    function create($name,$lastname,$age,$pass,$type)
    {
        $sql="SELECT id_user FROM usuario where username=:name AND user_lastname=:lastname";
        $query = $this->access->prepare($sql);
        $query->execute(array( ':name' => $name,
            ':lastname' => $lastname,));
        $this->objects=$query->fetchAll();
        if(!empty($this->objects)){

            echo 'noadd';

        }else{
            $sql="INSERT INTO usuario(username,user_lastname,age,password_user,type_user) VALUES(:name,:lastname,:age,:pass,:type);";
            $query = $this->access->prepare($sql);
            $query->execute(array( ':name' => $name,
                ':lastname' => $lastname,
                ':age' => $age,
                ':pass' => $pass,
                ':type' => $type,
            ));
            echo 'add';
        }

    }

    public function ascend($pass, $id_ascend,$id_userTotal)
    {

        $sql="SELECT id_user FROM usuario where id_user=:id_userTotal and password_user=:pass";
        $query = $this->access->prepare($sql);
        $query->execute(array( ':id_userTotal' => $id_userTotal,
            ':pass' => $pass,));
        $this->objects=$query->fetchAll();

        if(!empty($this->objects)){
            $tipo=1;
            $sql="UPDATE usuario SET type_user=:tipo where id_user=:id";
            $query = $this->access->prepare($sql);
            $query->execute(array( ':id' => $id_ascend,
                ':tipo' => $tipo,));
            echo 'ascendido';

        }else{
            echo 'noascendido';
        }

    }

    public function descend($pass, $id_descend, $id_userTotal)
    {
        $sql="SELECT id_user FROM usuario where id_user=:id_userTotal and password_user=:pass";
        $query = $this->access->prepare($sql);
        $query->execute(array( ':id_userTotal' => $id_userTotal,
            ':pass' => $pass,));
        $this->objects=$query->fetchAll();

        if(!empty($this->objects)){
            $tipo=2;
            $sql="UPDATE usuario SET type_user=:tipo where id_user=:id";
            $query = $this->access->prepare($sql);
            $query->execute(array( ':id' => $id_descend,
                ':tipo' => $tipo,));
            echo 'descendido';

        }else{
            echo 'nodescendido';
        }
    }

    public function delete_user($pass, $id_deleted, $id_user)
    {
        $sql="SELECT id_user FROM usuario where id_user=:id_userTotal and password_user=:pass";
        $query = $this->access->prepare($sql);
        $query->execute(array( ':id_userTotal' => $id_user,
            ':pass' => $pass,));
        $this->objects=$query->fetchAll();

        if(!empty($this->objects)){

            $sql="DELETE FROM usuario where id_user=:id";
            $query = $this->access->prepare($sql);
            $query->execute(array( ':id' => $id_deleted,
                ));
            echo 'borrado';

        }else{
            echo 'noborrado';
        }
    }

}
?>
