<?php

class ProductoController extends BaseController {
    public function __construct() {
        $this->model = $this->model('ProductoModel');
        
    }

    public function index() {
        $data['productos'] = $this->model->listarProductos();
        $this->view('pages/dashboard/productos/productolista', $data);
    }

    public function agregarProducto() {
        $data['proveedores'] = $this->model->obtenerProveedores();
        $data['categorias'] = $this->model->obtenerCategorias();
        $this->view('pages/dashboard/productos/agregarproducto', $data);
        
    }

    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id_proveedor' => trim($_POST['id_proveedor']),
                'id_categoria' => trim($_POST['id_categoria']),
                'codigo_producto' => trim($_POST['codigo_producto']),
                'nombre_producto' => trim($_POST['nombre_producto']),
                'cantidad' => trim($_POST['cantidad']),
            ];
            // Verificar si el código ya existe
            if ($this->model->codigoProductoExiste($data['codigo_producto'])) {
            // Aquí puedes manejar el error, por ejemplo, redirigir a la vista con un mensaje de error
             $data['error'] = "El código del producto ya existe. Por favor, elige uno diferente.";
             $data['proveedores'] = $this->model->obtenerProveedores();
             $data['categorias'] = $this->model->obtenerCategorias();
             $this->view('pages/dashboard/productos/agregarproducto', $data);
             return;
            }
            // Si el código no existe, proceder a agregar el producto
            if ($this->model->agregarProducto($data)) {
                $data['productos'] = $this->model->listarProductos();
                $this->view('pages/dashboard/productos/productolista', $data);
            }
        }
    }
    public function borrarProducto($id_producto){
        if ($this->model->eliminarProducto($id_producto)) {
            header('Location: /appweb_cs_2c_2024/GRUPO7/Inventario/ProductoController/index');
            exit;
        }  
    }

    public function editarProducto($id){
        $producto = $this->model->obtenerProductoPorId($id);
        $proveedores = $this->model->obtenerProveedores();
        $categorias = $this->model->obtenerCategorias();
        $data=[
            'producto'=> $producto,
            'proveedores' => $proveedores,
            'categorias' => $categorias
        ];
        $this->view('pages/dashboard/productos/editarproducto', $data);
    }

    public function guardarCambiosProducto(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id_producto' => trim($_POST['id_producto']),
                'id_proveedor' => trim($_POST['id_proveedor']),
                'id_categoria' => trim($_POST['id_categoria']),
                'codigo_producto' => trim($_POST['codigo_producto']),
                'nombre_producto' => trim($_POST['nombre_producto']),
            ];
    
            if ($this->model->actualizarProducto($data)) {
                header('Location: ' . RUTA_URL . '/ProductoController/index');
                exit;
            } else {
                echo "Hubo un error al actualizar el producto.";
            }
        }
    }
    
}
?>
