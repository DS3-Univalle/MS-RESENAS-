<?php
class Controlador {
    private $modelo; // Declaración de la variable para el modelo

    public function __construct($conn, $modelo) {
        $this->modelo = $modelo; // Inicialización del modelo
        $this->conn = $conn; // Mantén la inicialización de la conexión aquí si es necesario
    }

    public function procesarSolicitud() {
        $method = $_SERVER['REQUEST_METHOD'];

        switch ($method) {
            case 'OPTIONS':
                // Preflight request, respond successfully
                header("Access-Control-Allow-Origin: *");
                header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
                header("Access-Control-Allow-Headers: Content-Type");
                header("Access-Control-Max-Age: 3600");
                http_response_code(200);
                break;
            case 'GET':
                $resenas = $this->modelo->getResenas();
                echo json_encode($resenas);
                break;
            case 'POST':
                header("Access-Control-Allow-Origin: *");
                header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
                header("Access-Control-Allow-Headers: Content-Type");
                header("Access-Control-Max-Age: 3600");
                $data = json_decode(file_get_contents("php://input"), true);
                $puntuacion = $data['puntuacion'];
                $descripcion = $data['descripcion'];
                $oidreserva = $data['oidreserva'];
                $response = $this->modelo->createResena($puntuacion, $descripcion, $oidreserva);
                echo json_encode(['message' => $response]);
                break;
            case 'PUT':
                $data = json_decode(file_get_contents("php://input"), true);
                $oid = $data['oid'];
                $puntuacion = $data['puntuacion'];
                $descripcion = $data['descripcion'];
                $oidreserva = $data['oidreserva'];
                $response = $this->modelo->updateResena($oid, $puntuacion, $descripcion, $oidreserva);
                echo json_encode(['message' => $response]);
                break;
            case 'DELETE':
                $data = json_decode(file_get_contents("php://input"), true);
                $oid = $data['oid'];
                $response = $this->modelo->deleteResena($oid);
                echo json_encode(['message' => $response]);
                break;
            default:
                header("HTTP/1.0 405 Method Not Allowed");
                break;
        }
    }
}
?>