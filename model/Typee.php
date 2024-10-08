<?php
include 'Connection.php';

class Typee
{
    var $objects;

    private $access;


    public function __construct()
    {
        $db = new Connection();
        $this->access=$db->pdo;

    }

    public function create($name)
    {
        $sql="SELECT id_type_prod FROM tipo_producto where name=:name ";
        $query = $this->access->prepare($sql);
        $query->execute(array( ':name' => $name));
        $this->objects=$query->fetchAll();
        if(!empty($this->objects)){

            echo 'noadd';

        }else{
            $sql="INSERT INTO tipo_producto(name) values (:name)";
            $query = $this->access->prepare($sql);
            $query->execute(array( ':name' => $name));
            echo 'add';
        }

    }
    function search()
    {
        if(!empty($_POST['queryData'])){

            $queryData = $_POST['queryData'];
            $sql="SELECT * FROM tipo_producto where name LIKE :queryData";
            $query = $this->access->prepare($sql);
            $query->execute(array(':queryData'=>"%$queryData%"));
            $this->objects=$query->fetchAll();
            return$this->objects;

        }else{

            $sql="SELECT * FROM tipo_producto where name NOT LIKE '' ORDER BY id_type_prod LIMIT 25";
            $query = $this->access->prepare($sql);
            $query->execute();
            $this->objects=$query->fetchAll();
            return$this->objects;
        }
    }

    public function delete($id)
    {
        $sql="DELETE FROM tipo_producto where id_type_prod=:id";
        $query = $this->access->prepare($sql);
        $query->execute(array(':id'=>$id));
        if(!empty( $query->execute(array(':id'=>$id)))){
            echo 'deleted';
        }else{
            echo 'nodeleted';
        }
    }

    public function edit($name, $id_edited)
    {

        $sql="UPDATE tipo_producto SET name=:name where id_type_prod=:id";
        $query = $this->access->prepare($sql);
        $query->execute(array(':id'=>$id_edited, ':name'=>$name));
        echo 'edit';

    }

    public function fillTipos()
    {

        $sql="SELECT * FROM tipo_producto order by name asc";
        $query = $this->access->prepare($sql);
        $query->execute();
        $this->objects=$query->fetchAll();
        return $this->objects;
    }
}

?>
