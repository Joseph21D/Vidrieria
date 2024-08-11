<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

class Clientes extends Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
        // session_destroy();
    }

    // Vista Principal
    public function index()
    {
        if (empty($_SESSION['correoCliente'])) {
            header('Location: ' . BASE_URL);
        }
        $data['title'] = 'Tu Perfil';
        $data['verificar'] = $this->model->getVerificar($_SESSION['correoCliente']);
        $this->views->getView('principal', "perfil", $data);
    }

    public function registroDirecto()
    {
        if (isset($_POST['nombre']) && isset($_POST['clave'])) {
            if (empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['clave'])) {
                $mensaje = array('msg' => 'Todos los campos son Requeridos', 'icono' => 'warning');
            } else {
                $nombre = $_POST['nombre'];
                $correo = $_POST['correo'];
                $clave = $_POST['clave'];
                $verificar = $this->model->getVerificar($correo);
                if (empty($verificar)) {
                    $token = md5($correo);
                    $hash = password_hash($clave, PASSWORD_DEFAULT);
                    $data = $this->model->registroDirecto($nombre, $correo, $hash, $token);
                    if ($data > 0) {
                        $_SESSION['correoCliente'] = $correo;
                        $_SESSION['nombreCliente'] = $nombre;
                        $mensaje = array('msg' => 'Registro Exitoso', 'icono' => 'success', 'token' => $token);
                    } else {
                        $mensaje = array('msg' => 'Error al Registrar', 'icono' => 'error');
                    }
                } else {
                    $mensaje = array('msg' => 'Ya tienes una Cuenta', 'icono' => 'warning');
                }
            }
            echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    public function enviarCorreo()
    {
        if (isset($_POST['correo']) && isset($_POST['token'])) {
            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->SMTPDebug = 0; 
                $mail->isSMTP();
                $mail->Host       = HOST_SMTP;
                $mail->SMTPAuth   = true;
                $mail->Username   = USER_SMTP;
                $mail->Password   = PASS_SMTP;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port       = PUERTO_SMTP;
                $mail->setFrom('jomadica1721@gmail.com', TITLE);
                $mail->addAddress($_POST['correo']);

                //Content
                $mail->isHTML(true);
                $mail->Subject = 'Mensaje desde la: ' . TITLE;
                $mail->Body    = 'Para verificar tu correo en nuestra tienda <a href = "' . BASE_URL . 'clientes/verificarCorreo/' . ($_POST['token']) . '">Click Aquí</a>';
                $mail->AltBody = 'Gracias por la Preferencia';

                $mail->send();
                $mensaje = array('msg' => 'Correo Enviado', 'icono' => 'success');
            } catch (Exception $e) {
                $mensaje = array('msg' => 'Error al Enviar el Correo: ' . $mail->ErrorInfo, 'icono' => 'error');
            }
        } else {
            $mensaje = array('msg' => 'Error Fatal', 'icono' => 'error');
        }
        echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function verificarCorreo($token)
    {
        $verificar = $this->model->getToken($token);
        if (!empty($verificar)) {
            $data = $this->model->actualizarVerify($verificar['id']);
            header('Location: ' . BASE_URL . 'clientes');
        }
    }

    public function loginDirecto()
    {
        if (isset($_POST['correoLogin']) && isset($_POST['claveLogin'])) {
            if (empty($_POST['correoLogin']) || empty($_POST['claveLogin'])) {
                $mensaje = array('msg' => 'Todos los campos son Requeridos', 'icono' => 'warning');
            } else {
                $correo = $_POST['correoLogin'];
                $clave = $_POST['claveLogin'];
                $verificar = $this->model->getVerificar($correo);
                if (!empty($verificar)) {
                    if (password_verify($clave, $verificar['clave'])) {
                        $_SESSION['correoCliente'] = $verificar['correo'];
                        $_SESSION['nombreCliente'] = $verificar['nombre'];
                        $mensaje = array('msg' => 'OK', 'icono' => 'success');
                    } else {
                        $mensaje = array('msg' => 'Contraseña Incorrecta', 'icono' => 'error');
                    }
                } else {
                    $mensaje = array('msg' => 'El Correo no Existe', 'icono' => 'warning');
                }
            }
            echo json_encode($mensaje, JSON_UNESCAPED_UNICODE);
            die();
        }
    }

    public function registrarPedido()
    {
        $datos = file_get_contents("php://input");
        $json = json_decode($datos, true);
        $pedios = $json['pedios'];
        $productos = $json['productos'];
        if (is_array($pedios) && is_array($productos)) {
            $id_transaccion = $pedios['id'];
            $monto = $pedios['purchase_units'][0]['amount']['value'];
            $estado = $pedios['status'];
            $fecha = date('Y-m-d H:i:s');
            $email = $pedios['payer']['email_address'];
            $nombre = $pedios['payer']['name']['given_name'];
            $apellido = $pedios['payer']['name']['surname'];
            $direccion = "Av. Fernando Belaunde Terry";
            $ciudad = "Collique - Comas";
            $email_user = $_SESSION['correoCliente'];
            $data = $this->model->registrarPedido($id_transaccion, $monto, $estado, $fecha, $email, $nombre, $apellido, $direccion, $ciudad, $email_user);
            if($data > 0){
                foreach ($productos as $producto) {
                    $temp = $this->model->getProducto($producto['idProducto']);
                    $this->model->registrarDetalle($temp['nombre'], $temp['precio'], $producto['cantidad'], $data);
                }
                $mensaje = array('msg' => 'Pedido Registrado', 'icono' => 'success');
            } else{
                $mensaje = array('msg' => 'Error al registrar el Pedido', 'icono' => 'error');
            }
        } else {
            $mensaje = array('msg' => 'Error Fatal', 'icono' => 'error');
        }
        echo json_encode($mensaje);
        die();
    }

    public function listarPendientes()
    {
        $data = $this->model->getPedidos(1);
        echo json_encode($data);
        die();
    }
}
