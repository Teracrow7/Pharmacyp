<?php
include 'Connection.php';

class Order
{
    var $objects;
    private $access;

    public function __construct()
    {
        $db = new Connection();
        $this->access = $db->pdo;

    }

    public function Create($name, $total, $datee, $seller)
    {
        $sql="INSERT INTO venta(date_sale,client,total,seller) values(:date,:client,:total,:seller)";
        $query = $this->access->prepare($sql);
        $query->execute(array(
            ':client' => $name,
            ':total' => $total,
            ':date' => $datee,
            ':seller' => $seller,
            ));
    }

    public function LastOrder()
    {
        $sql="SELECT MAX(id_sale) as last_sell FROM venta";
        $query = $this->access->prepare($sql);
        $query->execute();
        $this->objects=$query->fetchAll();
        return$this->objects;
    }

    public function Delete($id_sale)
    {
        $sql="DELETE FROM venta where id_sale=:id_sale";
        $query = $this->access->prepare($sql);
        $query->execute(array(
            ':id_sale' => $id_sale,
        ));
    }
    public function searchOrder()
    {
        $sql = "SELECT id_sale, client, total, date_sale, CONCAT(usuario.username, ' ', usuario.user_lastname) AS seller 
                FROM venta 
                JOIN usuario ON venta.seller = usuario.id_user";
        $query = $this->access->prepare($sql);
        $query->execute();
        $this->objects = $query->fetchAll(PDO::FETCH_ASSOC); // Fetch as associative array
        return $this->objects;
    }

}
