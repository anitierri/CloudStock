<?php

class ProveedorController extends BaseController {
    public function __construct() {
        $this->model = $this->model('ProveedorModel');
    }

    public function index() {
        $data['proveedores'] = $this->model->listarProveedores();
        $this->view('pages/dashboard/proveedores/proveedorlista', $data);        
    }

    public function agregarProveedor() {

        $this->view('pages/dashboard/proveedores/agregarproveedor');
    }

    public function guardar() {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $data = [
                'razon_social' => trim($_POST['razon_social']),
                'cuit' => trim($_POST['cuit']),
                'direccion' => trim($_POST['direccion']),
                'telefono' => trim($_POST['telefono']),
                'email' => trim($_POST['email'])
            ];


            
            if ($this->model->agregarProveedor($data)) {
                $data['proveedores'] = $this->model->listarProveedores();

                header('Location: /appweb_cs_2c_2024/GRUPO7/Inventario/ProveedorController/index');
                exit;
            }
        }
    }
    public function editarProveedor($id){
        $proveedor = $this->model->obtenerProveedorPorId($id);
        $data = [
            'proveedor'=> $proveedor
        ];
        $this->view('pages/dashboard/proveedores/editarproveedor', $data);
    }

    public function guardarCambiosProveedor(){
        if ($_SERVER['REQUEST_METHOD']=='POST'){
            $data = [
                'razon_social' => $_POST['razon_social'],
                'cuit' => $_POST['cuit'],
                'direccion' => $_POST['direccion'],
                'telefono' => $_POST['telefono'],
                'email' => $_POST['email'],
                'id_proveedor' => $_POST['id_proveedor'],
            ];
            if($this->model-> actualizarProveedor($data)){
                header('Location: /appweb_cs_2c_2024/GRUPO7/Inventario/ProveedorController/index');
                exit;
            }
        }
    }

    public function borrarProveedor($id_proveedor){
        if ($this->model->eliminarProveedor($id_proveedor)) {
            header('Location: /appweb_cs_2c_2024/GRUPO7/Inventario/ProveedorController/index');
            exit;
        }  
    }
}

?>
