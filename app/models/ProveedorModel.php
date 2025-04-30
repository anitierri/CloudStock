<?php
class ProveedorModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function listarProveedores() {
        $this->db->query("SELECT * FROM proveedor WHERE deleted_at IS NULL");
        return $this->db->registers();
    }

    public function agregarProveedor($data) {
        $this->db->query("INSERT INTO proveedor (razon_social, cuit, direccion, telefono, email) VALUES (:razon_social, :cuit, :direccion, :telefono, :email)");

        $this->db->bind(':razon_social', $data['razon_social']);
        $this->db->bind(':cuit', $data['cuit']);
        $this->db->bind(':direccion', $data['direccion']);
        $this->db->bind(':telefono', $data['telefono']);
        $this->db->bind(':email', $data['email']);
        

        return $this->db->execute();
    }

    public function obtenerProveedorPorId($id_proveedor){
        $this->db->query("SELECT * FROM `proveedor` WHERE id_proveedor = :id");
        $this->db->bind('id', $id_proveedor);
		$result = $this->db->register();
		return $result;
    }

    public function actualizarProveedor($data){
        $this->db->query("UPDATE proveedor set 
                          razon_social=:razon_social,
                          cuit=:cuit,
                          direccion=:direccion,
                          telefono=:telefono,
                          email=:email,
                          updated_at=CURRENT_TIMESTAMP
                          WHERE id_proveedor= :id_proveedor");
        $this->db->bind('razon_social', $data['razon_social']);
        $this->db->bind('cuit', $data['cuit']);
        $this->db->bind('direccion', $data['direccion']);
        $this->db->bind('telefono', $data['telefono']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('id_proveedor', $data['id_proveedor']);

        if ($this->db->execute()) {
			return true;
		} else {
			return false;
		}
    }
    
    public function eliminarProveedor($id_proveedor){
        $this->db->query("UPDATE proveedor SET deleted_at = CURRENT_TIMESTAMP WHERE id_proveedor = :id_proveedor");
        $this->db->bind('id_proveedor',$id_proveedor);

        if ($this->db->execute()) {
			return true;
		} else {
			return false;
		}
    }
}

?>
