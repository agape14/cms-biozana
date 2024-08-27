<?php
class Blogs extends Controller
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url);
        }
        parent::__construct();
        $id_user = $_SESSION['id_usuario'];
        $perm = $this->model->verificarPermisos($id_user, "Blogs");
        if (!$perm && $id_user != 1) {
            $this->views->getView($this, "permisos");
            exit;
        }
    }
    public function index()
    {
        $this->views->getView($this, "index");
    }
    public function listar()
    {
        $data = $this->model->getBlogs();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['acciones'] = '<div>
            <button class="btn btn-primary" type="button" onclick="btnEditarBlogs(' . $data[$i]['id'] . ');"><i class="fa fa-pencil"></i></button>
            <button class="btn btn-danger" type="button" onclick="btnEliminarBlogs(' . $data[$i]['id'] . ');"><i class="fa fa-trash-o"></i></button>
            <div/>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function editar($id)
    {
        $data = $this->model->editBlogs($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar()
    {
        $titulo = strClean($_POST['titulo']);
        $descripcion = strClean($_POST['descripcion']);
        $etiqueta = strClean($_POST['etiqueta']);
        $id = strClean($_POST['id']);
    
        // Manejo de la imagen
        $imagen = $_FILES['imagen'];
        $nombreImagen = '';
    
        if ($imagen['error'] == 0) {
            $ext = pathinfo($imagen['name'], PATHINFO_EXTENSION);
            $nombreImagen = uniqid() . '.' . $ext;
    
            // Ruta base para el entorno local
            $rutaBaseLocal = 'Assets/img/blogs/';
            $rutaBaseWebLocal = 'C:/laragon/www/Ozana/assets/img/blog/';
    
            // Ruta base para el entorno de producción
            $rutaBaseProduccionCMS = '/home/usuario/public_html/cmsbiozana/Assets/img/blogs/';
            $rutaBaseProduccionWeb = '/home/usuario/public_html/assets/img/blog/';
    
            // Determinar el entorno actual
            $esLocal = strpos($_SERVER['SERVER_NAME'], 'localhost') !== false;
            
            if ($esLocal) {
                // Entorno local
                $rutaCMS = $rutaBaseLocal . $nombreImagen;
                $rutaWeb = $rutaBaseWebLocal . $nombreImagen;
            } else {
                // Producción
                $rutaCMS = $rutaBaseProduccionCMS . $nombreImagen;
                $rutaWeb = $rutaBaseProduccionWeb . $nombreImagen;
            }
    
            // Mover la imagen al directorio del CMS
            move_uploaded_file($imagen['tmp_name'], $rutaCMS);
    
            // Copiar la imagen al directorio de la web pública
            if (!copy($rutaCMS, $rutaWeb)) {
                // Manejar error si la copia falla
                error_log('Error al copiar la imagen al directorio de la web pública.');
            }
        }
    
        if (empty($titulo) || empty($descripcion) || empty($etiqueta) || ($id == "" && empty($nombreImagen))) {
            $msg = array('msg' => 'Todos los campos son requeridos', 'icono' => 'warning');
        } else {
            if ($id == "") { // Registro nuevo
                $data = $this->model->insertarBlogs($titulo, $descripcion, $etiqueta, $nombreImagen);
                if ($data > 0) {
                    $msg = array('msg' => 'Blog insertado con éxito.', 'icono' => 'success', 'id' => $data);
                } else if ($data == "existe") {
                    $msg = array('msg' => 'El blog ya está registrado anteriormente', 'icono' => 'warning');
                } else {
                    $msg = array('msg' => 'Error al insertar Blog', 'icono' => 'error');
                }
            } else { // Actualización
                if (!empty($nombreImagen)) {
                    // Si hay una nueva imagen, actualiza todo
                    $data = $this->model->actualizarBlogs($titulo, $descripcion, $etiqueta, $nombreImagen, $id);
                } else {
                    // Si no hay nueva imagen, actualiza sin modificar la imagen
                    $data = $this->model->actualizarBlogsSinImagen($titulo, $descripcion, $etiqueta, $id);
                }
    
                if ($data == "modificado") {
                    $msg = array('msg' => 'Blog modificado', 'icono' => 'success');
                } else {
                    $msg = array('msg' => 'Error al modificar', 'icono' => 'error');
                }
            }
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    


    public function eliminar($id)
    {
        $data = $this->model->deleteBlogs(0, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Testimonio eliminado con exito', 'icono' => 'success');
        } else {
            $msg = array('msg' => 'Error al eliminar', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    
}
