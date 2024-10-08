<?php
include 'Connection.php';

class Product
{
    var $objects;
    private $access;
    public function __construct()
    {
        $db = new Connection();
        $this->access=$db->pdo;

    }

    public function create($name, $concentration, $extra, $price, $laboratory, $type, $presentation, $avatar)
    {
        $sql="SELECT id_product FROM producto where name=:name and concentration=:concentration and extra=:extra and prod_lab=:laboratory and prod_type=:type and prod_presentation=:presentation";
        $query = $this->access->prepare($sql);
        $query->execute(array(
            ':name' => $name,
            ':concentration' => $concentration,
            ':extra' => $extra,
            ':laboratory' => $laboratory,
            ':type' => $type,
            ':presentation' => $presentation

        ));
        $this->objects=$query->fetchAll();
        if(!empty($this->objects)){

            echo 'noadd';

        }else{
            $sql="INSERT INTO producto(name,concentration,price,extra,prod_lab,prod_type,prod_presentation,avatar) values (:name,:concentration,:price,:extra,:laboratory,:type,:presentation,:avatar)";
            $query = $this->access->prepare($sql);
            $query->execute(array( ':name' => $name,
                ':concentration' => $concentration,
                ':price' => $price,
                ':extra' => $extra,
                ':laboratory' => $laboratory,
                ':type' => $type,
                ':presentation' => $presentation,
                ':avatar' => $avatar));
            echo 'add';
        }

    }
    function search()
    {
        if(!empty($_POST['queryData'])){

            $queryData = $_POST['queryData'];
            $sql="SELECT producto.id_product, 
       producto.name AS name, 
       concentration, 
       extra, 
       price, 
       laboratorio.name AS laboratory, 
       tipo_producto.name AS type, 
       presentacion.name AS presentation, 
       producto.avatar AS avatar,
        prod_lab,prod_type,prod_presentation
        FROM producto
        JOIN laboratorio ON producto.prod_lab = laboratorio.id_laboratory
        JOIN tipo_producto ON producto.prod_type = tipo_producto.id_type_prod
        JOIN presentacion ON producto.prod_presentation = presentacion.id_filing
        AND producto.name LIKE :queryData LIMIT 25;";
            $query = $this->access->prepare($sql);
            $query->execute(array(':queryData'=>"%$queryData%"));
            $this->objects=$query->fetchAll();
            return$this->objects;

        }else{

            $sql="SELECT producto.id_product, 
       producto.name AS name, 
       concentration, 
       extra, 
       price, 
       laboratorio.name AS laboratory, 
       tipo_producto.name AS type, 
       presentacion.name AS presentation, 
       producto.avatar AS avatar ,
        prod_lab,prod_type,prod_presentation
        FROM producto
        JOIN laboratorio ON producto.prod_lab = laboratorio.id_laboratory
        JOIN tipo_producto ON producto.prod_type = tipo_producto.id_type_prod
        JOIN presentacion ON producto.prod_presentation = presentacion.id_filing
        AND producto.name NOT LIKE '' order by producto.name LIMIT 25;";
            $query = $this->access->prepare($sql);
            $query->execute();
            $this->objects=$query->fetchAll();
            return$this->objects;
        }

    }

    public function edit($id, $name, $concentration, $extra, $price, $laboratory, $type, $presentation)
    {
        $sql="SELECT id_product FROM producto where id_product!=:id and name=:name and concentration=:concentration and extra=:extra and prod_lab=:laboratory and prod_type=:type and prod_presentation=:presentation";
        $query = $this->access->prepare($sql);
        $query->execute(array(
            ':name' => $name,
            ':concentration' => $concentration,
            ':extra' => $extra,
            ':laboratory' => $laboratory,
            ':type' => $type,
            ':presentation' => $presentation,
            ':id' => $id
        ));
        $this->objects=$query->fetchAll();
        if(!empty($this->objects)){

            echo 'noedit';

        }else{
            $sql="UPDATE producto SET name=:name,concentration=:concentration,extra=:extra ,prod_lab=:laboratory,prod_type=:type,prod_presentation=:presentation,price=:price where id_product=:id";
            $query = $this->access->prepare($sql);
            $query->execute(array( ':name' => $name,
                ':concentration' => $concentration,
                ':price' => $price,
                ':extra' => $extra,
                ':laboratory' => $laboratory,
                ':type' => $type,
                ':presentation' => $presentation,
                ':id' => $id
              ));
            echo 'edit';
        }
    }

    public function delete($id)
    {
        $sql="DELETE FROM producto where id_product=:id";
        $query = $this->access->prepare($sql);
        $query->execute(array(':id'=>$id));
        if(!empty($query->execute(array(':id'=>$id)))){
            echo 'deleted';
        }else{
            echo 'nodeleted';
        }

    }

    public function obtainStock($id_product)
    {
        $sql="SELECT SUM(stock) as total FROM lote where lot_id_prod=:id";
        $query = $this->access->prepare($sql);
        $query->execute(array(':id'=>$id_product));
        $this->objects=$query->fetchAll();

        return $this->objects;
    }


}


?>
