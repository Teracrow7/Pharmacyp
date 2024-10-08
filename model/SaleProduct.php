<?php
include 'Connection.php';

class SaleProduct
{
    var $objects;
    private $access;

    public function __construct()
    {
        $db = new Connection();
        $this->access = $db->pdo;

    }


    public function searchSale($id)
    {
        $sql = "SELECT price,quantity,producto.name as productName,concentration, laboratorio.name as laboratory, 
       presentacion.name as presentacion, 
       tipo_producto.name as tipo, subtotal
        FROM venta_producto
        JOIN producto on product_id_product =id_product and sale_id_sale=:id
        JOIN laboratorio on prod_lab = id_laboratory
        JOIN tipo_producto on prod_type = id_type_prod
        JOIN presentacion on prod_presentation = id_filing";
        $query = $this->access->prepare($sql);
        $query->execute(array(':id'=>$id));
        $this->objects = $query->fetchAll(PDO::FETCH_ASSOC); // Fetch as associative array
        return $this->objects;
    }

}
