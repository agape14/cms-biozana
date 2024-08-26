<?php
class Cantidades extends Controller
{
    public function __construct()
    {
        session_start();
        if (empty($_SESSION['activo'])) {
            header("location: " . base_url);
        }
        parent::__construct();
        $id_user = $_SESSION['id_usuario'];
        $perm = $this->model->verificarPermisos($id_user, "Cantidades");
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
        $data = $this->model->getContadores();
        for ($i = 0; $i < count($data); $i++) {
            $data[$i]['acciones'] = '<div>
            <button class="btn btn-primary" type="button" onclick="btnEditarCant(' . $data[$i]['id'] . ');"><i class="fa fa-pencil"></i></button>
            <div/>';
        }
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function editar($id)
    {
        $data = $this->model->editContadores($id);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function registrar()
    {
        $botellas_1litro = strClean($_POST['botellas_1litro']);
        $clientes_satisfechos = strClean($_POST['clientes_satisfechos']);
        $id = strClean($_POST['id']);
        if (empty($botellas_1litro)) {
            $msg = array('msg' => 'El campo Botellas vendidas es requerido', 'icono' => 'warning');
        } else if (empty($clientes_satisfechos)) {
            $msg = array('msg' => 'El campo Clientes Satisfechos es requerido', 'icono' => 'warning');
        } else {
            /*if ($id == "") {
                $data = $this->model->insertarEditorial($editorial);
                if ($data == "ok") {
                    $msg = array('msg' => 'Editorial registrado', 'icono' => 'success');
                } else if ($data == "existe") {
                    $msg = array('msg' => 'El editorial ya existe', 'icono' => 'warning');
                } else {
                    $msg = array('msg' => 'Error al registrar', 'icono' => 'error');
                }
            } else {*/
                $data = $this->model->actualizarContadores($botellas_1litro, $clientes_satisfechos, $id);
                if ($data == "modificado") {
                    $msg = array('msg' => 'Editorial modificado', 'icono' => 'success');
                } else {
                    $msg = array('msg' => 'Error al modificar', 'icono' => 'error');
                }
            //}
        }
        echo json_encode($msg, JSON_UNESCAPED_UNICODE);
        die();
    }

   
    
}
