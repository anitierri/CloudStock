<?php
class StockModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function listarMovimientos()
    {
        $this->db->query("SELECT m.id_movimiento, m.id_producto, p.nombre_producto, m.tipo_movimiento, m.cantidad, m.fecha_movimiento 
                         FROM movimiento_stock m
                         JOIN producto p ON m.id_producto = p.id_producto
                         WHERE m.deleted_at IS NULL
                         ORDER BY m.fecha_movimiento DESC");
        return $this->db->registers();
    }

    public function agregarMovimiento($data)
    {

        $this->db->query("SELECT * FROM producto WHERE id_producto = :id_producto");
        $this->db->bind(':id_producto', $data['id_producto']);
        $this->db->execute();

        if ($this->db->rowCount() > 0) {

            $producto = $this->db->register();


            if ($data['tipo_movimiento'] === 'entrada') {

                $nuevaCantidad = $producto->cantidad + $data['cantidad'];
            } else if ($data['tipo_movimiento'] === 'salida') {

                $nuevaCantidad = $producto->cantidad - $data['cantidad'];


                if ($nuevaCantidad < 0) {
                    throw new Exception("No hay suficiente stock disponible.");
                }
            } else {
                throw new Exception("Tipo de movimiento no válido.");
            }

            //actualisazion tabla producto
            $this->db->query("UPDATE producto SET cantidad = :cantidad WHERE id_producto = :id_producto");
            $this->db->bind(':cantidad', $nuevaCantidad);
            $this->db->bind(':id_producto', $data['id_producto']);
            $this->db->execute();


            $this->db->query("INSERT INTO movimiento_stock (id_producto, nombre_producto, cantidad, tipo_movimiento, fecha_movimiento) 
                              VALUES (:id_producto, :nombre_producto, :cantidad, :tipo_movimiento, :fecha_movimiento)");


            $this->db->bind(':id_producto', $data['id_producto']);
            $this->db->bind(':nombre_producto', $producto->nombre_producto);
            $this->db->bind(':cantidad', $data['cantidad']);
            $this->db->bind(':tipo_movimiento', $data['tipo_movimiento']);
            $this->db->bind(':fecha_movimiento', $data['fecha_movimiento']);


            return $this->db->execute();
        } else {
            throw new Exception("El productp no existe.");
        }
    }

    public function obtenerProductos()
    {
        $this->db->query("SELECT id_producto, nombre_producto FROM producto WHERE deleted_at IS NULL");
        return $this->db->registers();
    }




    public function revertirMovimiento($id_producto, $cantidad, $tipo_movimiento)
    {

        if ($tipo_movimiento == 'entrada') {
            $this->db->query("UPDATE producto SET cantidad = cantidad - :cantidad WHERE id_producto = :id_producto");
        } else {
            $this->db->query("UPDATE producto SET cantidad = cantidad + :cantidad WHERE id_producto = :id_producto");
        }

        $this->db->bind(':cantidad', $cantidad);
        $this->db->bind(':id_producto', $id_producto);
        return $this->db->execute();
    }


    public function eliminarMovimiento($id_movimiento) {
        $this->db->query("SELECT * FROM movimiento_stock WHERE id_movimiento = :id_movimiento AND deleted_at IS NULL");
        $this->db->bind(':id_movimiento', $id_movimiento);
        $movimiento = $this->db->register();  
    
        if ($movimiento) {
            if ($movimiento->tipo_movimiento == 'entrada') {
                $this->actualizarStockProducto($movimiento->id_producto, $movimiento->cantidad, 'salida');
            } else {
                $this->actualizarStockProducto($movimiento->id_producto, $movimiento->cantidad, 'entrada');
            }
    
            $this->db->query("UPDATE movimiento_stock SET deleted_at = CURRENT_TIMESTAMP WHERE id_movimiento = :id_movimiento");
            $this->db->bind(':id_movimiento', $id_movimiento);
    
            return $this->db->execute(); 
        }
    
        return false;
    }
    

    


    public function actualizarStockProducto($id_producto, $cantidad, $tipo_movimiento)
{
    if ($tipo_movimiento == 'entrada') {
        $this->db->query("UPDATE producto SET cantidad = cantidad + :cantidad WHERE id_producto = :id_producto");
    } else {
        $this->db->query("UPDATE producto SET cantidad = cantidad - :cantidad WHERE id_producto = :id_producto");
    }

    $this->db->bind(':cantidad', $cantidad);
    $this->db->bind(':id_producto', $id_producto);

    return $this->db->execute();
}

}
