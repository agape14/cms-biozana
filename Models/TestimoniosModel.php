<?php
class TestimoniosModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getTestimonios()
    {
        $sql = "SELECT id, detalle, nombre, cargo_entidad, DATE_FORMAT(fecha_creacion, '%d/%m/%Y %H:%i') as fec_crea FROM testimonios";
        $res = $this->selectAll($sql);
        return $res;
    }
    public function editTestimonios($id)
    {
        $sql = "SELECT * FROM testimonios WHERE id = $id";
        $res = $this->select($sql);
        return $res;
    }
    
    public function insertarTestimonios($nombre,$detalle, $cargo_entidad)
    {
        $query = "INSERT INTO testimonios(nombre, detalle, cargo_entidad) VALUES (?,?,?)";
        $datos = array($nombre, $detalle, $cargo_entidad);
        $data = $this->insert($query, $datos);
        if ($data > 0) {
            $res = $data;
        } else {
            $res = 0;
        }
        return $res;
    }

    public function actualizarTestimonios($nombre,$detalle, $cargo_entidad, $id)
    {
        $query = "UPDATE testimonios SET nombre = ?,detalle = ?,cargo_entidad = ?  WHERE id = ?";
        $datos = array($nombre,$detalle,$cargo_entidad, $id);
        $data = $this->save($query, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
    }

    public function deleteTestimonios($estado, $id)
    {
        $query = "DELETE FROM testimonios WHERE id = ?";
        $datos = array($id);
        $data = $this->save($query, $datos);
        return $data;
    }

    public function verificarPermisos($id_user, $permiso)
    {
        $tiene = false;
        $sql = "SELECT p.*, d.* FROM permisos p INNER JOIN detalle_permisos d ON p.id = d.id_permiso WHERE d.id_usuario = $id_user AND p.nombre = '$permiso'";
        $existe = $this->select($sql);
        if ($existe != null || $existe != "") {
            $tiene = true;
        }
        return $tiene;
    }
}
