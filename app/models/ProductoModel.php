<?php
class ProductoModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function listarProductos() {
        $this->db->query("SELECT 
                            p.id_producto, 
                            p.codigo_producto, 
                            p.nombre_producto, 
                            p.cantidad,
                            pr.razon_social AS proveedor,
                            c.nombre_categoria AS categoria
                          FROM producto p
                          JOIN proveedor pr ON p.id_proveedor = pr.id_proveedor
                          JOIN categoria c ON p.id_categoria = c.id_categoria
                          WHERE p.deleted_at IS NULL
                          ORDER BY p.created_at DESC");
        return $this->db->registers();
    }

    public function obtenerProveedores() {
        $this->db->query("SELECT id_proveedor, razon_social FROM proveedor WHERE deleted_at IS NULL");
        return $this->db->registers();
    }

    public function obtenerCategorias() {
        $this->db->query("SELECT id_categoria, nombre_categoria FROM categoria");
        return $this->db->registers();
    }
    

    public function agregarProducto($data) {
        $this->db->query("INSERT INTO producto (id_proveedor, id_categoria, codigo_producto, nombre_producto, cantidad) VALUES (:id_proveedor, :id_categoria, :codigo_producto, :nombre_producto, :cantidad)");

        $this->db->bind(':id_proveedor', $data['id_proveedor']);
        $this->db->bind(':id_categoria', $data['id_categoria']);
        $this->db->bind(':codigo_producto', $data['codigo_producto']);
        $this->db->bind(':nombre_producto', $data['nombre_producto']);
        $this->db->bind(':cantidad', $data['cantidad']);

        return $this->db->execute();
    }
   

    public function eliminarProducto($id_producto){
        $this->db->query("UPDATE producto SET deleted_at = CURRENT_TIMESTAMP WHERE id_producto = :id_producto");
        $this->db->bind('id_producto',$id_producto);

        if ($this->db->execute()) {
			return true;
		} else {
			return false;
		}
    }

    public function obtenerProductoPorId($id_producto){
        $this->db->query("SELECT 
                            p.id_producto, 
                            p.codigo_producto, 
                            p.nombre_producto, 
                            p.id_proveedor,
                            p.id_categoria,
                            pr.razon_social AS proveedor,
                            c.nombre_categoria AS categoria
                          FROM producto p
                          JOIN proveedor pr ON p.id_proveedor = pr.id_proveedor
                          JOIN categoria c ON p.id_categoria = c.id_categoria
                          WHERE p.id_producto= :id_producto 
                          AND p.deleted_at IS NULL");
        $this->db->bind(':id_producto', $id_producto);
		$result = $this->db->register();
		return $result;
    }

    public function actualizarProducto($data){
        $this->db->query("UPDATE producto set
                        id_proveedor = :id_proveedor,
                        id_categoria = :id_categoria,
                        codigo_producto = :codigo_producto,
                        nombre_producto = :nombre_producto,
                        updated_at= CURRENT_TIMESTAMP
                        WHERE id_producto = :id_producto");
        $this->db->bind(':id_proveedor', $data['id_proveedor']);
        $this->db->bind(':id_categoria', $data['id_categoria']);
        $this->db->bind(':codigo_producto', $data['codigo_producto']);
        $this->db->bind(':nombre_producto', $data['nombre_producto']);
        $this->db->bind(':id_producto', $data['id_producto']);

        if ($this->db->execute()) {
			return true;
		} else {
			return false;
		}
    }
    public function codigoProductoExiste($codigo_producto) {
        $this->db->query("SELECT COUNT(*) as count FROM producto WHERE codigo_producto = :codigo_producto AND deleted_at IS NULL");
        $this->db->bind(':codigo_producto', $codigo_producto);
        $result = $this->db->register();  
        
        // Accede al valor de 'count' desde el objeto
        if ($result && isset($result->count)) {
            return $result->count > 0;  // Devuelve true si el código existe
        }
        return false;  // Devuelve false si el código no existe
    }
}

?>
