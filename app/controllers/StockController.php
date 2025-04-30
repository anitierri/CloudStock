<?php
class StockController extends BaseController {
    public function __construct() {
        $this->model = $this->model('StockModel');
    }

    public function index() {
        $data['movimientos'] = $this->model->listarMovimientos();
        $this->view('pages/dashboard/stock/stocklista', $data);
    }

    public function agregarMovimiento() {
        $data['productos'] = $this->model->obtenerProductos();
        $data['tipos_movimiento'] = [
            'entrada' => 'Entrada',
            'salida' => 'Salida'
        ];
        $this->view('pages/dashboard/stock/agregarMovimiento', $data);
    }
    
    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id_producto' => trim($_POST['id_producto']),
                'tipo_movimiento' => trim($_POST['tipo_movimiento']),
                'cantidad' => trim($_POST['cantidad']),
                'fecha_movimiento' => date('Y-m-d H:i:s')
            ];
    
            try {
                if ($this->model->agregarMovimiento($data)) {
                    header('Location: /appweb_cs_2c_2024/GRUPO7/Inventario/StockController/index');
                    exit;
                }
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
    }


    public function eliminarMovimiento($id_movimiento) {
        if ($this->model->eliminarMovimiento($id_movimiento)) {
            header('Location: ' . RUTA_URL . '/StockController/index');
            exit;
        } else {
            echo "Error al eliminar la orden.";
        }
    }
    
    
    
    
    

    
}
?>