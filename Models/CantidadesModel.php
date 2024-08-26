<?php
class CantidadesModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getContadores()
    {
        $sql = "SELECT id, botellas_1litro, clientes_satisfechos, DATE_FORMAT(fecha_actualizacion, '%d/%m/%Y %H:%i') as fec_actualiza FROM contadores";
        $res = $this->selectAll($sql);
        return $res;
    }
    public function editContadores($id)
    {
        $sql = "SELECT * FROM contadores WHERE id = $id";
        $res = $this->select($sql);
        return $res;
    }
    
    public function actualizarContadores($botellas_1litro, $clientes_satisfechos, $id)
    {
        $query = "UPDATE contadores SET botellas_1litro = ?,clientes_satisfechos = ? WHERE id = ?";
        $datos = array($botellas_1litro,$clientes_satisfechos, $id);
        $data = $this->save($query, $datos);
        if ($data == 1) {
            $res = "modificado";
        } else {
            $res = "error";
        }
        return $res;
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
