<?php
class SuscripcionesModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getSuscripciones()
    {
        $sql = "SELECT id,email, DATE_FORMAT(fecha_registro, '%d/%m/%Y %H:%i') as fec_crea FROM suscripciones";
        $res = $this->selectAll($sql);
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
