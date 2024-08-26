<?php
class Testimonios extends Controller
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url);
        }
        parent::__construct();
        $id_user = $_SESSION['id_usuario'];
        $perm = $this->model->verificarPermisos($id_user, "Testimonios");
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
        $data = $this->model->getTestimonios();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['acciones'] = '<div>
            <button class="btn btn-primary" type="button" onclick="btnEditarTestim(' . $data[$i]['id'] . ');"><i class="fa fa-pencil"></i></button>
            <button class="btn btn-danger" type="button" onclick="btnEliminarTestim(' . $data[$i]['id'] . ');"><i class="fa fa-trash-o"></i></button>
            <div/>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function editar($id)
    {
        $data = $this->model->editTestimonios($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar()
    {
        $nombre = strClean($_POST['nombre']);
        $detalle = strClean($_POST['detalle']);
        $cargo_entidad = strClean($_POST['cargo_entidad']);
        $id = strClean($_POST['id']);
        if (empty($nombre) || empty($detalle) || empty($cargo_entidad) ) {
            $msg = array('msg' => 'Todo los campos son requeridos', 'icono' => 'warning');
        } else {
             if ($id == "") {
                $data = $this->model->insertarTestimonios($nombre,$detalle, $cargo_entidad);
                if ($data > 0) {
                    $msg = array('msg' => 'Testimonios insertado con exito.', 'icono' => 'success', 'id' => $data);
                } else if ($data == "existe") {
                    $msg = array('msg' => 'El Testimonios ya esta registrado anteriormente', 'icono' => 'warning');
                } else {
                    $msg = array('msg' => 'Error al insertar Testimonio', 'icono' => 'error');
                }
            } else {
                $data = $this->model->actualizarTestimonios($nombre,$detalle, $cargo_entidad, $id);
                if ($data == "modificado") {
                    $msg = array('msg' => 'Testimonios modificado', 'icono' => 'success');
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
        $data = $this->model->deleteTestimonios(0, $id);
        if ($data == 1) {
            $msg = array('msg' => 'Testimonio eliminado con exito', 'icono' => 'success');
        } else {
            $msg = array('msg' => 'Error al eliminar', 'icono' => 'error');
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }
    
}
