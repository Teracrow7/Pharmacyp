<?php
include 'Connection.php';

class Supplier
{
    var $objects;

    private $access;


    public function __construct()
    {
        $db = new Connection();
        $this->access=$db->pdo;

    }

    public function create($name,$phone,$email,$address,$avatar)
    {
        $sql="SELECT id_supplier FROM proveedor where name=:name ";
        $query = $this->access->prepare($sql);
        $query->execute(array( ':name' => $name));
        $this->objects=$query->fetchAll();
        if(!empty($this->objects)){

            echo 'noadd';

        }else{
            $sql="INSERT INTO proveedor(name,email,phone,address,avatar) values (:name,:email,:phone,:address,:avatar)";
            $query = $this->access->prepare($sql);
            $query->execute(array( ':name' => $name,
                ':email' => $email,
                ':address' => $address,
                ':phone' => $phone,
                ':avatar' => $avatar));
            echo 'add';
        }

    }
    function search()
    {
        if(!empty($_POST['queryData'])){

            $queryData = $_POST['queryData'];
            $sql="SELECT * FROM proveedor where name LIKE :queryData";
            $query = $this->access->prepare($sql);
            $query->execute(array(':queryData'=>"%$queryData%"));
            $this->objects=$query->fetchAll();
            return$this->objects;

        }else{

            $sql="SELECT * FROM proveedor where name NOT LIKE '' ORDER BY id_supplier desc LIMIT 25";
            $query = $this->access->prepare($sql);
            $query->execute();
            $this->objects=$query->fetchAll();
            return$this->objects;
        }
    }

    public function delete($id)
    {

        $sql="DELETE FROM proveedor where id_supplier=:id";
        $query = $this->access->prepare($sql);
        $query->execute(array(':id'=>$id));
        if(!empty($query->execute(array(':id'=>$id)))){
            echo 'deleted';
        }else{
            echo 'nodeleted';
        }
    }

    public function edit($id, $name, $phone, $email, $address)
    {

        $sql="SELECT id_supplier FROM proveedor where id_supplier!=:id and name=:name";
        $query = $this->access->prepare($sql);
        $query->execute(array(
            ':name' => $name,
            ':id' => $id
        ));
        $this->objects=$query->fetchAll();
        if(!empty($this->objects)){

            echo 'noedit';

        }else{
            $sql="UPDATE proveedor SET name=:name,phone=:phone,email=:email ,address=:address where id_supplier=:id";
            $query = $this->access->prepare($sql);
            $query->execute(array( ':name' => $name,
                ':phone' => $phone,
                ':email' => $email,
                ':address' => $address,
                ':id' => $id
            ));
            echo 'edit';
        }

    }

    public function fillLabs()
    {

        $sql="SELECT * FROM proveedor order by name asc";
        $query = $this->access->prepare($sql);
        $query->execute();
        $this->objects=$query->fetchAll();
        return $this->objects;
    }


}

?>
