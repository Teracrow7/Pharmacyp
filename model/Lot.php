<?php
include 'Connection.php';

class Lot
{
    var $objects;

    private $access;


    public function __construct()
    {
        $db = new Connection();
        $this->access = $db->pdo;

    }

    public function create($id_product, $supplier, $stock, $expiration)
    {

        $sql="INSERT INTO lote(stock,expiration,lot_id_prod,lot_id_prov) VALUES (:stock,:expiration,:id_product,:id_supplier)";
        $query = $this->access->prepare($sql);
        $query->execute(array( ':stock' => $stock,
            ':expiration' => $expiration,
            ':id_product' => $id_product,
            ':id_supplier' => $supplier
        ));
      echo 'add';

    }

    function search()
    {
        if(!empty($_POST['queryData'])){

            $queryData = $_POST['queryData'];
            $sql="SELECT id_lot,stock,expiration,concentration,extra, producto.name as prod_name, laboratorio.name as lab_name, tipo_producto.name as type_name,presentacion.name as pre_name, proveedor.name as proveedor, producto.avatar as logo FROM lote 
JOIN proveedor on lot_id_prov=id_supplier
join producto on lot_id_prod=id_product
JOIN laboratorio on prod_lab=id_laboratory
JOIN tipo_producto on prod_type=id_type_prod
JOIN presentacion on prod_presentation=id_filing and producto.name LIKE :queryData ORDER BY producto.name LIMIT 25;";
            $query = $this->access->prepare($sql);
            $query->execute(array(':queryData'=>"%$queryData%"));
            $this->objects=$query->fetchAll();
            return$this->objects;

        }else{

            $sql="SELECT id_lot,stock,expiration,concentration,extra, producto.name as prod_name, laboratorio.name as lab_name, tipo_producto.name as type_name,presentacion.name as pre_name, proveedor.name as proveedor, producto.avatar as logo FROM lote 
            JOIN proveedor on lot_id_prov=id_supplier
            join producto on lot_id_prod=id_product
            JOIN laboratorio on prod_lab=id_laboratory
            JOIN tipo_producto on prod_type=id_type_prod
            JOIN presentacion on prod_presentation=id_filing and producto.name NOT LIKE '' ORDER BY producto.name LIMIT 25;";
            $query = $this->access->prepare($sql);
            $query->execute();
            $this->objects=$query->fetchAll();
            return$this->objects;
        }

    }

    public function edit($id_lot, $stock)
    {
        $sql="UPDATE lote SET stock=:stock where id_lot=:id";
        $query = $this->access->prepare($sql);
        $query->execute(array(
            ':stock' => $stock,
            ':id' => $id_lot
        ));

        echo 'edited';
    }

    public function delete($id)
    {

        $sql="DELETE FROM lote where id_lot=:id";
        $query = $this->access->prepare($sql);
        $query->execute(array(':id'=>$id));
        if(!empty($query->execute(array(':id'=>$id)))){
            echo 'deleted';
        }else{
            echo 'nodeleted';
        }
    }

}

?>
