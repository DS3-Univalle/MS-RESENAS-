<?php
class Resena {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getResenas() {
        $sql = "SELECT `oid`, `puntuacion`, `descripcion`, `oidreserva` FROM `resenas`";
        $result = $this->conn->query($sql);

        $resenas = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $resenas[] = $row;
            }
        }
        return $resenas;
    }

    public function createResena($puntuacion, $descripcion, $oidreserva) {
        $sql = "INSERT INTO `resenas` (`puntuacion`, `descripcion`, `oidreserva`) VALUES ('$puntuacion', '$descripcion', '$oidreserva')";

        if ($this->conn->query($sql) === TRUE) {
            return "Reseña creada con éxito";
        } else {
            return "Error al crear la reseña: " . $this->conn->error;
        }
    }

    public function updateResena($oid, $puntuacion, $descripcion, $oidreserva) {
        $sql = "UPDATE `resenas` SET `puntuacion` = '$puntuacion', `descripcion` = '$descripcion', `oidreserva` = '$oidreserva' WHERE `oid` = $oid";

        if ($this->conn->query($sql) === TRUE) {
            return "Reseña actualizada con éxito";
        } else {
            return "Error al actualizar la reseña: " . $this->conn->error;
        }
    }

    public function deleteResena($oid) {
        $sql = "DELETE FROM `resenas` WHERE `oid` = $oid";

        if ($this->conn->query($sql) === TRUE) {
            return "Reseña eliminada con éxito";
        } else {
            return "Error al eliminar la reseña: " . $this->conn->error;
        }
    }
}
?>