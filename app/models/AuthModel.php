<?php

class AuthModel {
    public function __construct()
    {
        $this->db = new Database;
    }

    /* Create: Función para dar de alta al usuario.
        Tener en cuenta que para los campos TIMESTAMP, no se usa la función bind.
    */
    public function crear_usuario($data)
	{
		
		$keyw = "keyword";
		$this->db->query("INSERT INTO usuario
                          (nombre, apellido, dni, email, pass, created_at) 
						  VALUES 
						  (:nombre, :apellido, :dni, :email, aes_encrypt(:pass,:keyword), CURRENT_TIMESTAMP)");
        $this->db->bind('nombre', $data['nombre']);
        $this->db->bind('apellido', $data['apellido']);
		$this->db->bind('dni', $data['dni']);
		$this->db->bind('email', $data['email']);
		$this->db->bind('pass', $data['pass']);
		$this->db->bind('keyword', $keyw);
		if ($this->db->execute()) {
			return true;
		} else {
			return false;
		}
	}

    	/* Método para buscar el mail y la contraseña para comprobar si existe y poder loguear*/

	public function buscar_por_mail($data)
	{
		$this->db->query("SELECT id_usuario, nombre, email, aes_decrypt(pass, 'keyword') AS pass 
							  FROM usuario
							  WHERE usuario.email =:email
							  AND deleted_at IS NULL");
		$this->db->bind('email', $data['email']);
		
		$result = $this->db->register();
		return $result;
	}

	public function change_pass($pass, $email)
	{
		
		$keyw = 'keyword';
		$this->db->query("UPDATE usuario SET
								pass = aes_encrypt(:new_pass,:keyword),
								updated_at=CURRENT_TIMESTAMP
							 WHERE email=:mail");
		$this->db->bind('new_pass', $pass);
		$this->db->bind('keyword', $keyw);
		$this->db->bind('mail', $email);
		if ($this->db->execute()) {
			return true;
		} else {
			return false;
		}
	}



	//Para editar el usuario en el dashboard. En lugar de crear un nuevo model y controller, agrego esta funcionalidad en el auth controller y model, para mas practicidad
	
    public function obtenerUsuarioPorId($id_usuario) {
        $this->db->query("SELECT * FROM usuario WHERE id_usuario = :id_usuario AND deleted_at IS NULL");
        $this->db->bind('id_usuario', $id_usuario);
        $result = $this->db->register();
        return $result;
    }

    public function actualizarUsuario($data) {
        $this->db->query("UPDATE usuario SET 
                          nombre = :nombre,
                          apellido = :apellido,
						  dni = :dni,
                          email = :email,
                          updated_at = CURRENT_TIMESTAMP
                          WHERE id_usuario = :id_usuario");
        
        $this->db->bind('nombre', $data['nombre']);
        $this->db->bind('apellido', $data['apellido']);
		$this->db->bind('dni', $data['dni']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('id_usuario', $data['id_usuario']);
        
		
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>