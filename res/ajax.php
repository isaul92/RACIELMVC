<?php


require_once '../controllers/direccionesUserController.php';
require_once '../controllers/comentariosNoticiasController.php';
require_once '../config/dataBase.php';

$a = new Ajax();
$b = new Ajax();
$c = new Ajax();
$a->guardarComentario();
$b->eliminarComentario();
$c->eliminarDireccion();

if (isset($_GET['funcion']) && !empty($_GET['funcion'])) {
    $funcion = $_GET['funcion'];
    switch ($funcion) {
        case 'guardarComentario':
            $a->guardarComentario();
            break;
        case 'eliminarComentario':
            $b->eliminarComentario();
            break;
        case 'eliminarDireccion':
            $c->eliminarDireccion();
            break;
    }
}

class Ajax {

    private $db;

    function __construct() {
        $this->db = Connect::conectar();
    }
public function index(){
    echo "ehe";
}
    public function guardarComentario() {

        if (isset( $_POST["comentario"])) {
            $comentarios=new comentariosNoticiasController();
        $comentario = $_POST["comentario"];
        $id_user = $_POST["id_user"];
        $id_noticia = $_POST["id_noticia"];
        $comentarios = $comentarios->guardarComentario($comentario, $id_user, $id_noticia);
        if ($comentarios["estado"] == 1) {
            header("http/1.1 200 ok");
             //Devolvemos el array pasado a JSON como objeto
            echo json_encode($comentarios, JSON_FORCE_OBJECT);
        } else if ($comentarios["estado"]) {
            header("http/1.1 417 error");
        }    
        }
        
    }

    public function eliminarComentario() {
        if (isset($_POST["idComentario"])) {
            $id = $_POST["idComentario"];
            $comentarios = new comentariosNoticiasController();
                    $comentarios = $comentarios->deleteComment($id);
                       echo $comentarios;
           

                 header("http/1.1 200 ok");
         
            
        }
    }

    public function eliminarDireccion() {
        if (isset($_POST["id"])) {
            $id = $_POST["id"];
            $direcciones = new direccionesUserController();
        
            $direcciones = $direcciones->eliminarDireccion($id);

            if ($direcciones == 1) {
                header("http/1.1 200 ok");
             
            } else if ($direcciones == 0) {
                header("http/1.1 500 ok");
             
            }
        }
    }

}
header('Content-type: application/json; charset=utf-8');
?>