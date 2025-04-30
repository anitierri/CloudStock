<?php

class OrdenModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function obtenerOrdenes()
    {
        $this->db->query("SELECT o.id_orden, o.fecha_orden, o.producto, o.cantidad, 
                                 p.razon_social AS proveedor, 
                                 u.nombre AS usuario
                          FROM orden_compra o
                          JOIN proveedor p ON o.id_proveedor = p.id_proveedor
                          JOIN usuario u ON o.id_usuario = u.id_usuario
                          WHERE o.deleted_at IS NULL
                          ORDER BY o.fecha_orden DESC");

        return $this->db->registers() ?: [];
    }
    public function obtenerOrdenPorId($id) {
        $this->db->query("SELECT o.id_orden, o.fecha_orden, o.producto, o.cantidad, 
                                 o.id_proveedor 
                          FROM orden_compra o
                          WHERE o.id_orden = :id_orden 
                          AND o.deleted_at IS NULL");
        $this->db->bind(':id_orden', $id);
        return $this->db->register();
    }
    public function eliminarOrden($id_orden)
    {
        $this->db->query("UPDATE orden_compra SET deleted_at = CURRENT_TIMESTAMP WHERE id_orden = :id");
        $this->db->bind('id', $id_orden);
        return $this->db->execute();
    }

    public function agregarOrden($data) {
        $this->db->query("INSERT INTO orden_compra (id_proveedor, id_usuario, fecha_orden, producto, cantidad) VALUES (:id_proveedor, :id_usuario, :fecha_orden, :producto, :cantidad)");

        $this->db->bind(':id_proveedor', $data['id_proveedor']);
        $this->db->bind(':id_usuario', $data['id_usuario']);
        $this->db->bind(':fecha_orden', $data['fecha_orden']);
        $this->db->bind(':producto', $data['producto']);
        $this->db->bind(':cantidad', $data['cantidad']);

        return $this->db->execute();
    }

    public function obtenerProveedores()
    {
        $this->db->query("SELECT id_proveedor, razon_social FROM proveedor WHERE deleted_at IS NULL");
        return $this->db->registers() ?: [];
    }

    public function obtenerEmailProveedor($id_proveedor)
{
    $this->db->query("SELECT email FROM proveedor WHERE id_proveedor = :id AND deleted_at IS NULL");
    $this->db->bind(':id', $id_proveedor);
    $result = $this->db->register(); 

    return $result ? $result->email : null;
}
public function obtenerNombreProveedor($id_proveedor) {
    $this->db->query("SELECT razon_social FROM proveedor WHERE id_proveedor = :id AND deleted_at IS NULL");
    $this->db->bind(':id', $id_proveedor);
    $result = $this->db->register(); 

    return $result ? $result->razon_social : null; 
}

}
?>