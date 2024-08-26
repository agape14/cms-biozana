<?php
class BlogsModel extends Query
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getBlogs()
    {
        $sql = "SELECT id, titulo, imagen, descripcion, DATE_FORMAT(fecha, '%d/%m/%Y %H:%i') as fec_crea,etiqueta FROM blog";
        $res = $this->selectAll($sql);
        return $res;
    }
    public function editBlogs($id)
    {
        $sql = "SELECT * FROM blog WHERE id = $id";
        $res = $this->select($sql);
        return $res;
    }
    
    public function insertarBlogs($titulo, $descripcion, $etiqueta, $imagen)
    {
        $query = "INSERT INTO blog(titulo, descripcion, etiqueta, imagen) VALUES (?, ?, ?, ?)";
        $datos = array($titulo, $descripcion, $etiqueta, $imagen);
        $data = $this->insert($query, $datos);
        return $data > 0 ? $data : 0;
    }

    public function actualizarBlogs($titulo, $descripcion, $etiqueta, $imagen, $id)
    {
        $query = "UPDATE blog SET titulo = ?, descripcion = ?, etiqueta = ?, imagen = ? WHERE id = ?";
        $datos = array($titulo, $descripcion, $etiqueta, $imagen, $id);
        $data = $this->save($query, $datos);
        return $data == 1 ? "modificado" : "error";
    }

    public function actualizarBlogsSinImagen($titulo, $descripcion, $etiqueta, $id)
    {
        $query = "UPDATE blog SET titulo = ?, descripcion = ?, etiqueta = ? WHERE id = ?";
        $datos = array($titulo, $descripcion, $etiqueta, $id);
        $data = $this->save($query, $datos);
        return $data == 1 ? "modificado" : "error";
    }

    public function deleteBlogs($estado, $id)
    {
        $query = "DELETE FROM blog WHERE id = ?";
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
