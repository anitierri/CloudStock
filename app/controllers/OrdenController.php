<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class OrdenController extends BaseController {
    
    private $ordenModel;

    public function __construct() {
        $this->ordenModel = $this->model('OrdenModel');
    } 

    public function index() {
        $this->view('pages/dashboard/ordenes/ordenLista');
    }

    public function ordenLista() {
        $ordenes = $this->ordenModel->obtenerOrdenes();
        $data = [
            'ordenes' => $ordenes
        ];
        $this->view('pages/dashboard/ordenes/ordenesLista', $data);
    }
    public function eliminarOrden($id) {
        // Obtener la información de la orden antes de eliminarla
        $orden = $this->ordenModel->obtenerOrdenPorId($id);
        
        if ($orden) {
            // Obtener el email del proveedor y la razón social
            $proveedor_email = $this->ordenModel->obtenerEmailProveedor($orden->id_proveedor);
            $razon_social = $this->ordenModel->obtenerNombreProveedor($orden->id_proveedor);
            
            // Eliminar la orden
            if ($this->ordenModel->eliminarOrden($id)) {
                // Enviar email de cancelación
                $this->sendCancellationEmail($proveedor_email, $razon_social, $orden);
                
                // Redirigir a la lista de órdenes
                header('Location: ' . RUTA_URL . '/OrdenController/ordenLista');
                exit;
            } else {
                echo "Error al eliminar la orden.";
            }
        } else {
            echo "Orden no encontrada.";
        }
    }
   
    private function sendCancellationEmail($proveedor_email, $razon_social, $orden) {
        include(RUTA_APP."/external/Mailer/src/PHPMailer.php");
        include(RUTA_APP."/external/Mailer/src/SMTP.php");
        include(RUTA_APP."/external/Mailer/src/Exception.php");
    
        $email = "grupocloudstock@gmail.com";
        $pass = "wolh hvba iczy ftnx"; 
        $from_name = "ADMINISTRADOR INVENTARIO";
        $host = "smtp.gmail.com";
        $port = 465;
        $smtp_auth = true;
        $smtp_secure = 'ssl';
    
        $body = "<p>Hola {$razon_social},
                <br>
                Lamentamos informarte que la orden de compra ha sido cancelada.<br>
                <b>N° de la Orden:</b> {$orden->id_orden}<br>
                <b>Producto:</b> {$orden->producto}<br>
                <b>Cantidad:</b> {$orden->cantidad}<br>
                <b>Fecha de la Orden:</b> {$orden->fecha_orden}<br>
                Saludos,<br>
                El equipo de <b>CloudStock</b>
              </p>";
    
        $mail = new PHPMailer();
        try {
            $mail->isSMTP();
            $mail->SMTPAuth = $smtp_auth;
            $mail->Host = $host;
            $mail->Username = $email;
            $mail->Password = $pass;
            $mail->Port = $port;
            $mail->SMTPSecure = $smtp_secure;
            $mail->CharSet = 'utf-8'; 
            $mail->setFrom($email, $from_name);
            $mail->addAddress($proveedor_email); 
            $mail->isHTML(true);
            $mail->Subject = 'Cancelación de Orden de Compra';
            $mail->Body = $body;
    
            if (!$mail->send()) {
                echo "NO SE PUDO ENVIAR EL CORREO AL PROVEEDOR"; 
                die();
            } else {
                echo "Correo de cancelación enviado al proveedor exitosamente.";
            }
        } catch (Exception $e) {
            echo "El mensaje no pudo ser enviado. Error de Mailer: {$mail->ErrorInfo}";
        }
    }
    public function agregarOrden() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'id_proveedor' => $_POST['id_proveedor'],
                'id_usuario' => $_SESSION['id_usuario'],
                'fecha_orden' => $_POST['fecha_orden'],
                'producto' => $_POST['producto'],
                'cantidad' => $_POST['cantidad']
            ];
    
            if ($this->ordenModel->agregarOrden($data)) {
                $proveedor_email = $this->ordenModel->obtenerEmailProveedor($data['id_proveedor']);
                $razon_social = $this->ordenModel->obtenerNombreProveedor($data['id_proveedor']);
                $data['razon_social'] = $razon_social;
            $this->sendEmailToProveedor($proveedor_email, $data);
            
            $_SESSION['mensaje'] = "Se ha enviado un email al proveedor con su orden de compra.";

                header('Location: ' . RUTA_URL . '/OrdenController/ordenLista');
                exit;
            } else {
                echo "Error al agregar la orden.";
            }
        }
    
        $data['proveedores'] = $this->ordenModel->obtenerProveedores();
        $this->view('pages/dashboard/ordenes/agregarOrden', $data);
    }
    
    private function sendEmailToProveedor($proveedor_email, $data) {
        include(RUTA_APP."/external/Mailer/src/PHPMailer.php");
        include(RUTA_APP."/external/Mailer/src/SMTP.php");
        include(RUTA_APP."/external/Mailer/src/Exception.php");
    
        $email = "grupocloudstock@gmail.com";
        $pass = "wolh hvba iczy ftnx"; 
        $from_name = "ADMINISTRADOR INVENTARIO";
        $host = "smtp.gmail.com";
        $port = 465;
        $smtp_auth = true;
        $smtp_secure = 'ssl';
    
        $body = "<p>Hola {$data['razon_social']},
                    <br>
                    Se ha generado una nueva orden de compra.<br>
                    <b>N° de la Orden:</b> {$orden->id_orden}<br>
                    <b>Producto:</b> {$data['producto']}<br>
                    <b>Cantidad:</b> {$data['cantidad']}<br>
                    <b>Fecha de la Orden:</b> {$data['fecha_orden']}<br>
                    Saludos,<br>
                    El equipo de <b>CloudStock</b>
                  </p>";
    
        $mail = new PHPMailer();
        try {
            $mail->isSMTP();
            $mail->SMTPAuth = $smtp_auth;
            $mail->Host = $host;
            $mail->Username = $email;
            $mail->Password = $pass;
            $mail->Port = $port;
            $mail->SMTPSecure = $smtp_secure;
            $mail->CharSet = 'utf-8'; 
            $mail->setFrom($email, $from_name);
            $mail->addAddress($proveedor_email); 
            $mail->isHTML(true);
            $mail->Subject = 'Nueva Orden de Compra';
            $mail->Body = $body;
    
            if (!$mail->send()) {
                echo "NO SE PUDO ENVIAR EL CORREO AL PROVEEDOR"; 
                die();
            } else {
                echo "Correo enviado al proveedor exitosamente.";
            }
        } catch (Exception $e) {
            echo "El mensaje no pudo ser enviado. Error de Mailer: {$mail->ErrorInfo}";
        }
    }
}
?>