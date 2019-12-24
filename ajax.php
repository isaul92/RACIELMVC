<?php
echo "jeje";
require_once 'models/direccionesUserModel.php';
require_once 'models/comentariosNoticiasModel.php';
require_once 'config/dataBase.php';
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

    public function guardarComentario() {
        if (isset($_POST["comentario"])) {
            $comentario = $_POST["comentario"];
            $id_user = $_POST["id_user"];
            $id_noticia = $_POST["id_noticia"];
            $comentarios = new comentariosNoticiasModel();
            $comentarios->setId_user($id_user);
            $comentarios->setId_noticia($id_noticia);
            $comentarios->setContent($comentario);
            $comentarios = $comentarios->guardarComentario();
            while ($comment = $comentarios->fetch_object()) {
                echo $comment->id;
            }
        }
        return false;
    }

    public function eliminarComentario() {
        if (isset($_POST["id"])) {
            $id = $_POST["id"];
            $comentarios = new comentariosNoticiasModel();
            $comentarios->setId($id);
            $comentarios->eliminarComentario($id);
        } 
        return false; //Se ejecuta lo que quiero en la funcion 2                 
    }

    public function eliminarDireccion() {
        if (isset($_POST["id"])) {
            $id = $_POST["id"];
            $direcciones = new direccionesUserModel();
            $direcciones->setId($id);
            $direcciones->deleteAdress();
            
            header(" http/1.1 200 ok" );
            echo 'eliminando';
        }else{
               header(" http/1.1 500 ok" );
               return false; //Se ejecuta lo que quiero en la funcion 2                 
        }
    }

}
?>


