<?php
include 'Connection.php';

class Laboratory
{
    var $objects;

    private $access;


    public function __construct()
    {
        $db = new Connection();
        $this->access=$db->pdo;

    }

    public function create($name, $avatar)
    {
        $sql="SELECT id_laboratory FROM laboratorio where name=:name ";
        $query = $this->access->prepare($sql);
        $query->execute(array( ':name' => $name));
        $this->objects=$query->fetchAll();
        if(!empty($this->objects)){

            echo 'noadd';

        }else{
            $sql="INSERT INTO laboratorio(name,avatar) values (:name,:avatar)";
            $query = $this->access->prepare($sql);
            $query->execute(array( ':name' => $name,':avatar' => $avatar));
            echo 'add';
        }

    }
    function search()
    {
        if(!empty($_POST['queryData'])){

            $queryData = $_POST['queryData'];
            $sql="SELECT * FROM laboratorio where name LIKE :queryData";
            $query = $this->access->prepare($sql);
            $query->execute(array(':queryData'=>"%$queryData%"));
            $this->objects=$query->fetchAll();
            return$this->objects;

        }else{

            $sql="SELECT * FROM laboratorio where name NOT LIKE '' ORDER BY id_laboratory LIMIT 25";
            $query = $this->access->prepare($sql);
            $query->execute();
            $this->objects=$query->fetchAll();
            return$this->objects;
        }
    }

    public function delete($id)
    {
        $sql="DELETE FROM laboratorio where id_laboratory=:id";
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

        $sql="UPDATE laboratorio SET name=:name where id_laboratory=:id";
        $query = $this->access->prepare($sql);
        $query->execute(array(':id'=>$id_edited, ':name'=>$name));
        echo 'edit';

    }

    public function fillLabs()
    {

        $sql="SELECT * FROM laboratorio order by name asc";
        $query = $this->access->prepare($sql);
        $query->execute();
        $this->objects=$query->fetchAll();
        return $this->objects;

    }
}

?>